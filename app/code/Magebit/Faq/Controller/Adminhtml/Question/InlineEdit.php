<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\Question;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Backend\App\Action\Context;
use Magebit\Faq\Api\QuestionRepositoryInterface as QuestionRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Magebit\Faq\Api\Data\QuestionInterface;

class InlineEdit extends Action
{
    protected QuestionRepository $questionRepository;

    protected JsonFactory $jsonFactory;

    public function __construct(
        Context $context,
        QuestionRepository $questionRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $questionId) {
                    /** @var Question $question */
                    $question = $this->questionRepository->get($questionId);
                    try {
                        $question->setData(array_merge($question->getData(), $postItems[$questionId]));
                        $this->questionRepository->save($question);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithQuestionId(
                            $question,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add question title (ID?) to error message
     *
     * @param QuestionInterface $question
     * @param $errorText
     * @return string
     */
    protected function getErrorWithQuestionId(QuestionInterface $question, $errorText): string
    {
        return '[Block ID: ' . $question->getId() . '] ' . $errorText;
    }
}

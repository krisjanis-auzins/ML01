<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save CMS block action.
 */
class Save extends Action implements HttpPostActionInterface
{
    private QuestionFactory $questionFactory;

    private QuestionRepositoryInterface $questionRepository;

    public function __construct(
        Action\Context $context,
        QuestionFactory $questionFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context,);
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            $model = $this->questionFactory->create();

            $id = $data['id'];
            if ($id) {
                try {
                    $model = $this->questionRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);
            $this->questionRepository->save($model);

            try {
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('The question has been saved'));
                return $this->processReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function processReturn(
        Question $model,
        array $data,
        Redirect $resultRedirect)
    {
        $redirectType = $data['back'] ?? 'close';

        if ($redirectType === 'continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } elseif ($redirectType === 'close') {
            $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect;
    }
}

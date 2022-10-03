<?php

namespace Magebit\Faq\Block;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use \Magento\Framework\View\Element\Template;

class QuestionList extends Template
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Gets all questions with status enabled and returns array of questions ordered by position
     *
     * @bug The getItemsByColumnValue method seems to have a bug - value expects array, but works only if a string is given
     *
     * @return array
     */
    public function getQuestions(): array
    {
        $collection = $this->collectionFactory->create();
        $questions = [];
        /** @var Question $question */
        foreach ($collection->getItemsByColumnValue('status', Question::STATUS_ENABLED) as $question) {
            if (!array_key_exists($question->getPosition(), $questions)) {
                $questions[$question->getPosition()] = $question;
            } else {
                $questions[$question->getPosition().'-'.$question->getId()] = $question;
            }
        }
        ksort($questions, SORT_NATURAL);
        return $questions;
    }
}

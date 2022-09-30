<?php

namespace Magebit\Faq\Block;

use Magebit\Faq\Model\ResourceModel\Question\Collection;
use \Magento\Framework\View\Element\Template;

class QuestionList extends Template
{
    private $collection;

    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collection = $collection;
    }

    public function getQuestions(): Collection
    {
//        echo '<pre>'; print_r($this->collection);
        return $this->collection;
    }
}

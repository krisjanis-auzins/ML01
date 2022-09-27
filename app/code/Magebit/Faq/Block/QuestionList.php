<?php

namespace Magebit\Faq\Block;

use \Magento\Framework\View\Element\Template;

class QuestionList extends Template
{
    public function getQuestions()
    {
        $questions = [
            [
                'question' => 'Question 1',
                'answer' => 'Answer 1',
                'position' => 1
            ]
        ];

        return $questions;
    }
}

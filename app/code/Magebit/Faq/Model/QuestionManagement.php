<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionManagementInterface;

class QuestionManagement implements QuestionManagementInterface
{
    protected QuestionInterface $question;

    public function __construct(
        QuestionInterface $question
    ) {
        $this->question = $question;
    }

    public function enableQuestion(): self
    {
        return $this->question->setStatus('1');
    }

    public function disableQuestion(): self
    {
        return $this->question->setStatus('0');

    }
}

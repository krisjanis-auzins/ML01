<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionManagementInterface;

/**
 * Class responsible for question status management
 */
class QuestionManagement implements QuestionManagementInterface
{
    public function enableQuestion(QuestionInterface $question)
    {
        return $question->setStatus($question::STATUS_ENABLED);
    }

    public function disableQuestion(QuestionInterface $question)
    {
        return $question->setStatus($question::STATUS_DISABLED);
    }
}

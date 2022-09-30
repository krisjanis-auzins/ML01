<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;

interface QuestionManagementInterface
{
    /**
     * @return mixed
     */
    public function disableQuestion(QuestionInterface $question);

    /**
     * @return mixed
     */
    public function enableQuestion(QuestionInterface $question);
}

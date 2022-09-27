<?php

namespace Magebit\Faq\Api;

interface QuestionManagementInterface
{
    /**
     * @return mixed
     */
    public function disableQuestion();

    /**
     * @return mixed
     */
    public function enableQuestion();
}

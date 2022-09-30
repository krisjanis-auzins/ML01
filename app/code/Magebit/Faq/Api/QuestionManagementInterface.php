<?php

namespace Magebit\Faq\Api;

interface QuestionManagementInterface
{
    /**
     * @return mixed
     */
    public function disableQuestion(): self;

    /**
     * @return mixed
     */
    public function enableQuestion(): self;
}

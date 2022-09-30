<?php

namespace Magebit\Faq\Api\Data;

use Magebit\Faq\Model\Question;
use Magento\Framework\Api\SearchCriteriaBuilder;

interface QuestionInterface
{
    const QUESTION_ID      = 'id';
    const QUESTION         = 'question';
    const ANSWER           = 'answer';
    const STATUS           = 'status';
    const POSITION         = 'position';
    const UPDATED_AT       = 'updated_at';
    const CREATED_AT       = 'created_at';
    const STATUS_ENABLED   = '1';
    const STATUS_DISABLED  = '0';

    public function getId():? int;

    public function getQuestion(): string;

    public function setQuestion(string $question): self;

    public function getAnswer(): string;

    public function setAnswer(string $answer): self;

    public function getStatus(): int;

    public function setStatus(int|bool $status): self;

    public function getPosition(): int;

    public function setPosition(int $position): self;

    public function getUpdatedAt(): string;

    public function getCreatedAt(): string;
}

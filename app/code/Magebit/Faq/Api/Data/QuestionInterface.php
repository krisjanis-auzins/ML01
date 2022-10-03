<?php

namespace Magebit\Faq\Api\Data;

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

    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return string
     */
    public function getQuestion(): string;

    /**
     * @param string $question
     * @return QuestionInterface $this
     */
    public function setQuestion(string $question): self;

    /**
     * @return string
     */
    public function getAnswer(): string;

    /**
     * @param string $answer
     * @return QuestionInterface $this
     */
    public function setAnswer(string $answer): self;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int|bool $status
     * @return QuestionInterface $this
     */
    public function setStatus(int|bool $status): self;

    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     * @return QuestionInterface $this
     */
    public function setPosition(int $position): self;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @return string
     */
    public function getCreatedAt(): string;
}

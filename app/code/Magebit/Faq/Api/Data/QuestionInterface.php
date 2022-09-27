<?php

namespace Magebit\Faq\Api\Data;

use Magebit\Faq\Model\Question;
use Magento\Framework\Api\SearchCriteriaBuilder;

interface QuestionInterface
{
    const QUESTION_ID = 'id';
    const QUESTION    = 'question';
    const ANSWER      = 'answer';
    const STATUS      = 'status';
    const POSITION    = 'position';
    const UPDATED_AT  = 'updated_at';
    const CREATED_AT  = 'created_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getQuestion();

    /**
     * @param string $question
     * @return mixed
     */
    public function setQuestion(string $question);

    /**
     * @return string
     */
    public function getAnswer();

    /**
     * @param string $answer
     * @return mixed
     */
    public function setAnswer(string $answer);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param int|bool $status
     * @return mixed
     */
    public function setStatus(int|bool $status);

    /**
     * @return mixed
     */
    public function getPosition();

    /**
     * @param int $position
     * @return mixed
     */
    public function setPosition(int $position);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @return mixed
     */
    public function getCreatedAt();
}

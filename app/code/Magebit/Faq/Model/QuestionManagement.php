<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionManagementInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;

/**
 * Class responsible for question status management
 */
class QuestionManagement implements QuestionManagementInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function enableQuestion(QuestionInterface $question): QuestionInterface
    {
        $question->setStatus($question::STATUS_ENABLED);
        return $this->questionRepository->save($question);
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function disableQuestion(QuestionInterface $question): QuestionInterface
    {
        $question->setStatus($question::STATUS_DISABLED);
        return $this->questionRepository->save($question);
    }
}

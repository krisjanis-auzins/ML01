<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\Search\SearchCriteria;

interface QuestionRepositoryInterface
{
    /**
     * @param int $id
     * @return QuestionInterface
     */
    public function getById(int $id): QuestionInterface;

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function save(QuestionInterface $question): QuestionInterface;

    /**
     * @param SearchCriteria $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteria $searchCriteria): QuestionSearchResultsInterface;

    /**
     * @param QuestionInterface $question
     * @return bool
     */
    public function delete(QuestionInterface $question): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}

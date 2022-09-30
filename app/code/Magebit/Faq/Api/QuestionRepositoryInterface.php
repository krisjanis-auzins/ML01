<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\Search\SearchCriteria;

interface QuestionRepositoryInterface
{
    public function getById(int $id): QuestionInterface;

    public function save(QuestionInterface $question): QuestionInterface;

    public function getList(SearchCriteria $searchCriteria): QuestionSearchResultsInterface;

    public function delete(QuestionInterface $question): bool;

    public function deleteById(int $id): bool;
}

<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\Search\SearchCriteria;

interface QuestionRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id);

    /**
     * @param QuestionInterface $question
     * @return mixed
     */
    public function save(QuestionInterface $question);

    /**
     * @param SearchCriteria $searchCriteria
     * @return array
     */
    public function getList(SearchCriteria $searchCriteria): array;

    /**
     * @param QuestionInterface $question
     * @return mixed
     */
    public function delete(QuestionInterface $question);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);
}

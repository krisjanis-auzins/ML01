<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\Search\SearchCriteria;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function get(int $id)
    {

    }

    public function save(QuestionInterface $question)
    {

    }

    public function getList(SearchCriteria $searchCriteria): array
    {

    }

    public function delete(QuestionInterface $question)
    {

    }

    public function deleteById(int $id)
    {

    }
}

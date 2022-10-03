<?php

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for FAQ questions search results.
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions list.
     *
     * @return QuestionInterface[]
     */
    public function getItems(): array;
}

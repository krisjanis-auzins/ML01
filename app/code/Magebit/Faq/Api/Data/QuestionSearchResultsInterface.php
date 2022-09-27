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
     * @return \Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getItems();

//    /**
//     * Set questions list.
//     *
//     * @param array $items
//     * @return $this
//     */
//    public function setItems(array $items);
}

<?php

namespace Magebit\PageListWidget\Model\Config\Source;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

/**
 * Retrieve all CMS pages
 */
class PageList implements OptionSourceInterface
{
    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepositoryInterface;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param PageRepositoryInterface $pageRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        LoggerInterface $logger
    ) {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $optionArray = [];
        try {
            $pages = $this->getCmsPageCollection();
            if (!$pages) {
                return [];
            }
            foreach ($pages as $page) {
                $optionArray[] = [
                    'label' => $page->getTitle(),
                    'value' => $page->getId()
                ];
            }
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
        return $optionArray;
    }

    /**
     * Gets all CMS pages
     *
     * @return array|null
     */
    public function getCmsPageCollection():? array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        try {
            $collection = $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
        return $collection;
    }
}

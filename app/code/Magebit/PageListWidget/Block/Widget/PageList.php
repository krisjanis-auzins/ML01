<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use \Magento\Widget\Block\BlockInterface;
use Psr\Log\LoggerInterface;


/**
 * Block for list of links to selected CMS pages
 */
class PageList extends Template implements BlockInterface
{
    /**
     * Display mode set to specific pages
     */
    const SPECIFIC_PAGES = 'specific_pages';

    /**
     * @var array
     */
    private array $data;

    /**
     * @var string|mixed
     */
    private string $displayMode;

    /**
     * @var array
     */
    private array $selectedPages;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param Template\Context $context
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PageRepositoryInterface $pageRepository
     * @param LoggerInterface $logger
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PageRepositoryInterface $pageRepository,
        LoggerInterface $logger,
        array $data = []
    ) {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
        $this->data = $data;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->setTemplate('page_list.phtml');
    }

    /**
     * Gets selected CMS pages
     *
     * @return array
     */
    public function getSelectedCmsPages(): array
    {
        $selectedPages = [];

        if ($this->data['display_mode'] === self::SPECIFIC_PAGES) {
            $pageIdentifiers = explode(',', $this->data['selected_pages']);
            $this->searchCriteriaBuilder->addFilter('page_id', $pageIdentifiers, 'in');
        }

        $searchCriteria = $this->searchCriteriaBuilder->create();

        try {
            $pageCollection = $this->pageRepository->getList($searchCriteria)->getItems();
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            return [];
        }

        foreach ($pageCollection as $page) {
            $selectedPages[] = [
                'title' => $page->getTitle(),
                'identifier' => $page->getIdentifier()
            ];
        }

        return $selectedPages;
    }
}

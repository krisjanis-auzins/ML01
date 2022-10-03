<?php

namespace Magebit\Faq\Model\ResourceModel\Question\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface;

class Collection extends SearchResult
{
    /**
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $manager
     * @param $mainTable
     * @param $resourceModel
     * @throws LocalizedException
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $manager,
        $mainTable = 'faq_entity',
        $resourceModel = 'Magebit\Faq\Model\ResourceModel\Question'
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $manager,
            $mainTable,
            $resourceModel
        );
    }
}

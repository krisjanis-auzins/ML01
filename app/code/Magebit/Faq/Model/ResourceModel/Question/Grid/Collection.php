<?php

namespace Magebit\Faq\Model\ResourceModel\Question\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\Event\ManagerInterface;
use Psr\Log\LoggerInterface;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
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

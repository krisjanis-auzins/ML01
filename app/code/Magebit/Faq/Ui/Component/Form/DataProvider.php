<?php

namespace Magebit\Faq\Ui\Component\Form;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Gets question data for edit form
     *
     * @return array
     */
    public function getData(): array
    {
        $question = $this->collection->getFirstItem();
        return  [$question->getId() => $question->getData()];
    }
}

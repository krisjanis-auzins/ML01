<?php

namespace Magebit\Faq\Ui\Component\Form;

use Magebit\Faq\Model\Question;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $collection;

    protected array $loadedData = [];

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
     * @return array
     */
    public function getData(): array
    {
        $items = $this->collection->getItems();
        /** @var Question $question */
        foreach ($items as $question) {
            $this->loadedData[$question->getId()] = $question->getData();
        }
        return $this->loadedData;
    }
}

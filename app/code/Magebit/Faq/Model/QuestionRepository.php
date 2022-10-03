<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var ResourceQuestion
     */
    protected ResourceQuestion $resource;

    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;

    /**
     * @var QuestionCollectionFactory
     */
    protected QuestionCollectionFactory $questionCollectionFactory;

    /**
     * @var Data\QuestionSearchResultsInterfaceFactory
     */
    protected Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @param ResourceQuestion $resource
     * @param QuestionFactory $questionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param int $id
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $id);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The question with "%1" ID does not exist.', $id));
        }
        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question): QuestionInterface
    {
        try {
            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $question;
    }

    /**
     * @param SearchCriteria $searchCriteria
     * @return Data\QuestionSearchResultsInterface
     */
    public function getList(SearchCriteria $searchCriteria): Data\QuestionSearchResultsInterface
    {
        $collection = $this->questionCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param QuestionInterface $question
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(QuestionInterface $question): bool
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }
}

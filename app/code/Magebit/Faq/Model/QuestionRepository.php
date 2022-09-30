<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\EntityManager\HydratorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

class QuestionRepository implements QuestionRepositoryInterface
{
    protected ResourceQuestion $resource;

    protected QuestionFactory $questionFactory;

    protected QuestionCollectionFactory $questionCollectionFactory;

    protected Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory;

    protected DataObjectHelper $dataObjectHelper;

    protected  DataObjectProcessor $dataObjectProcessor;

    protected Data\QuestionInterfaceFactory $dataQuestionFactory;

    private HydratorInterface $hydrator;

    private CollectionProcessorInterface $collectionProcessor;

    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        Data\QuestionInterfaceFactory $dataQuestionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        ?HydratorInterface $hydrator = null
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataQuestionFactory = $dataQuestionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->hydrator = $hydrator ?? ObjectManager::getInstance()->get(HydratorInterface::class);
    }

    /**
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
     * @throws NoSuchEntityException
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question): QuestionInterface
    {
//        if($question->getId() && $question instanceof Question && !$question->getOrigData()) {
//            $question = $this->hydrator->hydrate($this->getById($question->getId()), $this->hydrator->extract($question));
//        }

        try {
            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $question;
    }

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
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }
}

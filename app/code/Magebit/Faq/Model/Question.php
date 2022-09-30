<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Model\AbstractModel;
use Magebit\Faq\Model\ResourceModel\Question as ResourceModel;

class Question extends AbstractModel implements QuestionInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getId():? int
    {
        return $this->getData(self::QUESTION_ID);
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @param string $question
     * @return mixed
     */
    public function setQuestion(string $question): self
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param string $answer
     * @return mixed
     */
    public function setAnswer(string $answer): self
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @param int|bool $status
     * @return mixed
     */
    public function setStatus(bool|int $status): self
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return mixed
     */
    public function getPosition(): int
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @param int $position
     * @return mixed
     */
    public function setPosition(int $position): self
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}

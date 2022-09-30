<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Backend\Block\Widget\Context;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Button
{
    protected Context $context;

    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->context = $context;
        $this->questionRepository = $questionRepository;
    }

    public function getQuestionId(): ?int
    {
        if ($this->context->getRequest()->getParam('id')) {
            try {
                return $this->questionRepository->getById(
                    $this->context->getRequest()->getParam('id')
                )->getId();
            } catch (NoSuchEntityException $e) {
            }
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

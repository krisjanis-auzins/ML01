<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Exception;
use Magento\Backend\Block\Widget\Context;
use Magebit\Faq\Api\QuestionRepositoryInterface;

class Button
{
    /**
     * @var Context
     */
    protected Context $context;

    /**
     * @var QuestionRepositoryInterface
     */
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

    /**
     * @return int|null
     * @throws Exception
     */
    public function getQuestionId(): ?int
    {
        if ($this->context->getRequest()->getParam('id')) {
            try {
                return $this->questionRepository->getById(
                    $this->context->getRequest()->getParam('id')
                )->getId();
            } catch (Exception $e) {
                throw new $e;
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

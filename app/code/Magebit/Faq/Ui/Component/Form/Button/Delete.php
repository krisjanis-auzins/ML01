<?php

namespace Magebit\Faq\Ui\Component\Form\Button;

use Exception;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Button implements ButtonProviderInterface
{
    /**
     * @return array
     * @throws Exception
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getQuestionId()) {
            $data = [
                'label' => __('Delete Question'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * URL to send delete requests to.
     *
     * @return string
     * @throws Exception
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getQuestionId()]);
    }
}

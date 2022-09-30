<?php

namespace Magebit\Faq\Model\Question\Source;

use Magebit\Faq\Model\Question;
use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{

    protected Question $question;

    /**
     * Constructor
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->question->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}

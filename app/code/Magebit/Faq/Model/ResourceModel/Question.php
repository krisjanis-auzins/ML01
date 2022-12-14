<?php

namespace Magebit\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Question extends AbstractDb
{
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faq_entity', 'id');
    }
}

<?php

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magebit\Faq\Model\Question','Magebit\Faq\Model\ResourceModel\Question');
    }
}

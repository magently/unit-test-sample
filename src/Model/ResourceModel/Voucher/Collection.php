<?php

namespace Mediafy\Voucher\Model\ResourceModel\Voucher;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Magento construct method
     *
     * @return void
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init(
            \Mediafy\Voucher\Model\Voucher::class,
            \Mediafy\Voucher\Model\ResourceModel\Voucher::class,
        );
    }
}

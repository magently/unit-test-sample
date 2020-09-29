<?php

namespace Mediafy\Voucher\Model\ResourceModel;

use Mediafy\Voucher\Model\Voucher as VoucherModel;

/**
 * Class Voucher
 */
class Voucher extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * DB connection
     *
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connection;

    /**
     * Magento construct method
     *
     * @return void
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init(
            VoucherModel::TABLE,
            VoucherModel::COLUMN_ID
        );
        $this->connection = $this->getConnection();
    }
}

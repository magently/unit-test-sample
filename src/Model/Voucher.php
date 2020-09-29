<?php

namespace Mediafy\Voucher\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Voucher extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'mediafy_voucher';

    const TABLE = 'mediafy_voucher';
    const COLUMN_ID = 'id';
    const COLUMN_CODE = 'code';
    const COLUMN_STATUS = 'status';
    const COLUMN_EXPIRATION_DATE = 'expiration_date';

    const STATUS_UNUSED = 'unused';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_USED = 'used';

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Mediafy\Voucher\Model\ResourceModel\Voucher::class);
    }

    /**
     * Set voucher status
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status)
    {
        return $this->setData(self::COLUMN_STATUS, $status);
    }

    /**
     * Get voucher status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::COLUMN_STATUS);
    }

    /**
     * Set expiration date of voucher
     *
     * @param string|null $expirationDate
     *
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        return $this->setData(self::COLUMN_EXPIRATION_DATE, $expirationDate);
    }

    /**
     * Get expiration date of voucher
     *
     * @return string|null
     */
    public function getExpirationDate()
    {
        return $this->getData(self::COLUMN_EXPIRATION_DATE);
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
<?php

namespace Mediafy\Voucher\Model;

use Magento\Framework\Stdlib\DateTime\DateTime;

class Validator
{
    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @param DateTime $dateTime
     */
    public function __construct(
        DateTime $dateTime
    ) {
        $this->dateTime = $dateTime;
    }

    /**
     * Check is voucher is valid.
     *
     * Voucher is valid when:
     * - Case 1
     * - Case 2
     * - Case 3
     *
     * @param Voucher $voucher
     * @return bool
     */
    public function isValid(Voucher $voucher)
    {
        return ($voucher->getStatus() === Voucher::STATUS_UNUSED)
            && !$this->isExpired($voucher);
    }

    /**
     * Check if voucher is expired
     *
     * @param Voucher $voucher
     * @return bool
     */
    public function isExpired(Voucher $voucher)
    {
        return ($voucher->getExpirationDate() <= $this->dateTime->date());
    }
}
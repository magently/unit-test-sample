<?php

namespace Mediafy\Voucher\Test\Unit\Model;

use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\TestFramework\Unit\BaseTestCase;
use Mediafy\Voucher\Model\Validator;
use Mediafy\Voucher\Model\Voucher;

class ValidatorTest extends BaseTestCase
{
    /**
     * @var Voucher|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $voucher;

    /**
     * @var Validator
     */
    protected $validator;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->voucher = $this->createMock(Voucher::class);
        $this->dateTime = $this->createPartialMock(DateTime::class, ['date']);
        $this->validator = $objectManager->getObject(
            Validator::class,
            [
                'dateTime' => $this->dateTime
            ]
        );
    }

    /**
     * Test if voucher is valid
     *
     * @return void
     */
    public function testIsVoucherValid()
    {
        $this->dateTime->method('date')->willReturn('2020-01-01 00:00:00');
        $this->voucher
            ->expects($this->any())
            ->method('getStatus')
            ->willReturn(Voucher::STATUS_UNUSED);
        $this->voucher
            ->expects($this->any())
            ->method('getExpirationDate')
            ->willReturn('2020-12-31 23:59:59');

        $this->assertEquals(true, $this->validator->isValid($this->voucher));
    }
}
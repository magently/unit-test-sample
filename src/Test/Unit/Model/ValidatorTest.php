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
     * @param string $status
     * @param string $expirationDate
     * @param string $currentDate
     * @param bool $expectedResult
     * @return void
     *
     * @dataProvider getVoucherValidationTestData
     */
    public function testIsVoucherValid(string $status, string $expirationDate, string $currentDate, bool $expectedResult)
    {
        $this->dateTime->method('date')->willReturn($currentDate);
        $this->voucher
            ->expects($this->any())
            ->method('getStatus')
            ->willReturn($status);
        $this->voucher
            ->expects($this->any())
            ->method('getExpirationDate')
            ->willReturn($expirationDate);

        $this->assertEquals($expectedResult, $this->validator->isValid($this->voucher));
    }

    /**
     * Test if voucher has expired
     *
     * @param string $expirationDate
     * @param string $currentDate
     * @param bool $expectedResult
     * @return void
     *
     * @dataProvider getVoucherExpirationTestData
     */
    public function testIsVoucherExpired(string $expirationDate, string $currentDate, bool $expectedResult)
    {
        $this->dateTime->method('date')->willReturn($currentDate);
        $this->voucher
            ->expects($this->once())
            ->method('getExpirationDate')
            ->willReturn($expirationDate);

        $this->assertEquals($expectedResult, $this->validator->isExpired($this->voucher));
    }

    /**
     * Voucher validation data set
     *
     * @return array
     */
    public function getVoucherValidationTestData(): array
    {
        return [
            [Voucher::STATUS_UNUSED, '2020-12-31 23:59:59', '2020-01-01 00:00:00', true],
            [Voucher::STATUS_USED, '2020-12-31 23:59:59', '2020-01-01 00:00:00', false],
            [Voucher::STATUS_UNUSED, '2020-01-01 00:00:00', '2020-12-31 23:59:59', false],
            [Voucher::STATUS_USED, '2020-01-01 00:00:00', '2020-12-31 23:59:59', false],
        ];
    }

    /**
     * Voucher expiration data set
     *
     * @return array
     */
    public function getVoucherExpirationTestData(): array
    {
        return [
            ['2020-12-31 23:59:59', '2020-01-01 00:00:00', false],
            ['2020-01-01 00:00:00', '2020-12-31 23:59:59', true],
        ];
    }
}
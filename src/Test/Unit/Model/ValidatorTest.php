<?php

namespace Mediafy\Voucher\Test\Unit\Model;

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
        $this->voucher = $this->createMock(Voucher::class);
        $this->validator = new Validator();
    }

    /**
     * Test if voucher is valid
     *
     * @return void
     */
    public function testIsVoucherValid()
    {
        $this->assertEquals(true, $this->validator->isValid($this->voucher));
    }
}
<?php
declare(strict_types=1);
namespace app\services\Payment;

/**
 * Interface PaymentInterface
 * @package app\services\Payment
 */
interface PaymentInterface
{
    public function bill(PaymentRequestDto $paymentRequestDto): PaymentResponseDto;
}

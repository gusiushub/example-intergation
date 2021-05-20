<?php
declare(strict_types=1);
namespace app\services\Payment;

/**
 * Class PaymentResponse
 * @package app\services\Payment
 */
class PaymentResponseDto
{
    /**
     * @var int
     */
    public int $statusCode;

    /**
     * @var string|null
     */
    public ?string $description;

    /**
     * PaymentResponse constructor.
     * @param int $statusCode
     * @param string|null $description
     */
    public function __construct(int $statusCode, ?string $description)
    {
        $this->statusCode = $statusCode;
        $this->description = $description;
    }
}

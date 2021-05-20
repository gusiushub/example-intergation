<?php
declare(strict_types=1);
namespace app\services\Payment;

/**
 * Class PaymentRequestDto
 * @package app\services\Payment
 */
class PaymentRequestDto
{
    /**
     * @var int
     * @property-read
     */
    public int $clientId;

    /**
     * @var float
     * @property-read
     */
    public float $cost;

    /**
     * @var string|null
     * @property-read
     */
    public ?string $category;

    /**
     * @var string|null
     * @property-read
     */
    public ?string $description;

    /**
     * PaymentRequestDto constructor.
     * @param int $clientId
     * @param float $cost
     * @param string|null $category
     * @param string|null $description
     */
    public function __construct(int $clientId, float $cost, ?string $category, ?string $description)
    {
        $this->clientId = $clientId;
        $this->cost = $cost;
        $this->category = $category;
        $this->description = $description;
    }
}

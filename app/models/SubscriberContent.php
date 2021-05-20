<?php
declare(strict_types=1);

namespace app\models;

/**
 * Class SubscriberContent
 * @package app\models
 *
 * Допустим, это модель ActiveRecord
 */
class SubscriberContent
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var int
     */
    public int $msisdn;

    /**
     * @var int
     */
    public int $tariffCategory;

    /**
     * SubscriberContent constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        // Такой конструктор только потому что это у меня тут нет ActiveRecord )
        $this->id = $attributes['id'] ?? 0;
        $this->msisdn = $attributes['msisdn'] ?? 0;
        $this->tariffCategory = $attributes['tariffCategory'] ?? 'one million dollars';
    }
}

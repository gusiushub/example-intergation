<?php
declare(strict_types=1);

namespace app\services\Payment;

use app\models\SubscriberContent;

/**
 * Class PaymentRequestFactory
 * @package app\services\Payment
 */
class PaymentRequestFactory
{
    /**
     * @param SubscriberContent $subscriberContent
     * @return PaymentRequestDto
     */
    public static function createSubscriberContent(SubscriberContent $subscriberContent): PaymentRequestDto
    {
        return new PaymentRequestDto(
            $subscriberContent->msisdn,
            100.500, // Это тупо пример, а не магическое число )
            $subscriberContent->tariffCategory ?? 'free', // Не забывай про null
            'I AM RBT PLFTORFM, BITCH!!!' // Можно перенести в конфиг сервиса и не пробрасывать через DTO
        );
    }
}

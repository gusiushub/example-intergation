<?php
declare(strict_types=1);

require(__DIR__ . '/../vendor/autoload.php');

// Представь, что получил это из бд
$subscriberContent = new \app\models\SubscriberContent([
    'id' => 1,
    'msisdn' => 79998886677,
    'tariffCategory' => 'one dollar',
]);

$request = \app\services\Payment\PaymentRequestFactory::createSubscriberContent($subscriberContent);

// У меня тут нет DI, но ты будешь получать JsonApiMtsPaymentSystem через интерфейс PaymentInterface
// Можно через конструктор, можно через Yii::$container->get(PaymentInterface::class);
// А в конфиге defintions просто пропишешь какая реализация у тебя сейчас ипользуется для интерфейса

$transaction = new class {
    public function rollback()
    {
        //...
    }

    public function commit()
    {
        //...
    }
};


try {
    $response = new \app\services\Payment\JsonApiMtsPaymentSystem([
        // Тут конфиг для Guzzle. Лучше впецифичные для guzzle штуки сюда не писать для простой замены реализации
    ]);

    /*
     * Псевдокод
     * write to database response->status, response->description
     */

    $transaction->commit();
} catch (\app\exceptions\ApiException $exception) {
    $transaction->rollback();
    // Тут пишешь в лог, что внешний сервис прилег или отвечает не очень хорошо )
    throw $exception;
} catch (\Throwable $exception) {
    // А тут пишешь, что то еще
    $transaction->rollback();
    throw $exception;
}

<?php
declare(strict_types=1);

namespace app\services\Payment;

use app\exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JsonApiMtsPaymentSystem
 * @package app\services\Payment
 */
class JsonApiMtsPaymentSystem implements PaymentInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * JsonApiMtsPaymentSystem constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->client = new Client($config);
        // У меня Yii тут нет, я сделал просто. В твоем случае просто public проперти и все
    }

    /**
     * @param PaymentRequestDto $paymentRequestDto
     * @return PaymentResponseDto
     * @throws ApiException
     */
    public function bill(PaymentRequestDto $paymentRequestDto): PaymentResponseDto
    {
        // DTO позволяет тебе называть атрибуты так, как принято в проекте.
        // Именно здесь происходит маппинг названий внешнего сервиса и внутренних. Это методология DDD, детка
        $response = $this->sendRequest([
            'msisdn' => $paymentRequestDto->clientId,
            'money' => $paymentRequestDto->cost,
            'description' => $paymentRequestDto->category,
            'olololoIAmMTS' => $paymentRequestDto->description,
        ]);

        // Если скажешь Guzzle, что ждешь json на выходе, то $response->getBody()->getContents() это будет уже результат json decode
        return new PaymentResponseDto($response->getStatusCode(), $response->getBody()->getContents());
    }

    /**
     * @param array $data
     * @return ResponseInterface
     * @throws ApiException
     */
    private function sendRequest(array $data): ResponseInterface
    {
        try {
            // @todo Ну ясен красен, урлы в конфиге, хост в клиент прописывается в конструкторе. Это так, пример
            return $this->client->request('POST', 'https://api.mts.ru/bill', [
                'auth' => ['user', 'pass'],
                'body' => $data,
            ]);
        } catch (GuzzleException $exception) {
            // Тут оборачиваешь GuzzleException в ApiException, чтобы снаружи потребитель ничего не знал про Guzzle
            // Кто знает, может ты его на другую либу заменишь или на Curl или завтра скажут, что SOap используйте
            throw new ApiException($exception->getMessage());
        }
    }
}

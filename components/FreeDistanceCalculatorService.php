<?php

namespace app\components;

use app\components\interfaces\DistanceCalculatorInterface;
use app\exceptions\InvalidCityPointsException;
use app\components\helpers\CoordinatesHelper;
use GuzzleHttp\Client;
use yii\base\BaseObject;
use yii\base\Exception;

/**
 * Class DistanceCalculatorService
 *
 * Сервис для вычисления расстояния между городами.
 */
class FreeDistanceCalculatorService extends BaseObject implements DistanceCalculatorInterface
{
    /**
     * URL сайта, к которому обращаться за данными о координатах.
     */
    const SITE_URL = 'http://search.maps.sputnik.ru/search/addr?q=';

    /**
     * HTTP клиент.
     *
     * @var Client
     */
    private $httpClientComponent;

    public function __construct(Client $httpClientComponent, $config = [])
    {
        $this->httpClientComponent = $httpClientComponent;

        parent::__construct($config);
    }

    /**
     * {@inheritDoc}
     */
    public function getDistanceBetweenCities(string $startCityName, string $endCityName): int
    {
        $startCityCoordinates = $this->getCityCoordinates($startCityName);
        $endCityCoordinates = $this->getCityCoordinates($endCityName);

        $distance = CoordinatesHelper::getDistanceBetweenTwoCoordinates(...$startCityCoordinates, ...$endCityCoordinates);

        if (!$distance) {
            throw new InvalidCityPointsException('Incorrect city points.');
        }

        return $distance;
    }

    /**
     * Получение координат по названию города.
     *
     * @param string $cityName
     *
     * @return array
     * @throws Exception при ответе сервера не равном 200.
     */
    private function getCityCoordinates(string $cityName): array
    {
        $response = $this->httpClientComponent->get(self::SITE_URL . $cityName);

        if ($response->getStatusCode() != 200) {
            throw new Exception('Bad response. Status code != 200');
        }

        $body = json_decode($response->getBody()->getContents());
        if (!empty($body->result->address[0]->features[0]->geometry->geometries[0]->coordinates)) {
            return $body->result->address[0]->features[0]->geometry->geometries[0]->coordinates;
        }
    }
}

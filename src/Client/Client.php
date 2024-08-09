<?php

namespace S25\ShipCalcSDK\Client;

use GuzzleHttp\Promise\Utils;
use S25\ShipCalcSDK\Request\Request;
use S25\ShipCalcSDK\Response\Response;
use S25\ShipCalcSDK\Settings\Settings;
use GuzzleHttp\Client as GuzzleHttpClient;
use Throwable;

class Client
{
    protected Settings $settings;
    protected GuzzleHttpClient $httpClient;
    protected ?Request $request = null;
    protected ?Response $response = null;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;

        $this->httpClient = new GuzzleHttpClient([
            'base_uri' => $settings->getApiHost(),
            'headers' => $this->getHeaders(),
            'connect_timeout' => 60,
            'read_timeout' => 120,
            'timeout' => 120,
        ]);
    }

    protected function getHeaders(): array
    {
        return ['Content-Type' => 'application/json'];
    }

    public function getRequest(): Request
    {
        if (!$this->request) {
            $this->request = new Request();
        }
        return $this->request;
    }

    public function getResponseObject(): Response
    {
        if (!$this->response) {
            throw new \RuntimeException('Response is not ready');
        }
        return $this->response;
    }

    /**
     * @return self
     * @throws Throwable
     */
    public function calc(): self
    {
        $this->response = null; // Обнуляем response перед новым расчетом
        $requests = $this->getRequest()->toArray();

        foreach (array_chunk($requests, 10) as $requestsPart) {
            $promises = array_map(function ($request) {
                return $this->httpClient->postAsync($this->settings->getApiUrl(), ['body' => json_encode($request)]);
            }, $requestsPart);

            $responses = Utils::unwrap($promises);

            $response = new Response($requestsPart, $responses);

            if ($this->response instanceof Response) {
                $this->response = $response->mergeResponses($this->response);
            } else {
                $this->response = $response;
            }
        }

        return $this;
    }
}

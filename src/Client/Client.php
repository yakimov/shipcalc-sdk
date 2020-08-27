<?php

namespace S25\ShipCalcSDK\Client;

use S25\ShipCalcSDK\Request\Request;
use S25\ShipCalcSDK\Response\Response;
use S25\ShipCalcSDK\Settings\Settings;

use GuzzleHttp\Client as GuzzleHttpClient;
use function GuzzleHttp\Promise\settle;

class Client
{
    /** @var Settings */
    protected $settings;
    protected $httpClient;
    protected $request;
    protected $response;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;

        $this->httpClient  = new GuzzleHttpClient([
            'base_uri' => $settings->getApiHost(),
            'headers'  => $this->getHeaders(),
            'connect_timeout' => 10,
            'read_timeout' => 60,
            'timeout' => 10,
        ]);
    }

    /**
     * @return array
     */
    protected function getHeaders(): array
    {
        return ['Content-Type' => 'application/json'];
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        if (!isset($this->request)) {
            $this->request = new Request();
        }
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        if (!isset($this->response)) {
            throw new ResponseNotReadyException('Response is not ready');
        }
        return $this->response;
    }

    /**
     * @return self
     */
    public function calc(): self
    {
        $this->response = null;
        $requests = $this->getRequest()->toArray();

        foreach (array_chunk($requests, 10) as $requestsPart) {
            $promises = array_map(function ($request) {
                return $this->httpClient->postAsync($this->settings->getApiUrl(), [ 'body' => json_encode($request)]);
            }, $requestsPart);
            $response = new Response($requestsPart, settle($promises)->wait());

            if ($this->response instanceof Response) {
                $this->response = $response->mergeResponses($this->response);
            } else {
                $this->response = $response;
            }
        }

        return $this;
    }
}

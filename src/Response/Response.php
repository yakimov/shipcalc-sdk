<?php

namespace S25\ShipCalcSDK\Response;

class Response
{
    protected $response;
    protected $request;

    public function __construct($request, $response)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->prepareResponse();
        $this->mergeRequestToResponse();
    }

    protected function prepareResponse(): void
    {
        $responseJson = array_map(static function ($response) {
            /** @var $response \GuzzleHttp\Psr7\Response [] */
            return $response['state'] === 'fulfilled' ? (string) $response['value']->getBody() : false;
        }, $this->response);

        $this->response = array_map(static function ($responseJson) {
            return is_string($responseJson) ? json_decode($responseJson, true) : false;
        }, $responseJson);
    }

    protected function mergeRequestToResponse(): void
    {
        $result = [];
        foreach ($this->request as $i => $request) {
            $result[$i]['request']  = $request;
            $result[$i]['response'] = $this->response[$i]['deliveries'];
        }
        $this->response = $result;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function mergeResponses(Response $response): Response
    {
        $this->response = array_merge($this->response, $response->getResponse());
        $this->request  = array_merge($this->request, $response->getRequest());

        return $this;
    }

    /**
     * @return ResponseQuery
     */
    public function getResponseQuery(): ResponseQuery
    {
        return new ResponseQuery($this->response);
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->response;
    }
}

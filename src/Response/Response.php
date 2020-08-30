<?php

namespace S25\ShipCalcSDK\Response;

class Response
{
    protected array $request;
    protected array $response;

    public function __construct(array $request, array $response)
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

    /**
     * @param array $request
     * @return string
     */
    protected function generateKeyByRequest(array $request)
    {
        return sprintf('%s:%s:%s:%s:%s',
                       $request['source']['country'],
                       $request['source']['zip'] ?? '',
                       $request['destination']['country'],
                       $request['destination']['zip'] ?? '',
                       $request['products'][0]['weight']);
    }

    protected function mergeRequestToResponse(): void
    {
        $result = [];
        foreach ($this->request as $i => $request) {
            $result[$this->generateKeyByRequest($request)] = $this->response[$i]['deliveries'] ?? null;
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
     * @return array
     */
    public function asArray(): array
    {
        return $this->response;
    }
}

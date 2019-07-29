<?php

namespace S25\ShipCalcSDK\Response;

class ResponseQuery
{
    protected $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function getCheapestShipping(): array
    {
        $result = [];
        foreach ($this->response as $response) {
            $lowPrice = null;
            if (is_array($response['response'])) {
                $lowPrice = array_reduce($response['response'], static function ($lowPrice, $price) {
                    return (isset($price['price']) && $price['price'] < $lowPrice) ? $price['price'] : $lowPrice;
                }, PHP_FLOAT_MAX);
                $lowPrice = ($lowPrice === PHP_FLOAT_MAX) ? null : $lowPrice;
            }

            $weight = $response['request']['products'][0]['weight'];
            $key = sprintf(
                '%s:%s:%s',
                $response['request']['source']['country'],
                $response['request']['destination']['country'],
                $response['request']['currency']
            );
            $result[$key] = [$weight => $lowPrice];
        }
        return $result;
    }
}

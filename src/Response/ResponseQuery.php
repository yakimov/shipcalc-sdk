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
    public function getArray(): array
    {
        $result = [];
        foreach ($this->response as $response) {
            $countryFrom = $response['request']['source']['country'] ?? '';
            $stateFrom = $response['request']['source']['state'] ?? '';
            $zipFrom = $response['request']['source']['zip'] ?? '';
            $countryTo = $response['request']['destination']['country'] ?? '';
            $stateTo = $response['request']['destination']['state'] ?? '';
            $zipTo = $response['request']['destination']['zip'] ?? '';
            $currency = $response['request']['currency'];
            $weight = $response['request']['products'][0]['weight'];

            $key = sprintf(
                '%s:%s:%s:%s:%s:%s:%s',
                $countryFrom,
                $stateFrom,
                $zipFrom,
                $countryTo,
                $stateTo,
                $zipTo,
                $currency
            );

            $deliveryList = [];
            foreach ($response['response'] as $deliveryUid => $deliveryData) {
                if (is_null($deliveryData)) {
                    continue;
                }
                $deliveryList[$weight][$deliveryUid] = $deliveryData['price'];
            }
            $result[$key] = $deliveryList;
        }
        return $result;
    }
}

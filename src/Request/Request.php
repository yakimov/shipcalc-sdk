<?php

namespace S25\ShipCalcSDK\Request;

use S25\ShipCalcSDK\Place\PlaceInterface;
use S25\ShipCalcSDK\Product\ProductInterface;

class Request
{
    protected $request = ['0' => []];

    /**
     * @param array $parameters
     * @param $name
     */
    protected function setRequestParameter(array $parameters, $name): void
    {
        $result = [];
        $parameters = $this->extractInputParameters($parameters);
        foreach ($this->request as $request) {
            $result[] = array_map(static function ($parameter) use($request, $name) {
                $isPlace = ($parameter instanceof PlaceInterface);
                /** @var PlaceInterface $parameter | array | string */
                return array_merge($request, [$name => $isPlace ? $parameter->toArray() : $parameter ]);
            }, $parameters);
        }
        $this->request = array_merge(...$result);
    }

    /**
     * @param array $input
     * @return array
     */
    protected function extractInputParameters(array $input): array
    {
        if (is_array(reset($input))) {
            $input = array_merge(...$input);
        }

        return $input;
    }

    /**
     * @param PlaceInterface ...$places
     * @return Request
     */
    public function setFrom(...$places): self
    {
        $this->setRequestParameter($places, 'source');
        return $this;
    }

    /**
     * @param PlaceInterface ...$places
     * @return Request
     */
    public function setTo(...$places): self
    {
        $this->setRequestParameter($places, 'destination');
        return $this;
    }

    /**
     * @param string ...$currencies
     * @return Request
     */
    public function setCurrency(...$currencies): self
    {
        $this->setRequestParameter($currencies, 'currency');
        return $this;
    }

    /**
     * @param ProductInterface ...$products
     * @return Request
     */
    public function setProduct(...$products): self
    {
        $products = $this->extractInputParameters($products);
        foreach (array_keys($this->request) as $key) {
            $this->request[$key]['products'] = array_map(static function (ProductInterface $product) {
                return $product->toArray();
            }, $products);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->request;
    }
}
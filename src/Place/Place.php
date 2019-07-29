<?php

namespace S25\ShipCalcSDK\Place;

class Place implements PlaceInterface
{
    protected $country;
    protected $stateCode;
    protected $cityCode;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): PlaceInterface
    {
        $this->country = $country;
        return $this;
    }

    public function getStateCode(): ?string
    {
        return $this->stateCode;
    }

    public function setStateCode(string $stateCode): PlaceInterface
    {
        $this->stateCode = $stateCode;
        return $this;
    }

    public function getCityCode(): ?string
    {
        return $this->cityCode;
    }

    public function setCityCode(string $cityCode): PlaceInterface
    {
        $this->cityCode = $cityCode;
        return $this;
    }

    public function toArray(): array
    {
        $result['country'] = $this->getCountry();

        if ($this->getStateCode()) {
            $result['country'] = $this->getStateCode();
        }

        if ($this->getCityCode()) {
            $result['city'] = $this->getCityCode();
        }
        return $result;
    }
}

<?php

namespace S25\ShipCalcSDK\Place;

class Place implements PlaceInterface
{
    protected $country;
    protected $state;
    protected $city;
    protected $zip;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): PlaceInterface
    {
        $this->country = $country;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): PlaceInterface
    {
        $this->state = $state;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): PlaceInterface
    {
        $this->city = $city;
        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): PlaceInterface
    {
        $this->zip = $zip;
        return $this;
    }

    public function toArray(): array
    {
        $result['country'] = $this->getCountry();

        if ($this->getState()) {
            $result['state'] = $this->getState();
        }

        if ($this->getCity()) {
            $result['city'] = $this->getCity();
        }

        if ($this->getZip()) {
            $result['zip'] = $this->getZip();
        }

        return $result;
    }
}

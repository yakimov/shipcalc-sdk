<?php

namespace S25\ShipCalcSDK\Place;

interface PlaceInterface
{
    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @param string $country
     * @return self
     */
    public function setCountry(string $country): PlaceInterface;

    /**
     * @return string
     */
    public function getStateCode(): ?string;

    /**
     * @param mixed $stateCode
     * @return PlaceInterface
     */
    public function setStateCode(string $stateCode): PlaceInterface;

    /**
     * @return string
     */
    public function getCityCode(): ?string;

    /**
     * @param mixed $cityCode
     * @return PlaceInterface
     */
    public function setCityCode(string $cityCode): PlaceInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}
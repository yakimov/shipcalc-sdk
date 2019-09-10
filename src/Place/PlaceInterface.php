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
    public function getState(): ?string;

    /**
     * @param mixed $state
     * @return PlaceInterface
     */
    public function setState(string $state): PlaceInterface;

    /**
     * @return string
     */
    public function getCity(): ?string;

    /**
     * @param mixed $city
     * @return PlaceInterface
     */
    public function setCity(string $city): PlaceInterface;

    /**
     * @return string
     */
    public function getZip(): ?string;

    /**
     * @param string $zip
     * @return PlaceInterface
     */
    public function setZip(string $zip): PlaceInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}
<?php

namespace S25\ShipCalcSDK\Product;

interface ProductInterface
{
    /**
     * @return int
     */
    public function getWeight(): int;

    /**
     * @param int $weight
     * @return ProductInterface
     */
    public function setWeight(int $weight): ProductInterface;

    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @param int $height
     * @return ProductInterface
     */
    public function setHeight(int $height): ProductInterface;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @param int $width
     * @return ProductInterface
     */
    public function setWidth(int $width): ProductInterface;

    /**
     * @return int
     */
    public function getLength(): int;

    /**
     * @param int $length
     * @return ProductInterface
     */
    public function setLength(int $length): ProductInterface;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     * @return ProductInterface
     */
    public function setPrice(float $price): ProductInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}

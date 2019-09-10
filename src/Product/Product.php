<?php

declare(strict_types=1);

namespace S25\ShipCalcSDK\Product;

class Product implements ProductInterface
{
    /** @var int */
    protected $weight;
    /** @var int */
    protected $height;
    /** @var int */
    protected $width;
    /** @var int */
    protected $length;
    /** @var float */
    protected $price;

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): ProductInterface
    {
        $this->weight = $weight;
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): ProductInterface
    {
        $this->height = $height;
        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): ProductInterface
    {
        $this->width = $width;
        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): ProductInterface
    {
        $this->length = $length;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): ProductInterface
    {
        $this->price = $price;
        return $this;
    }

    public function toArray(): array
    {
        $result = [];
        $result = array_merge($result, ['weight' => $this->getWeight()]);

        if ($this->getPrice()) {
            $result = array_merge($result, ['price' => $this->getPrice()]);
        }
        if ($this->getHeight() && $this->getWeight() && $this->getLength()) {
            $result = array_merge($result, ['dimensions' => [
                'height'    => $this->getHeight(),
                'width'     => $this->getWidth(),
                'length'    => $this->getLength()
            ]]);
        }
        return $result;
    }
}

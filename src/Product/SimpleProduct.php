<?php

namespace S25\ShipCalcSDK\Product;

class SimpleProduct extends Product
{
    public function __construct()
    {
        $this->setWeight(500)->setHeight(1)->setLength(1)->setWidth(1)->setPrice(0);
    }
}

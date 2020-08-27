<?php

namespace S25\ShipCalcSDK\Response;

class ShippingCost
{
    protected $name;
    protected $uid;
    protected $box;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ShippingCost
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return ShippingCost
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * @param mixed $box
     * @return ShippingCost
     */
    public function setBox($box)
    {
        $this->box = $box;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     * @return ShippingCost
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return ShippingCost
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return ShippingCost
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    protected $weight;
    protected $currency;
    protected $price;
}

<?php

namespace S25\ShipCalcSDK\Settings;

class Settings
{
    protected $apiHost      = 'http://postcalc.s25.ru';
    protected $apiUrl       = '/api/v1.0/calculate/';
    protected $redisHost    = 'localhost';
    protected $redisPort    = 6379;
    protected $redisPass    = '';
    protected $redisDb      = 0;

    /**
     * @return mixed
     */
    public function getApiHost()
    {
        return $this->apiHost;
    }

    /**
     * @param mixed $apiHost
     * @return self
     */
    public function setApiHost($apiHost): self
    {
        $this->apiHost = $apiHost;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param mixed $apiUrl
     * @return self
     */
    public function setApiUrl($apiUrl): self
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRedisHost()
    {
        return $this->redisHost;
    }

    /**
     * @param mixed $redisHost
     * @return self
     */
    public function setRedisHost($redisHost): self
    {
        $this->redisHost = $redisHost;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRedisPort()
    {
        return $this->redisPort;
    }

    /**
     * @param mixed $redisPort
     * @return self
     */
    public function setRedisPort($redisPort): self
    {
        $this->redisPort = $redisPort;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRedisPass()
    {
        return $this->redisPass;
    }

    /**
     * @param mixed $redisPass
     * @return self
     */
    public function setRedisPass($redisPass): self
    {
        $this->redisPass = $redisPass;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRedisDb()
    {
        return $this->redisDb;
    }

    /**
     * @param mixed $redisDb
     * @return self
     */
    public function setRedisDb($redisDb): self
    {
        $this->redisDb = $redisDb;
        return $this;
    }
}

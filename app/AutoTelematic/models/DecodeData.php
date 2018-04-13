<?php
/**
 * Model for the decode response.
 *
 * @author: Cuesta
 */

namespace App\AutoTelematic\models;

class DecodeData extends BaseModel
{
    private $_vin,
            $_aaia,
            $_make,
            $_year,
            $_model,
            $_engine,
            $_engineType;

    /**
     * @return mixed
     */
    public function getVin()
    {
        return $this->_vin;
    }

    /**
     * @param mixed $vin
     * @return DecodeData
     */
    public function setVin($vin)
    {
        $this->_vin = $vin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAaia()
    {
        return $this->_aaia;
    }

    /**
     * @param mixed $aaia
     * @return DecodeData
     */
    public function setAaia($aaia)
    {
        $this->_aaia = $aaia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMake()
    {
        return $this->_make;
    }

    /**
     * @param mixed $make
     * @return DecodeData
     */
    public function setMake($make)
    {
        $this->_make = $make;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->_year;
    }

    /**
     * @param mixed $year
     * @return DecodeData
     */
    public function setYear($year)
    {
        $this->_year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param mixed $model
     * @return DecodeData
     */
    public function setModel($model)
    {
        $this->_model = $model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEngine()
    {
        return $this->_engine;
    }

    /**
     * @param mixed $engine
     * @return DecodeData
     */
    public function setEngine($engine)
    {
        $this->_engine = $engine;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEngineType()
    {
        return $this->_engineType;
    }

    /**
     * @param mixed $engineType
     * @return DecodeData
     */
    public function setEngineType($engineType)
    {
        $this->_engineType = $engineType;
        return $this;
    }
}
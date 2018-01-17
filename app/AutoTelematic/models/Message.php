<?php
/**
 * Model for the message data of a response.
 *
 * @author: Cuesta
 */

namespace App\AutoTelematic\models;


class Message extends BaseModel
{
    private     $_code,
                $_message,
                $_credentials,
                $_version,
                $_method,
                $action;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param mixed $code
     * @return Message
     */
    public function setCode($code)
    {
        $this->_code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->_message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->_credentials;
    }

    /**
     * @param mixed $credentials
     * @return Message
     */
    public function setCredentials($credentials)
    {
        $this->_credentials = $credentials;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * @param mixed $version
     * @return Message
     */
    public function setVersion($version)
    {
        $this->_version = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * @param mixed $method
     * @return Message
     */
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return Message
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }
}
<?php

namespace Blast\DoctrineSessionBundle\Entity;

use Blast\BaseEntitiesBundle\Entity\Traits\BaseEntity;
use Blast\BaseEntitiesBundle\Entity\Traits\Timestampable;

/**
 * Session
 */
class Session implements SessionInterface
{
    use BaseEntity,
        Timestampable
    ;
    
    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var string
     */
    private $data;
    
    /**
     *
     * @var Datetime
     */
    private $expiresAt;


    /**
     * Set sessionId
     *
     * @param string $sessionId
     * @return Session
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return Session
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Set expiresAt
     *
     * @param string $expiresAt
     * @return Session
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return string 
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
}

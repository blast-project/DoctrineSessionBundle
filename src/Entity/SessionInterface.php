<?php

namespace Blast\DoctrineSessionBundle\Entity;

interface SessionInterface
{
    /**
     * Set sessionId
     *
     * @param string $sessionId
     * @return Session
     */
    public function setSessionId($sessionId);

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId();

    /**
     * Set data
     *
     * @param string $data
     * @return Session
     */
    public function setData($data);

    /**
     * Get data
     *
     * @return string
     */
    public function getData();
    
    /**
     * Set expiresAt
     *
     * @param string $expiresAt
     * @return Session
     */
    public function setExpiresAt($expiresAt);

    /**
     * Get expiresAt
     *
     * @return string
     */
    public function getExpiresAt();
}

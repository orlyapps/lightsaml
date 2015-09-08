<?php

namespace LightSaml\Store\Credential;

use LightSaml\Credential\CredentialInterface;

class StaticCredentialStore implements CredentialStoreInterface
{
    /**
     * entityID => CredentialInterface[]
     * @var array
     */
    protected $credentials = array();

    /**
     * @param string $entityId
     *
     * @return CredentialInterface[]
     */
    public function getByEntityId($entityId)
    {
        $this->checkEntityIdExistence($entityId);

        return $this->credentials[$entityId];
    }

    /**
     * @param string $entityId
     *
     * @return bool
     */
    public function has($entityId)
    {
        return array_key_exists($entityId, $this->credentials);
    }

    /**
     * @param CredentialInterface $credential
     *
     * @return StaticCredentialStore
     */
    public function add(CredentialInterface $credential)
    {
        $this->checkEntityIdExistence($credential->getEntityId());

        $this->credentials[$credential->getEntityId()][] = $credential;

        return $this;
    }

    /**
     * @param string $entityId
     */
    private function checkEntityIdExistence($entityId)
    {
        if (false == $this->has($entityId)) {
            $this->credentials[$entityId] = array();
        }
    }
}

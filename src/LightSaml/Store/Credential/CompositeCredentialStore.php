<?php

namespace LightSaml\Store\Credential;

use LightSaml\Credential\CredentialInterface;

class CompositeCredentialStore implements CredentialStoreInterface
{
    /** @var CredentialStoreInterface[] */
    protected $stores = array();

    /**
     * @param string $entityId
     *
     * @return CredentialInterface[]
     */
    public function getByEntityId($entityId)
    {
        $result = array();
        foreach ($this->stores as $store) {
            $result = array_merge($result, $store->getByEntityId($entityId));
        }

        return $result;
    }

    /**
     * @param CredentialStoreInterface $store
     *
     * @return CompositeCredentialStore
     */
    public function add(CredentialStoreInterface $store)
    {
        $this->stores[] = $store;

        return $this;
    }
}

<?php

namespace LightSaml\Model\Metadata;

use LightSaml\Model\Context\DeserializationContext;
use LightSaml\Model\Context\SerializationContext;

class IndexedEndpoint extends Endpoint
{
    /** @var  int */
    protected $index;

    /** @var  bool|null */
    protected $isDefault;

    /**
     * @param bool|null $isDefault
     *
     * @return IndexedEndpoint
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault !== null ? (bool) $isDefault : null;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsDefaultString()
    {
        return $this->isDefault ? 'true' : 'false';
    }

    /**
     * @return bool|null
     */
    public function getIsDefaultBool()
    {
        return $this->isDefault;
    }

    /**
     * @param int $index
     *
     * @return IndexedEndpoint
     */
    public function setIndex($index)
    {
        $this->index = (int) $index;

        return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param \DOMNode             $parent
     * @param SerializationContext $context
     */
    public function serialize(\DOMNode $parent, SerializationContext $context)
    {
        $this->attributesToXml(array('index', 'isDefault'), $parent);
        parent::serialize($parent, $context);
    }

    /**
     * @param \DOMElement            $node
     * @param DeserializationContext $context
     *
     * @return void
     */
    public function deserialize(\DOMElement $node, DeserializationContext $context)
    {
        $this->attributesFromXml($node, array('index', 'isDefault'));

        parent::deserialize($node, $context);
    }
}

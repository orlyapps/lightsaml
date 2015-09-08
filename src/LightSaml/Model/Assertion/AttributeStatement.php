<?php

namespace LightSaml\Model\Assertion;

use LightSaml\Model\Context\DeserializationContext;
use LightSaml\Model\Context\SerializationContext;
use LightSaml\SamlConstants;

class AttributeStatement extends AbstractStatement
{
    /**
     * @var Attribute[]
     */
    protected $attributes = array();

    /**
     * @param Attribute $attribute
     *
     * @return AttributeStatement
     */
    public function addAttribute(Attribute $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * @return \LightSaml\Model\Assertion\Attribute[]
     */
    public function getAllAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     *
     * @return Attribute|null
     */
    public function getFirstAttributeByName($name)
    {
        if (is_array($this->getAllAttributes())) {
            foreach ($this->getAllAttributes() as $attribute) {
                if (null == $name || $attribute->getName() == $name) {
                    return $attribute;
                }
            }
        }

        return;
    }

    /**
     * @param \DOMNode             $parent
     * @param SerializationContext $context
     *
     * @return void
     */
    public function serialize(\DOMNode $parent, SerializationContext $context)
    {
        $result = $this->createElement('AttributeStatement', SamlConstants::NS_ASSERTION, $parent, $context);

        $this->manyElementsToXml($this->getAllAttributes(), $result, $context, null);
    }

    /**
     * @param \DOMElement            $node
     * @param DeserializationContext $context
     *
     * @return void
     */
    public function deserialize(\DOMElement $node, DeserializationContext $context)
    {
        $this->checkXmlNodeName($node, 'AttributeStatement', SamlConstants::NS_ASSERTION);

        $this->attributes = array();
        $this->manyElementsFromXml(
            $node,
            $context,
            'Attribute',
            'saml',
            'LightSaml\Model\Assertion\Attribute',
            'addAttribute'
        );
    }
}

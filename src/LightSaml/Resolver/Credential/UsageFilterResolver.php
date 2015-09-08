<?php

namespace LightSaml\Resolver\Credential;

use LightSaml\Credential\CredentialInterface;
use LightSaml\Criteria\CriteriaSet;
use LightSaml\Credential\Criteria\UsageCriteria;

class UsageFilterResolver extends AbstractQueryableResolver
{
    /**
     * @param CriteriaSet           $criteriaSet
     * @param CredentialInterface[] $arrCredentials
     *
     * @return CredentialInterface[]
     */
    public function resolve(CriteriaSet $criteriaSet, array $arrCredentials = array())
    {
        if (false == $criteriaSet->has(UsageCriteria::class)) {
            return $arrCredentials;
        }

        $result = array();
        foreach ($criteriaSet->get(UsageCriteria::class) as $criteria) {
            /** @var UsageCriteria $criteria */
            foreach ($arrCredentials as $credential) {
                if (false == $credential->getUsageType() || $criteria->getUsage() == $credential->getUsageType()) {
                    $result[] = $credential;
                }
            }
        }

        return $result;
    }
}

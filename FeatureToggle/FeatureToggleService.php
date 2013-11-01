<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\FeatureToggle;


class FeatureToggleService
{
    protected $features = array();

    /**
     * @param array $features
     */
    public function __construct($features)
    {
        foreach ($features as $name => $featureToggleConfig) {
            $this->features[$name] = new FeatureToggle($name, $featureToggleConfig['state'], $featureToggleConfig['description']);
        }
    }

    /**
     * Returns a list of FeatureToggles
     *
     * @return array
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Returns a FeatureToggle
     *
     * @param string $featureToggleName
     * @return FeatureToggle
     */
    public function getFeature($featureToggleName)
    {
        return isset($this->features[$featureToggleName]) ? $this->features[$featureToggleName] : null;
    }

    /**
     * Is a FeatureToggle enabled
     *
     * @param string $featureToggleName
     * @return boolean
     */
    public function isEnabled($featureToggleName)
    {
        $featureToggle = $this->getFeature($featureToggleName);
        if ($featureToggle == null) {
            return false;
        }

        return $featureToggle->isEnabled();
    }

    /**
     * Enables a FeatureToggle
     *
     * @param $featureToggleName
     * @return FeatureToggle
     */
    public function enable($featureToggleName)
    {
        $featureToggle = $this->getFeature($featureToggleName);
        if ($featureToggle == null) {
            return null;
        }
        $featureToggle->setState(FeatureToggle::STATE_ENABLED);
        return $featureToggle;
    }

    /**
     * Disables a FeatureToggle
     *
     * @param $featureToggleName
     * @return FeatureToggle
     */
    public function disable($featureToggleName)
    {
        $featureToggle = $this->getFeature($featureToggleName);
        if ($featureToggle == null) {
            return null;
        }
        $featureToggle->setState(FeatureToggle::STATE_DISABLED);
        return $featureToggle;
    }

}
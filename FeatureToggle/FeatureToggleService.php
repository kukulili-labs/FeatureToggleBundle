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

use Symfony\Component\HttpFoundation\Session\Session;

class FeatureToggleService
{
    const SESSION_PREFIX = 'feature_toggle.';

    protected $session;
    protected $features = array();

    /**
     * @param array $features
     * @param Session $session
     */
    public function __construct(array $features, Session $session)
    {
        $this->session = $session;
        foreach ($features as $featureToggleName => $featureToggleConfig) {
            if ($this->session->has(self::SESSION_PREFIX . $featureToggleName)) {
                $this->features[$featureToggleName] = $this->session->get(self::SESSION_PREFIX . $featureToggleName);
            } else {
                $this->features[$featureToggleName] = new FeatureToggle($featureToggleName, $featureToggleConfig['state'], $featureToggleConfig['description']);
            }
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
        if (isset($this->features[$featureToggleName])) {
            if ($this->session->has(self::SESSION_PREFIX . $featureToggleName)) {
                $this->features[$featureToggleName] = $this->session->get(self::SESSION_PREFIX . $featureToggleName);
            }
            return $this->features[$featureToggleName];
        }
        return null;
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
     * Enables a FeatureToggle for the active session
     *
     * @param $featureToggleName
     * @return FeatureToggle
     */
    public function enableForSession($featureToggleName)
    {
        $featureToggle = $this->getFeature($featureToggleName);
        if ($featureToggle == null) {
            return null;
        }
        $featureToggle->setState(FeatureToggle::STATE_ENABLED);
        $this->session->set(self::SESSION_PREFIX . $featureToggleName, $featureToggle);
        return $featureToggle;
    }

    /**
     * Disables a FeatureToggle for the active session
     *
     * @param $featureToggleName
     * @return FeatureToggle
     */
    public function disableForSession($featureToggleName)
    {
        $featureToggle = $this->getFeature($featureToggleName);
        if ($featureToggle == null) {
            return null;
        }
        $featureToggle->setState(FeatureToggle::STATE_DISABLED);
        $this->session->set(self::SESSION_PREFIX . $featureToggleName, $featureToggle);
        return $featureToggle;
    }

}
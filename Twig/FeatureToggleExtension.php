<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\Twig;

use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggleService;

class FeatureToggleExtension extends \Twig_Extension
{
    protected $featureToggleService;

    /**
     * @param FeatureToggleService $featureToggleService
     */
    public function __construct(FeatureToggleService $featureToggleService)
    {
        $this->featureToggleService = $featureToggleService;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'feature_toggle_is_enabled' => new \Twig_Function_Method($this, 'isFeatureToggleEnabled'),
        );
    }

    /**
     * Returns if a FeatureToggle is enabled
     *
     * @param string $featureToggleName
     * @return boolean
     */
    public function isFeatureToggleEnabled($featureToggleName)
    {
        if ($this->featureToggleService) {
            return $this->featureToggleService->isEnabled($featureToggleName);
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'feature_toggle';
    }
}
<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\DependencyInjection;

use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FeatureToggleExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['feature_toggles'])) {
            foreach ($config['feature_toggles'] as &$featureToggleConfig) {
                switch ($featureToggleConfig['state']) {
                    case 'enabled':
                        $featureToggleConfig['state'] = FeatureToggle::STATE_ENABLED;
                        break;
                    case 'disabled':
                        $featureToggleConfig['state'] = FeatureToggle::STATE_DISABLED;
                        break;
                }
                $container->setParameter($this->getAlias() . '.feature_toggles', $config['feature_toggles']);
            }
        }

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }

    public function getAlias()
    {
        return 'kukulili_labs_feature_toggle';
    }
}

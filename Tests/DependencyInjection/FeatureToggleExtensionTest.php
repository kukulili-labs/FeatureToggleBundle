<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\Tests\DependencyInjection;

use KukuliliLabs\FeatureToggleBundle\DependencyInjection\FeatureToggleExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

class FeatureToggleExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerBuilder */
    protected $configuration;

    public function testFeatureToggleConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new FeatureToggleExtension();
        $config = $this->getFullConfig();
        $loader->load(array($config), $this->configuration);
        $this->assertHasDefinition('kukulili_labs_feature_toggle.feature_toggles');
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testUserLoadThrowsExceptionUnlessFeatureToggleSet()
    {
        $loader = new FeatureToggleExtension();
        $config = $this->getFullConfig();
        $config['feature_toggles']['feature_toggle_enabled']['state'] = 'foo';
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @return array
     */
    protected function getFullConfig()
    {
        $yaml = <<<EOF
feature_toggles:
    feature_toggle_enabled:
        state: enabled
        description: This is a enabled feature toggle
    feature_toggle_disabled:
        state: disabled
        description: This is a disabled feature toggle

EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    /**
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    protected function tearDown()
    {
        unset($this->configuration);
    }
}
<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\Tests\Twig;

use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggle;
use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggleService;
use KukuliliLabs\FeatureToggleBundle\Twig\FeatureToggleExtension;

class FeatureToggleExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var FeatureToggleExtension */
    protected $extension;

    public function setUp()
    {
        $this->extension = new FeatureToggleExtension($this->getFeatureToggleService(array(
            'features' => array(
                'feature_toggle_enabled' => array(
                    'state' => FeatureToggle::STATE_ENABLED,
                    'description' => 'This is a enabled feature toggle'
                ),
                'feature_toggle_disabled' => array(
                    'state' => FeatureToggle::STATE_DISABLED,
                    'description' => 'This is a disabled feature toggle'
                )
            )
        )));
    }

    public function testIsFeatureToggleEnabled()
    {
        $this->assertTrue($this->extension->isFeatureToggleEnabled('feature_toggle_enabled'));
    }

    public function testIsFeatureToggleDisabled()
    {
        $this->assertFalse($this->extension->isFeatureToggleEnabled('feature_toggle_disabled'));
    }

    public function testIsDisabledIfFeatureToggleNotExist()
    {
        $this->assertFalse($this->extension->isFeatureToggleEnabled('wrong_feature_toggle'));
    }

    /**
     * @param array $args
     * @return FeatureToggleService
     */
    private function getFeatureToggleService(array $args)
    {
        return $this->getMockBuilder('KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggleService')
            ->setConstructorArgs($args)
            ->getMockForAbstractClass();
    }
}

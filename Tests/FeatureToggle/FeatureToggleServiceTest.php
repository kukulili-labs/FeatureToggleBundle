<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\Tests\FeatureToggle;

use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggle;
use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggleService;

class FeatureToggleServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var FeatureToggleService */
    private $featureToggleService;

    protected function setUp()
    {
        $this->featureToggleService = $this->getFeatureToggleService(array(
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
        ));
    }

    public function testGetAllFeatureToggles()
    {
        $featureToggles = $this->featureToggleService->getFeatures();
        $this->assertCount(2, $featureToggles);
    }

    public function testGetAFeatureToggle()
    {
        $featureToggle = $this->featureToggleService->getFeature('feature_toggle_enabled');
        $this->assertInstanceOf('KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggle', $featureToggle);
    }

    public function testIfFeatureToggleIsEnabled()
    {
        $isEnabled = $this->featureToggleService->isEnabled('feature_toggle_enabled');
        $this->assertTrue($isEnabled);
    }

    public function testUpdateStateToEnabled()
    {
        $featureToggle = $this->featureToggleService->enable('feature_toggle_disabled');
        $this->assertTrue($featureToggle->isEnabled());
    }

    public function testUpdateStateToDisabled()
    {
        $featureToggle = $this->featureToggleService->disable('feature_toggle_enabled');
        $this->assertFalse($featureToggle->isEnabled());
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

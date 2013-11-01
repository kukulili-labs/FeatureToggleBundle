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

class FeatureToggleTest extends \PHPUnit_Framework_TestCase
{
    const FEATURE_TOGGLE_NAME = 'FeatureToggle';
    const FEATURE_TOGGLE_DESCRIPTION = "Lorem ipsum";


    public function testName()
    {
        $featureToggle = $this->getFeatureToggle();
        $this->assertNull($featureToggle->getName());

        $featureToggle->setName(self::FEATURE_TOGGLE_NAME);
        $this->assertEquals(self::FEATURE_TOGGLE_NAME, $featureToggle->getName());
    }

    public function testDescription()
    {
        $featureToggle = $this->getFeatureToggle();
        $this->assertNull($featureToggle->getDescription());

        $featureToggle->setDescription(self::FEATURE_TOGGLE_DESCRIPTION);
        $this->assertEquals(self::FEATURE_TOGGLE_DESCRIPTION, $featureToggle->getDescription());
    }

    public function testState()
    {
        $featureToggle = $this->getFeatureToggle();
        $this->assertNull($featureToggle->getState());

        $featureToggle->setState(FeatureToggle::STATE_ENABLED);
        $this->assertEquals(FeatureToggle::STATE_ENABLED, $featureToggle->getState());
    }

    public function testIsEnabled()
    {
        $featureToggle = $this->getFeatureToggle();
        $this->assertNull($featureToggle->getState());

        $featureToggle->setState(FeatureToggle::STATE_ENABLED);
        $this->assertTrue($featureToggle->isEnabled());

        $featureToggle->setState(FeatureToggle::STATE_DISABLED);
        $this->assertFalse($featureToggle->isEnabled());
    }

    /**
     * @return FeatureToggle
     */
    protected function getFeatureToggle()
    {
        return $this->getMockBuilder('KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggle')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }
}

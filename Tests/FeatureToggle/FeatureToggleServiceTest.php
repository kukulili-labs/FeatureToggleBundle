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
use KukuliliLabs\FeatureToggleBundle\Tests\FeatureToggleServiceTestCase;

class FeatureToggleServiceTest extends FeatureToggleServiceTestCase
{
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

    public function testUpdateStateToEnabledForSession()
    {
        $this->featureToggleService->enableForSession('feature_toggle_disabled');

        $newFeatureToggleService = $this->getFeatureToggleService($this->getFeatures(), $this->session);
        $isFeatureToggleEnabled = $newFeatureToggleService->isEnabled('feature_toggle_enabled');
        $this->assertTrue($isFeatureToggleEnabled);
    }

    public function testUpdateStateToDisabledForSession()
    {
        $this->featureToggleService->disableForSession('feature_toggle_enabled');

        $newFeatureToggleService = $this->getFeatureToggleService($this->getFeatures(), $this->session);
        $isFeatureToggleEnabled = $newFeatureToggleService->isEnabled('feature_toggle_enabled');
        $this->assertFalse($isFeatureToggleEnabled);
    }
}

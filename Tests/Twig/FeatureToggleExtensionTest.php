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
use KukuliliLabs\FeatureToggleBundle\Tests\FeatureToggleServiceTestCase;
use KukuliliLabs\FeatureToggleBundle\Twig\FeatureToggleExtension;

class FeatureToggleExtensionTest extends FeatureToggleServiceTestCase
{
    /** @var FeatureToggleExtension */
    protected $extension;

    public function setUp()
    {
        parent::setUp();
        $this->extension = new FeatureToggleExtension($this->featureToggleService);
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

    public function testIsFeatureToggleDisabledForSession()
    {
        $newFeatureToggleService = $this->getFeatureToggleService($this->getFeatures(), $this->session);
        $newFeatureToggleService->disableForSession('feature_toggle_enabled');

        $this->assertFalse($this->extension->isFeatureToggleEnabled('feature_toggle_enabled'));
    }

    public function testIsFeatureToggleEnabledForSession()
    {
        $newFeatureToggleService = $this->getFeatureToggleService($this->getFeatures(), $this->session);
        $newFeatureToggleService->enableForSession('feature_toggle_disabled');

        $this->assertTrue($this->extension->isFeatureToggleEnabled('feature_toggle_disabled'));
    }
}
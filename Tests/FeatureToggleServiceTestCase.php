<?php
/**
 * This file is part of the FeatureToggleBundle package.
 *
 * (c) kukulili labs - Sebastian Müller <http://www.kukulili-labs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KukuliliLabs\FeatureToggleBundle\Tests;

use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggle;
use KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggleService;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

abstract class FeatureToggleServiceTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var FeatureToggleService */
    protected $featureToggleService;
    /** @var Session */
    protected $session;

    protected function setUp()
    {
        $this->session = $this->getSession();
        $this->featureToggleService = $this->getFeatureToggleService($this->getFeatures(), $this->session);
    }

    /**
     * @param array $features
     * @param Session $session
     * @return FeatureToggleService
     */
    protected function getFeatureToggleService(array $features, Session $session)
    {
        return $this->getMockBuilder('KukuliliLabs\FeatureToggleBundle\FeatureToggle\FeatureToggleService')
            ->setConstructorArgs(array(
                'features' => $features,
                $session
            ))
            ->getMockForAbstractClass();
    }

    /**
     * @return array
     */
    protected function getFeatures()
    {
        return array(
            'feature_toggle_enabled' => array(
                'state' => FeatureToggle::STATE_ENABLED,
                'description' => 'This is a enabled feature toggle'
            ),
            'feature_toggle_disabled' => array(
                'state' => FeatureToggle::STATE_DISABLED,
                'description' => 'This is a disabled feature toggle'
            )
        );
    }

    /**
     * @return Session
     */
    protected function getSession()
    {
        return new Session(new MockArraySessionStorage());
    }
}
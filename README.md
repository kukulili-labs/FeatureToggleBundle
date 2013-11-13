# FeatureToggleBundle

A bundle to manage feature toggles.

This Bundle is inspired by the [SoclozFeatureFlagBundle](https://github.com/SoCloz/SoclozFeatureFlagBundle).


[![Build Status](https://travis-ci.org/kukulili-labs/FeatureToggleBundle.png?branch=master)](https://travis-ci.org/kukulili-labs/FeatureToggleBundle) [![Dependency Status](https://www.versioneye.com/user/projects/528346d3632bacf1f9000118/badge.png)](https://www.versioneye.com/user/projects/528346d3632bacf1f9000118)


## Installation

Install package with composer

``` json
"kukulili-labs/feature-toggle-bundle": "dev-master"
```

Register bundles in AppKernel

``` php
new KukuliliLabs\FeatureToggleBundle\KukuliliLabsFeatureToggleBundle(),
```

## Configuration

The basic configuration is:

```yaml
# app/config/config.yml
kukulili_labs_feature_toggle:
	feature_toggles:
		feature_toggles_name: # change it to the name of your feature toggle
			state: enabled # change to disabled for disable your feature toggle
			description: # this option is optional and will be used later
```

## Using

Controller

```php
if ($this->get('kukulili_labs_feature_toggle.feature_toggles')->isEnabled('feature_toggles_name')) {...}
```

Twig

```twig
{% if feature_toggle_is_enabled('feature_toggles_name') %}
...
{% endif %}
```

Dis-/Enabling a specific feature toggle on a session

```php
$this->get('kukulili_labs_feature_toggle.feature_toggles')->disableForSession('feature_toggles_name');
$this->get('kukulili_labs_feature_toggle.feature_toggles')->enableForSession('feature_toggles_name');
```

## License

This bundle is released under the MIT license (see LICENSE).

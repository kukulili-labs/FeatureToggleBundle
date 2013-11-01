# FeatureToggleBundle

A bundle to manage feature toggles.

This Bundle is inspired by the [SoclozFeatureFlagBundle](https://github.com/SoCloz/SoclozFeatureFlagBundle).


[![Build Status](https://travis-ci.org/kukulili-labs/FeatureToggleBundle.png?branch=master)](https://travis-ci.org/kukulili-labs/FeatureToggleBundle)


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

``` yaml
# app/config/config.yml
kukulili_labs_feature_toggle:
	feature_toggles:
		feature_toggles_name: # change it to the name of your feature toggle
			state: enabled # change to disabled for disable your feature toggle
			description: # this option is optional and will be used later
```

## License

This bundle is released under the MIT license (see LICENSE).
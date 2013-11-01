# FeatureToggleBundle

A bundle to manage feature toggles.

This Bundle is inspired by the [SoclozFeatureFlagBundle](https://github.com/SoCloz/SoclozFeatureFlagBundle).


[![Build Status](https://travis-ci.org/kukulili-labs/FeatureToggleBundle.png?branch=master)](https://travis-ci.org/kukulili-labs/FeatureToggleBundle)


## Configuration

The basic configuration is:

	# app/config/config.yml
	kl_feature_toggle:
		feature_toggles:
			feature_toggles_name: # change it to the name of your feature toggle
				state: enabled # change to disabled for disable your feature toggle
				description: # this option is optional and will be used later

## License

This bundle is released under the MIT license (see LICENSE).
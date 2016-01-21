# Configuration

The module will make use of the following global constants in your `_ss_environment.php` file. You should set these up

 * `CRAZY_EGG_APP_KEY`: The "App Key" from CrazyEgg's snapshot options. Required.
 * `CRAZY_EGG_APP_SECRET`: The "API key" from CrazyEgg's snapshot options. Required.
 * `CRAZY_EGG_ACCOUNT_NUMBER`: The "Account Number" given by CrazyEgg's tracking script page. Required.

## Optional Tracking

The `SilverStripe\CrazyEgg\TagProvider` class has a configuration value, `enabled`, that can will disable any inclusion of CrazyEgg script tags if set to false.

If you wish to show CrazyEgg only sometimes, you can update this configuration value at any time during your page load, with the following command. For example, you may choose to show CrazyEgg only on certain pages, or for certain users.

```
SilverStripe\CrazyEgg\TagProvider::config()->enabled = false;
```

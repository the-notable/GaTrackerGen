# Google Universal Analytics Tracker Generator

Generates universal analytics tracker and event tracking script.

This package is incomplete

Usage is as follows:

## Generating Tracking Code

### Using Fluent Interface

```php
$UniversalAnalytics = new Notable\GaTrackerGen\UniversalAnalytics();
$tracker_code = $UniversalAnalytics
	->setUaId('youruniversalanalyticsid') //Required
	->setUserId('usersid') // Optional, use if user-id feature is enabled on property
	->setUseLinkAttribution(true) // Optional, use if link attribution is enabled on property
	->setUseDemoInterestReports(true) // Optional, use if demographic and interest reports are enabled on property
	->getScript();
```

### Passing Settings in Constructor

```php
$settings = array(
	'ua_id' => 'youruniversalanalyticsid', // Required
	'user_id' => 'usersid', // Optional, use if user-id feature is enabled on property
	'link_attribution' => true, // Optional, use if link attribution is enabled on property
	'demo_interest_reports' => true // Optional, use if demographic and interest reports are enabled on property
);

$UniversalAnalytics = new Notable\GaTrackerGen\UniversalAnalytics($settings);
$tracker_code = $UniversalAnalytics->getScript();
```
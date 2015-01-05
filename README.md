# Google Universal Analytics Tracker Generator

Generates universal analytics tracker and event tracking script.

This package is incomplete

Usage is as follows:

## Generating Tracking Code

Example output:

```javascript
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'youruniversalanalyticsid', { 'userId': 'usersid' }); 	// userid portion included if the option is set
ga('require', 'displayfeatures'); 									// Included if demographic and interest reports is set to true
ga('require', 'linkid', 'linkid.js'); 								// Included if link attribution is set to true
ga('send', 'pageview');
```

### Using Fluent Interface

```php
$UniversalAnalytics = new Notable\GaTrackerGen\UniversalAnalytics();
$tracker_code = $UniversalAnalytics
	->setUaId('youruniversalanalyticsid') 	// Required
	->setUserId('usersid') 					// Optional, use if user-id feature is enabled on property
	->setUseLinkAttribution(true) 			// Optional, use if link attribution is enabled on property
	->setUseDemoInterestReports(true) 		// Optional, use if demographic and interest reports are enabled on property
	->getScript();
```

### Passing Settings in Constructor

```php
$settings = array(
	'ua_id' => 'youruniversalanalyticsid', 	// Required
	'user_id' => 'usersid', 				// Optional, use if user-id feature is enabled on property
	'link_attribution' => true, 			// Optional, use if link attribution is enabled on property
	'demo_interest_reports' => true 		// Optional, use if demographic and interest reports are enabled on property
);

$UniversalAnalytics = new Notable\GaTrackerGen\UniversalAnalytics($settings);
$tracker_code = $UniversalAnalytics->getScript();
```

## Generate Send Google Analytics Event on Jquery Listener Event Code

This code requires jquery to be loaded *BEFORE* it is run

More information on Google Universal Analytics Events can be found here:
https://developers.google.com/analytics/devguides/collection/analyticsjs/events

```php
$ListenerEvent = new Notable\GaTrackerGen\EventTracker\OnListenerEvent();
$listener_code = $ListenerEvent
	->setEventType('click') 				// Required, jquery on event type (click, mouseover, etc)
	->setDomElement('elementid') 			// Required, dom element to which listener should be attached
	->setCategory('button') 				// Required, analytics event category
	->setAction('click') 					// Required, analytics event action
	->setLabel('nav buttons') 				// Optional, analytics event label
	->setValue(4) 							// Optional, analytics event value
	->setFieldEntry('nonInteraction', 1) 	// Optional, use specific field names and values accepted by universal analytics
	->getScript();
```
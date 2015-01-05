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

This code requires jquery to be loaded **BEFORE** it is run

More information on Google Universal Analytics Events can be found here:
https://developers.google.com/analytics/devguides/collection/analyticsjs/events

Example Output:

```javascript
$(document).ready(function(){
	$('elementid').on('click.gaeventtracking', function(){ // namespace is added to prevent conflict with other listeners on same element
		ga('send', 'event', 'button', 'click', 'nav buttons', '4', {'noninteraction': '1'});
	});
});
```

### Using Fluent Interface

```php
$ListenerEvent = new Notable\GaTrackerGen\EventTracker\OnListenerEvent();
$listener_code = $ListenerEvent
	->setEventType('click') 				// Required, jquery on event type (click, mouseover, etc)
	->setDomElement('elementid') 			// Required, dom element to which listener should be attached
	->setCategory('button') 				// Required, analytics event category
	->setAction('click') 					// Required, analytics event action
	->setLabel('nav buttons') 				// Optional, analytics event label
	->setValue(4) 							// Optional, analytics event value
	->addFieldEntry('nonInteraction', 1) 	// Optional, use specific field names and values accepted by universal analytics
	->getScript();
```

### Passing Settings in Constructor

```php
$settings = array(
	'dom_element' => 'element_id',			// Required, dom element to which listener should be attached
	'event_type' => 'click',				// Required, jquery on event type (click, mouseover, etc)
	'category' => 'button',					// Required, analytics event category
	'action' => 'click',					// Required, analytics event action
	'label' => 'nav buttons',				// Optional, analytics event label
	'value' => 4,							// Optional, analytics event value
	'field_entries' => array(				// Optional, use specific field names and values accepted by universal analytics
		array(								// Each field entry must be added as an array, so multiple arrays may be added
			'field' => 'nonInteraction',
			'value' => 1
		)
	)
);

$ListenerEvent = new Notable\GaTrackerGen\EventTracker\OnListenerEvent($settings);
$listener_code = $ListenerEvent->getScript();
```

## Generate Send Google Analytics Event on Jquery Document Ready Event Code

Example Output:

```javascript
$(document).ready(function(){var thenotablegatrackergen_fZCfXbFVi4 = function(counter){
		if(typeof ga !== 'undefined'){
			ga('send', 'event', 'button', 'click', 'nav buttons', '4', {'noninteraction': '1'});
		} else if (counter < 75){
			counter++;
			return setTimeout(function(){thenotablegatrackergen_fZCfXbFVi4(counter);}, 200);
		} else {
			console.log('ga not found');					
		}
	};
	thenotablegatrackergen_fZCfXbFVi4(0);
});
```

### Using Fluent Interface

```php
$OnReadyEvent = new Notable\GaTrackerGen\EventTracker\OnReadyEvent();
$on_ready_code = $OnReadyEvent
	->setCategory('button') 				// Required, analytics event category
	->setAction('click') 					// Required, analytics event action
	->setLabel('nav buttons') 				// Optional, analytics event label
	->setValue(4) 							// Optional, analytics event value
	->addFieldEntry('nonInteraction', 1) 	// Optional, use specific field names and values accepted by universal analytics
	->setDuration(200)						// Optional, duration in milliseconds between attempts (default is 100)
	->setAttempts(75)						// Optional, number of times to attempt sending event (default is 50)
	->getScript();
```

### Passing Settings in Constructor

```php
$settings = array(
	'category' => 'button',					// Required, analytics event category
	'action' => 'click',					// Required, analytics event action
	'label' => 'nav buttons',				// Optional, analytics event label
	'value' => 4,							// Optional, analytics event value
	'field_entries' => array(				// Optional, use specific field names and values accepted by universal analytics
		array(								// Each field entry must be added as an array, so multiple arrays may be added
			'field' => 'nonInteraction',
			'value' => 1
		)
	),
	'duration' => 200,						// Optional, duration in milliseconds between attempts (default is 100)
	'attempts' => 75						// Optional, number of times to attempt sending event (default is 50)
);

$OnReadyEvent = new Notable\GaTrackerGen\EventTracker\OnReadyEvent($settings);
$on_ready_code = $OnReadyEvent->getScript();
```
## Bulk Event Code Generation

The process for creating OnListener event collections and creating OnReady event collections is same.

```php
$settings = array(
	array( // Some button 
		'dom_element' => 'element_id1',			// Required, dom element to which listener should be attached
		'event_type' => 'click',				// Required, jquery on event type (click, mouseover, etc)
		'category' => 'button1',				// Required, analytics event category
		'action' => 'click',					// Required, analytics event action
		'label' => 'nav buttons',				// Optional, analytics event label
		'value' => 4,							// Optional, analytics event value
		'field_entries' => array(				// Optional, use specific field names and values accepted by universal analytics
			array(								// Each field entry must be added as an array, so multiple arrays may be added
				'field' => 'nonInteraction',
				'value' => 1
			)
		)
	),
	array( // Some other button
		'dom_element' => 'element_id2',			// Required, dom element to which listener should be attached
		'event_type' => 'click',				// Required, jquery on event type (click, mouseover, etc)
		'category' => 'button2',				// Required, analytics event category
		'action' => 'click',					// Required, analytics event action
		'label' => 'nav buttons',				// Optional, analytics event label
		'value' => 4,							// Optional, analytics event value
		'field_entries' => array(				// Optional, use specific field names and values accepted by universal analytics
			array(								// Each field entry must be added as an array, so multiple arrays may be added
				'field' => 'nonInteraction',
				'value' => 1
			)
		)
	),
	array( // Another button
		'dom_element' => 'element_id3',			// Required, dom element to which listener should be attached
		'event_type' => 'click',				// Required, jquery on event type (click, mouseover, etc)
		'category' => 'button3',				// Required, analytics event category
		'action' => 'click',					// Required, analytics event action
		'label' => 'nav buttons',				// Optional, analytics event label
		'value' => 4,							// Optional, analytics event value
		'field_entries' => array(				// Optional, use specific field names and values accepted by universal analytics
			array(								// Each field entry must be added as an array, so multiple arrays may be added
				'field' => 'nonInteraction',
				'value' => 1
			)
		)
	)
);

$ListenerEventCollection = new Notable\GaTrackerGen\EventTracker\OnListenerCollection($settings);
$listener_code_array = $ListenerEventCollection->getArrayOfScripts();
```
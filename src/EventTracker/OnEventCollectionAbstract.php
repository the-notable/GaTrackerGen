<?php

namespace Notable\GaTrackerGen\EventTracker;

/**
 * Class OnEventCollectionAbstract
 * @package Notable\GaTrackerGen\EventTracker
 */
abstract class OnEventCollectionAbstract implements OnEventCollectionInterface
{
	
	/**
	 * @var array
	 */
	protected $_ind_events_array;

	/**
	 * @param array $multiple_event_settings
     */
	public function __construct(array $multiple_event_settings = array())
	{
		$this->_ind_events_array = array();
		if(count($multiple_event_settings)){
			foreach($multiple_event_settings as $event_settings){
				$this->pushEventSettings($event_settings);
			}
		}
	}

	/**
	 * @param array $array
	 * @return $this
	 */
	public function pushEventSettings(array $array)
	{
		$this->_ind_events_array[] = $array;
		return $this;
	}
	
	/**
	 * @param array $array
	 * @param SendOnEventAbstract $EventObject
	 * @return SendOnEventAbstract
	 */
	protected function _returnCommonElements(array $array, SendOnEventAbstract $EventObject)
	{
		if (isset($array['category'])){
			$EventObject->setCategory($array['category']);
		}
		if (isset($array['action'])){
			$EventObject->setAction($array['action']);
		}
		if (isset($array['label'])){
			$EventObject->setLabel($array['label']);
		}
		if (isset($array['value'])){
			$EventObject->setValue($array['value']);
		}
		if (isset($array['field_entries'])){
			$entries = $array['field_entries'];
			if(is_array($entries)){
				foreach($entries as $entry){
					if(isset($entry['field']) && isset($entry['value'])){
						$EventObject->addFieldEntry($entry['field'], $entry['value']);
					}
				}
			}
		}
		return $EventObject;
	}
	
}
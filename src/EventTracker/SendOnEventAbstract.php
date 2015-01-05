<?php

namespace Notable\GaTrackerGen\EventTracker;

use Notable\GaTrackerGen\Jquery\DocReadyBuilder;

/**
 * Class SendOnEventAbstract
 * @package Notable\GaTrackerGen\EventTracker
 */
abstract class SendOnEventAbstract
{

	/**
	 * @var Builder
     */
	protected $_EventTrackerBuilder;

	/**
	 * @var DocReadyBuilder
     */
	protected $_DocReadyBuilder;

	/**
	 * @param array $settings
     */
	public function __construct(array $settings = array())
	{
		if(count($settings)){
			if(isset($settings['category'])){
				$this->setCategory($settings['category']);
			}
			if(isset($settings['action'])){
				$this->setAction($settings['action']);
			}
			if(isset($settings['label'])){
				$this->setLabel($settings['label']);
			}
			if(isset($settings['value'])){
				$this->setValue($settings['value']);
			}
			if(isset($settings['field_entries'])){
				$entries = $settings['field_entries'];
				if(is_array($entries)){
					foreach($entries as $entry){
						if(isset($entry['field']) && isset($entry['value'])){
							$this->addFieldEntry($entry['field'], $entry['value']);
						}
					}
				}
			}
		}
		$this->_EventTrackerBuilder = new Builder();
		$this->_DocReadyBuilder = new DocReadyBuilder();
	}
	
	/**
	 * @param string $category
	 * @return $this
	 */
	public function setCategory($category)
	{
		$this->_EventTrackerBuilder->setCategory($category);
		return $this;
	}
	
	/**
	 * @param string $action
	 * @return $this
	 */
	public function setAction($action)
	{
		$this->_EventTrackerBuilder->setAction($action);
		return $this;
	}
	
	/**
	 * @param string $label
	 * @return $this
	 */
	public function setLabel($label)
	{
		$this->_EventTrackerBuilder->setLabel($label);
		return $this;
	}
	
	/**
	 * @param string $value
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->_EventTrackerBuilder->setValue($value);
		return $this;
	}
	
	/**
	 * @param string $field
	 * @param string $value
	 * @return $this
	 */
	public function addFieldEntry($field, $value)
	{
		$this->_EventTrackerBuilder->addFieldEntry($field, $value);
		return $this;
	}
	
}
<?php
namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\GeneratesScriptInterface;

/**
 * Generates Google Analytics javascript event
 * tracker code.
 *
 * Only category and action are required to be set.
 *
 * @author Daniel
 */
class Builder implements GeneratesScriptInterface
{

    /**
     *
     * @var string
     */
    private $_category;

    /**
     *
     * @var string
     */
    private $_action;

    /**
     *
     * @var string
     */
    private $_label;

    /**
     *
     * @var string
     */
    private $_value;

    /**
     *
     * @var array
     */
    private $_fields;

    public function __construct()
    {
        $this->_fields = array();
    }

    /**
     * @see \Yuyangongfu\Helpers\Javascript\GeneratesScriptInterface::getScript()
     */
    public function getScript()
    {        
        /* These are all required */
        if ($this->_action == '' || $this->_category == '') {
            
            return FALSE;
        }
        
        return $this->_buildGaCode($this->_category, $this->_action);
    }

    /**
     * @param unknown $category            
     * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTrackerBuilder
     */
    public function setCategory($category)
    {
        $category = $this->_clean($category);        
        if ($category) {            
            $this->_category = $category;
        }        
        return $this;
    }

    /**
     * @param string $action            
     * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTrackerBuilder
     */
    public function setAction($action)
    {
        $action = $this->_clean($action);        
        if ($action) {            
            $this->_action = $action;
        }        
        return $this;
    }

    /**
     * @param string $label            
     * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTrackerBuilder
     */
    public function setLabel($label)
    {
        $label = $this->_clean($label);        
        if ($label) {            
            $this->_label = $label;
        }        
        return $this;
    }

    /**
     * @param string $value            
     * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTrackerBuilder
     */
    public function setValue($value)
    {
        $value = $this->_clean($value);        
        if ($value) {            
            $this->_value = $value;
        }        
        return $this;
    }

    /**
     * @param string $field            
     * @param string $value            
     * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTrackerBuilder
     */
    public function addFieldEntry($field, $value)
    {
        $field = $this->_clean($field);        
        $value = $this->_clean($value);        
        if ($field && $value) {            
            $this->_fields[] = array(
                'field' => $field,
                'value' => $value
            );
        }        
        return $this;
    }

    /**
     * @param string $string            
     * @return string|boolean
     */
    private function _clean($string)
    {
        if ($string > '') {            
            $string = trim($string);            
            if ($string > '') {                
                return mb_strtolower($string);
            }
        }        
        return FALSE;
    }

    /**
     * @param string $category            
     * @param string $action            
     * @return string
     */
    private function _buildGaCode($category, $action)
    {
        $rs = "ga('send', 'event', '$category', '$action'";        
        if ($this->_label > '') {            
            $rs .= ", '$this->_label'";
        }        
        if ($this->_value > '') {            
            $rs .= ", '$this->_value'";
        }        
        if (count($this->_fields) > 0) {            
            $fields = $this->_buildGaFields($this->_fields);            
            $rs .= ", $fields";
        }        
        $rs .= ");";        
        return $rs;
    }

    /**
     *
     * @param array $fields            
     * @return string
     */
    private function _buildGaFields(array $fields)
    {
        $rs = '{';        
        foreach ($fields as $key => $field_array) {            
            $field = $field_array['field'];            
            $value = $field_array['value'];            
            if ($key === 0) {                
                $rs .= "'$field': '$value'";
            } else {                
                $rs .= ", '$field': '$value'";
            }
        }        
        $rs .= '}';        
        return $rs;
    }
}
<?php 
/**
* Converts an array of parameters into a single string and viceversa.
*
* Allows using a single GET or URL parameter to contain several values in a pseudo-encoded way.
*
* @category  	Zend
* @package		View_Helper
* @subpackage	FilterString
* @author 		Juan Bouquet <juanpbouquet@gmail.com>
*/

class Zend_View_Helper_FilterString extends Zend_View_Helper_Abstract {

	protected $_relations = array('page'=>'pG',
						   		  'order'=>'sB',
						   		  'etype'=>'eT',
						   		  'search'=>'sC',
						   		  'platform'=>'pF',
						   		  'filter'=>'fT',
						   		  'view'=>'vW');

	protected $_defaults = array('page'=>1,
								 'view'=>'default',
								 'order'=>'dNewer',
								 'search'=>false,
								 'etype'=>'pending',
								 'platform'=>false,
								 'filter'=>false);

	protected $_filterlist = array();

	/** 
	* Helper initialization 
	*
	* @param 	array 	Array with initial values
	* @return 	object 	Helper instance
	*/

	public function filterString($array = null)
	{

		$filterlist = array();
		$currentfilters = Zend_Controller_Front::getInstance()->getRequest()->getParam('filters');

		if($currentfilters)
		{
			$filters = explode('_', $currentfilters);

			foreach($filters as $filter)
			{
				$filterparts = explode('-', $filter);
				$filterlist[$filterparts[0]] = str_replace('#', ' ', $filterparts[1]);
			}
		}

		if(is_array($array))
		{
			foreach($array as $key => $value)
			{
				switch($key) {
					case 'search':
						$value = str_replace(' ','#', $value);
						break;

					default:
						break;
				}
				$keytouse = (isset($this->_relations[$key])) ? $this->_relations[$key] : $key;
				$filterlist[$keytouse] = $value;
			}
		}
		
		$this->_filterlist = $filterlist;
		
		return $this;
	}

	/** 
	* Converts all the parameters previously defined into a single string 
	*
	* @param 	array 	Array with initial values
	* @return 	object 	Helper instance
	*/
	public function getString()
	{
		
		$filterstring = '';

		foreach($this->_filterlist as $key => $value)
		{
			if($filterstring != '')
			{
				$filterstring.= '_';
			}

			$filterstring .= $key . '-' . $value;
		}

		return $filterstring;
	}

	/** 
	* Gets the value for a specific key 
	*
	* @param 	array 	Array with initial values
	* @return 	object 	Helper instance
	*/
	public function getFilter($name)
	{
		$keytouse = (isset($this->_relations[$name])) ? $this->_relations[$name] : $name;
		$default = (isset($this->_defaults[$name])) ? $this->_defaults : false;
		return (isset($this->_filterlist[$keytouse])) ? $this->_filterlist[$keytouse] : $default;
	}

}
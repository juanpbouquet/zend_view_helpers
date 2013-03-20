<?php
/**
* Collects and filter OpenGraph Metatags
*
* Since Zend Framework's follows strictly HTML5 descriptions and they're 
* incompatible with OpenGraph definitions, this helper will handle the metatag creation dynamically.
*
* @category     Zend
* @package      View_Helper
* @subpackage   OpenGraph
* @author       Juan Bouquet <juanpbouquet@gmail.com>
*/

class Zend_View_Helper_OpenGraph extends Zend_View_Helper_Abstract {
    
    protected $_properties = array('fb:app_id'=>FACEBOOK_APP_ID);
    protected $_standard_types = array('url',
                                       'title',
                                       'locale',
                                       'image',
                                       'video:url',
                                       'audio:url',
                                       'description',
                                       'site_name',
                                       'updated_time',
                                       'see_also');
    protected $_namespace = 'fb';

    public function openGraph() {
        return $this;
    }

    public function set($name, $value, $namespace = null) {
        if(is_null($namespace)) {
           $namespace = $this->_namespace; 
        }
        $realname = (array_search($name, $this->_standard_types)!==false) ? 'og:'.$name : $namespace.':'.$name;
        $this->_properties[$realname] = $value;
    }

    public function render() {

        $return = "";
        foreach($this->_properties as $key=>$value) {
            $return .= "<meta property=\"$key\" content=\"$value\"/>";
        }

        return $return; 
    }

}

?>
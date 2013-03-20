<?php
/**
* Prepares YouTube Embed Code with custom defaults
*
* Integrates all the parameters that YouTube handles for easier implementation of YouTube Videos.
* Defaults are changed to a "almost-whitelabel" YouTube iFrame Integration 
*
* @category     Zend
* @package      View_Helper
* @subpackage   EmbedYoutube
* @author       Juan Bouquet <juanpbouquet@gmail.com>
*/

class Zend_View_Helper_EmbedYoutube extends Zend_View_Helper_Abstract {
    
    protected $_keywords;
    protected $_defaultparams = array('autohide'=>2,		 	// Automatically hides control bar
    								  'autoplay'=>0,			// Automatically starts playing
    								  'cc_load_policy'=>0,		// Close Captions
    								  'color'=>'red',			// Progress Bar Color
    								  'controls'=>1,			// Show Controls
    								  'disablekb'=>0,			// Disable Keyboard
    								  'enablejsapi'=>0,			// Enable YouTube JS API
    								  'end'=>0,					// Force Ending (seconds)
    								  'fs'=>1,					// Enable Fullscreen Button
    								  'iv_load_policy'=>3,		// Video Annotations
    								  'list'=>null,				// Playlist ID
    								  'listType'=>null,			// Playlist Title
    								  'loop'=>0,				// Enable Video Loop
    								  'modestbranding'=>1,		// Removes YouTube Logo from Control Bar
    								  'origin'=>null,			// XD: Origin Domain
    								  'playerapiid'=>null,		// JS Player API ID
    								  'playlist'=>array(),		// List of videos to play
    								  'rel'=>0,					// Show related videos at end
    								  'showinfo'=>0,			// Show video information (Title, Uploader, Description)
    								  'start'=>'dark'			// Theme to use
     							);

    public function embedYoutube($code, $width = 560, $height = 315, $options = array()) {
    	$finaloptions = array_merge($this->_defaultparams, $options);
    	
    	foreach($finaloptions as $key => $value) {
    		if(!isset($_defaultparams[$key])) {
    			unset($finaloptions[$key]);
    		}

    		switch($key) {
    			case 'origin':
    			case 'list':
    			case 'listType':
    			case 'playerapiid':
    				if(is_null($value)) {
    					unset($finaloptions[$key]);
    				}
    				break;
    			case 'playerlist':
    				if(!is_array($value)||count($value)==0)
    				{
    					unset($finaloptions[$key]);
    				}
    				break;
    		}
    	}

        return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$code.'?HD=1;rel=0;showinfo=0;controls=1"></iframe>';
    }
}

?>

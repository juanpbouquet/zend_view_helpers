<?php

class Zend_View_Helper_HumanDate extends Zend_View_Helper_Abstract {

    public function humanDate($date) {
        $timestamp = strtotime($date);
        $difference = time() - $timestamp;
        $periods = array("second", "minute", "hour", "day", "week",
        "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");
        $start = "";
        $ending = "";

        if ($difference > 0) { 
        $ending = "ago";
        } else { 
        $difference = -$difference;
        $start = "In";
        }
        for($j = 0; $difference >= $lengths[$j]; $j++)
        $difference /= $lengths[$j];
        $difference = round($difference);
        if($difference != 1 && $j == 5) 
            $periods[$j].= "es";
        elseif($difference != 1)
            $periods[$j].= "s";
        
        $text = "$start $difference $periods[$j] $ending";
        return $text;
    }
}

?>
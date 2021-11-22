<?php

namespace SolaTyolo\Lighthttp\Util;

class StringUtil
{
    public function subString($string, $length, $htmlSpecialChars =  True ) {
        $str = mb_strimwidth( $str, 0 , $length, '', 'UTF-8'  )
        if( $htmlSpecialChars === True ) {
            return htmlspecialchars( $str, ENT_QUOTES );
        } else {
            return $str
        }
    }
    

}
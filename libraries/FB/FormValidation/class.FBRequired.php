<?php
/**
 * User: Rinkana
 * Date: 1-12-13
 * Time: 22:32
 * @Author: Max Berends
 */

class FBRequired extends FormBuilderValidation{
    public function isValid($sValue){
        $bValid = false;
        if(( (!is_array($sValue) && $sValue != '') || (is_array($sValue) && !empty($sValue))) && !is_null($sValue)){
            $bValid = true;
        }
        return $bValid;
    }
}
?>
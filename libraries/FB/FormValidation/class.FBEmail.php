<?php
/**
 * User: Rinkana
 * Date: 1-12-13
 * Time: 22:32
 * @Author: Max Berends
 */

class FBEmail extends FormBuilderValidation{
    public function isValid($sValue){
        $bValid = false;
        if(strlen($sValue) > 0){
            if(filter_var($sValue, FILTER_VALIDATE_EMAIL)){
                $bValid = true;
            }
        }else{
            $bValid = true;
        }
        return $bValid;
    }
}
?>
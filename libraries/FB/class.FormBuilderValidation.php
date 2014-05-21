<?php
/**
 * User: Rinkana
 * Date: 1-12-13
 * Time: 22:33
 * @Author: Max Berends
 */

abstract class FormBuilderValidation extends FormBuilderBase{
    protected $sError = "%field% is not valid";

    public function getError(){
        return $this->sError;
    }

    public abstract function isValid($sValue);
}
?>
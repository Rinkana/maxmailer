<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 21:44
 * @Author: Max Berends
 */
abstract class FormBuilderTemplate extends FormBuilderBase{
    protected $aAttributes = array();
    public function __construct($aAttributes = array()){

        $this->setConfig($aAttributes);
    }
    public function render($aElements){
        $sHTML = "";
        foreach($aElements as $oElement){
            $sHTML .= $oElement->render();
        }
        return $sHTML;
    }
}
?>
<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 17:40
 * @Author: Max Berends
 */
class FBHidden extends FormBuilderElement {
    protected $aAttributes = array("type" => "hidden");

    public function render(){
        return parent::render();
    }
    public function getHTMLLabel(){
        return '';
    }
}
?>
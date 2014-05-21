<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 17:40
 * @Author: Max Berends
 */

class FBCheckbox extends FormBuilderElement {
    protected $aAttributes = array("type" => "checkbox");

    public function render(){
        if($this->getAttribute("value") && $this->getAttribute("value") == "on"){
            $this->addAttribute("checked", "checked");
        }else{
            $this->removeAttribute("checked");
        }
        return "<input ".$this->getAttributes(array("value"))." />";
        return parent::render();
    }
}
?>
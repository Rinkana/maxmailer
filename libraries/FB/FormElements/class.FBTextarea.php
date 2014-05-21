<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 17:40
 * @Author: Max Berends
 */
class FBTextarea extends FormBuilderElement {
    protected $aAttributes = array("rows" => "4");

    public function render(){
        $sHTML = "<textarea ".$this->getAttributes(array("Value")).">";
        $sHTML .= $this->getAttribute("Value");
        $sHTML .= "</textarea>";
        return $sHTML;
    }
}
?>
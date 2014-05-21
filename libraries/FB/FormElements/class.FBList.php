<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 17:40
 * @Author: Max Berends
 */

class FBList extends FormBuilderElement {
    protected $aAttributes = array();

    public function render(){
        $sHTML = "<select ".$this->getAttributes(array("value"))."></select>";
        return $sHTML;
    }
}
?>
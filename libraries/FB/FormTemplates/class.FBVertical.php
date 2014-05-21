<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 21:43
 * @Author: Max Berends
 */class FBVertical extends FormBuilderTemplate{
    public function render($aElements){

        $sHTML = "<table ".$this->getAttributes().">";
        foreach($aElements as $oElement){
            $aElementClass = array();
            if(!$oElement->validate($oElement->getAttribute("value"))){
                $aElementClass[] = "Invalid";
            }
            $sHTML .= "<tr><td>".$oElement->getHTMLLabel()."</td><td class='".implode(" ",$aElementClass)."'>".$oElement->render()."</td></tr>";
        }
        $sHTML .= "</table>";
        return $sHTML;
    }
}
?>
<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 21:43
 * @Author: Max Berends
 */class FBDoubleVertical extends FormBuilderTemplate{
    public function render($aElements){
        $sHTML = "<table ".$this->getAttributes().">";
        $i = 0;
        foreach($aElements as $oElement){
            $i++;
            $aElementClass = array();
            if(!$oElement->validate($oElement->getAttribute("value"))){
                $aElementClass[] = "Invalid";
            }

            if(!($i % 2 == 0)){
                $sHTML .= "<tr><td>".$oElement->getHTMLLabel()."</td><td class='".implode(" ",$aElementClass)."'>".$oElement->render()."</td>";
            }
            if(($i % 2 == 0) || $i == count($aElements)){
                $sHTML .= "<td>".$oElement->getHTMLLabel()."</td><td class='".implode(" ",$aElementClass)."'>".$oElement->render()."</td></tr>";
            }
        }
        $sHTML .= "</table>";
        return $sHTML;
    }
}
?>
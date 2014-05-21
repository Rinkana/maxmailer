<?php
/**
 * User: Rinkana
 * Date: 1-12-13
 * Time: 20:24
 * @Author: Max Berends
 */
abstract class FormBuilderBase {
    protected function setConfig($Settings = array()){
        if(!empty($Settings)){
            $oClass = get_class($this);
            $aAvalibleProperties = array_keys(get_class_vars($oClass));
            $aPropertyReference = array();

            //We use prefixes for the variable names, so we can not use this.
            //foreach($aAvalibleProperties as $Property){
            //    $aPropertyReference[strtolower($Property)] = $Property;
            //}

            $aAvalibleMethods = get_class_methods($oClass);
            $aMethodReference = array();
            foreach($aAvalibleMethods as $Method){
                $aMethodReference[strtolower($Method)] = $Method;
            }

            foreach($Settings as $Setting => $Value){
                $Setting = strtolower($Setting);
                if(isset($aMethodReference["set".$Setting])){
                    $this->$aMethodReference["set".$Setting]($Value);
                }elseif(isset($aPropertyReference[$Setting])){
                    $aPropertyReference[$Setting] = $Value;
                }else{
                    $this->addAttribute($Setting,$Value);
                }
            }
        }
    }
    public function addAttribute($sName, $sValue, $bOverride = false){
        if(isset($this->aAttributes)){
            if(isset($this->aAttributes[$sName]) && !$bOverride){
                $this->aAttributes[$sName] .= ' '.$sValue;
            }else{
                $this->aAttributes[$sName] = $sValue;
            }

        }
    }
    public function removeAttribute($sName){
        if(isset($this->aAttributes)){
            if(isset($this->aAttributes[$sName])){
                unset($this->aAttributes[$sName]);
            }
        }
    }
    public function getAttributes($aExclude = array()){
        $sReturn = '';
        if(isset($this->aAttributes) && count($this->aAttributes) > 0){
            foreach($this->aAttributes as $sAttribute => $sValue){
                if(!in_array($sAttribute,$aExclude)){
                    $sReturn .= $sAttribute."='".htmlspecialchars($sValue)."' ";
                }
            }
        }
        return $sReturn;
    }
    public function getAttribute($sName){
        $sReturn = '';
        if(isset($this->aAttributes[strtolower($sName)])){
            $sReturn = $this->aAttributes[strtolower($sName)];
        }
        return $sReturn;
    }
}
?>
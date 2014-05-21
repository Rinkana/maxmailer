<?php
/**
 * User: Rinkana
 * Date: 10-11-13
 * Time: 11:44
 * @Author: Max Berends
 */
class Tinymce{
    private $sName = NULL;
    private $aAvailableAttributes = array();
    private $aAttributes = array();
    private $Value = NULL;
    private $sLabel = NULL;
    private $sToolbar = "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image";
    private $sRemovedMenuItems = "newdocument";
    private $iHeight = 0;
    private $iWidth = 0;
    public function __construct($sName){
        if(strlen($sName) > 0){
            $this->sName = $sName;
        }else{
            throw new Exception("Name not long enough");
        }
    }
    public function setValue($Value){
        //Set the value
        $this->validateValue($Value); //Check if the given value is correct
    }
    public function validateValue($Value){
        //Optional validation. For now it just applies it.
        $this->Value = $Value;

        return $this->Value;
    }
    public function setOptions($aOptions){
        /*
         * Example:
         * $aOptions = array(
                "Label" => "test",
                "Width" => 100,
                "Height" => 200,
                "Attributes" => array("Readonly","Disabled")
            );
         */

        foreach($aOptions as $aOption => $optionData){
            $sFunctionName = "set".$aOption;
            $this->$sFunctionName($optionData);
        }
    }
    public function setToolbar($sToolbar){
        $this->sToolbar = $sToolbar;
    }
    public function setRemovedMenuItems($sRemovedMenuItems){
        $this->sRemovedMenuItems = $sRemovedMenuItems;
    }
    public function setWidth($iWidth){
        if(is_numeric($iWidth)){
            $this->iWidth = $iWidth;
        }
    }
    public function setHeight($iHeight){
        if(is_numeric($iHeight)){
            $this->iHeight = $iHeight;
        }
    }
    public function setLabel($sLabel){
        //Set the label
        //NOTE: This is optional so we only reset the label we do not throw exceptions
        if(strlen($sLabel) > 0){
            $this->sLabel = $sLabel;
        }else{
            $this->sLabel = NULL;
        }
    }
    public function setAttributes($Attributes){
        //Add attributes
        //NOTE: Type needs to be set
        //NOTE: The given attributes can be both an array or an string. The string will be split by ","
        if(is_array($Attributes)){
            //Already an array
            $aAttributes = $Attributes;
        }elseif(strlen($Attributes) > 0){
            //It's a string so we split it by ","
            $aAttributes = explode(",", $Attributes);
        }else{
            //Empty string given
            throw new Exception("No attributes given");
        }

        if(count($aAttributes) > 0){
            //Did we have something
            foreach($aAttributes as $sAttribute){ //Loop trough all given attributes and check if they are available
                $sAttribute = strtolower($sAttribute); //Lower the string
                if(!in_array($sAttribute,$this->aAvailableAttributes, false)){
                    //Attribute not found
                    throw new Exception("Attribute '".$sAttribute."' not found ");
                }else{
                    //All clear
                }
            }
            //Merge the current array with the new one so we wont get duplicates
            $this->aAttributes = array_merge($this->aAttributes, $aAttributes);
            $this->aAttributes = array_unique($this->aAttributes); //Make sure there are no duplicates
        }else{
            throw new Exception("No attributes given");
        }
    }
    public function render(){
        if(!is_null($this->sName)){

            $oAttributes = new FormAttributes();
            $HTMLElement = "<div class='FormElement tinymce'>";
            if(!is_null($this->sLabel)){
                $HTMLElement .= "<span class='Label'>".$this->sLabel.":</span>";
            }
            $HTMLElement .= '<script type="text/javascript">
                                tinymce.init({
                                    selector: "#'.$this->sName.'",
                                    plugins: [
                                    "advlist autolink lists link image charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste image"
                                ],
                                    toolbar: "'.$this->sToolbar.'",
                                    relative_urls: false,
                                    '.($this->iHeight > 0 ? 'height:'.$this->iHeight.',' : '').'
                                    '.($this->iWidth > 0 ? 'width:'.$this->iWidth.',' : '').'
                                    removed_menuitems: "'.$this->sRemovedMenuItems.'"

                                });
                            </script>';
            $HTMLElement .= "<textarea name='".$this->sName."' id='".$this->sName."'>".$this->Value."</textarea>";
            $HTMLElement .= "</div>";
            return $HTMLElement;
        }
        else{
            throw new Exception("No name given");
        }
    }
}
?>
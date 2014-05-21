<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 20:48
 * @Author: Max Berends
 */
class View {
    private $aMessages = array();
    private $sTemplatePath = GEN_DEFAULT_TEMPLATE_PATH;
    public function setTemplate($sTemplatePath = ""){
        if(strlen($sTemplatePath) > 0){
            if (substr($sTemplatePath, -1) !== '/') {
                $sTemplatePath = $sTemplatePath."/";
            }
            $sTemplateLocation = AbsPath.MVC_VIEW_PATH."Templates/".$sTemplatePath;
            if(file_exists($sTemplateLocation)){
                $this->sTemplatePath = $sTemplatePath;
            }else{
                throw new Exception("No template is not found");
            }

        }else{
            throw new Exception("Template no new path given");
        }
    }
    public function render($sView,$bIsPartial = false){
        if($bIsPartial){
            require AbsPath.MVC_VIEW_PATH."Partials/".$sView."Partial.php";
        }else{
            require AbsPath.MVC_VIEW_PATH."Templates/".$this->sTemplatePath."Header.php";
            require AbsPath.MVC_VIEW_PATH.$sView."/index.php";
            require AbsPath.MVC_VIEW_PATH."Templates/".$this->sTemplatePath."/Footer.php";
        }

    }
    public function addMessage($sMessage, $sType = "Warning"){
        $this->aMessages[] = array("Message" => $sMessage, "Type" => $sType);
    }
    public function getMessages($sType = "all"){
        if($sType == "all"){
            return $this->aMessages;
        }
        $aFilteredMessages = array();
        foreach($this->aMessages as $aMessage){
            if($aMessage["Type"] == $sType){
                $aFilteredMessages[] = $aMessage;
            }
        }
        return $aFilteredMessages;
    }
}
?>
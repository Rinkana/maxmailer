<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 18:05
 * @Author: Max Berends
 */
class Router {
    private $aURL = "";
    private $oController;
    private $bSubcontroller = false;
    function __construct(){
        $this->getURL();

        if (empty($this->aURL[0])) {
            $this->loadDefaultController();
        }else{
            $this->loadController();
        }
        $this->callController();
    }

    private function loadDefaultController(){

        $sControllerPath = AbsPath.MVC_CONTROLLER_PATH."class.".MVC_DEFAULT_CONTROLLER."Controller.php";
        require $sControllerPath;
        $sControllerName = MVC_DEFAULT_CONTROLLER."Controller";
        $this->oController = new $sControllerName();
        $this->oController->loadModel(MVC_DEFAULT_CONTROLLER);
    }
    private function loadController(){
        $sControllerPath = AbsPath.MVC_CONTROLLER_PATH."class.".$this->aURL[0]."Controller.php";
        $sControllerName = $this->aURL[0]."Controller";

        if(isset($this->aURL[1])){
            $sSubControllerPath =  AbsPath.MVC_CONTROLLER_PATH."class.".$this->aURL[0].$this->aURL[1]."Controller.php";
            if(file_exists($sSubControllerPath)){
                //Subcontroller found!
                $sControllerPath = $sSubControllerPath;
                $sControllerName = $this->aURL[0].$this->aURL[1]."Controller";
                $this->bSubcontroller = true;
            }
        }
        if(file_exists($sControllerPath)){

            require $sControllerPath;

            $this->oController = new $sControllerName();
            if($this->bSubcontroller){
                $this->oController->loadModel($this->aURL[0],$this->aURL[1]);
            }else{

                $this->oController->loadModel($this->aURL[0]);
            }
        }else{
            //Whoops, controller not found. Lets load the default one.
            //TODO: Redirect to 404 page
            $this->loadDefaultController();
        }

    }
    /*
     * This is how it will be called:
     * http://WEBSITE/CONTROLLER/METHOD/(OPTIONAL)/(OPTIONAL)/(OPTIONAL)
     */
    public function callController(){

        $iURLLength = count($this->aURL);
        if($this->bSubcontroller){
            if($iURLLength > 2){
                if(!method_exists($this->oController,$this->aURL[2])){

                    throw new Exception("Method is not found");
                }
            }
            switch($iURLLength){
                case 6:
                    $this->oController->{$this->aURL[2]}($this->aURL[3], $this->aURL[4], $this->aURL[5]);
                    break;
                case 5:
                    $this->oController->{$this->aURL[2]}($this->aURL[3], $this->aURL[4]);
                    break;
                case 4:
                    $this->oController->{$this->aURL[2]}($this->aURL[3]);
                    break;
                case 3:
                    $this->oController->{$this->aURL[2]}();
                    break;
                default:
                    $this->oController->index();
                    break;
            }
        }else{
            if($iURLLength > 1){
                if(!method_exists($this->oController,$this->aURL[1])){
                    throw new Exception("Method is not found");
                }
            }
            switch($iURLLength){
                case 5:
                    $this->oController->{$this->aURL[1]}($this->aURL[2], $this->aURL[3], $this->aURL[4]);
                    break;
                case 4:
                    $this->oController->{$this->aURL[1]}($this->aURL[2], $this->aURL[3]);
                    break;
                case 3:
                    $this->oController->{$this->aURL[1]}($this->aURL[2]);
                    break;
                case 2:
                    $this->oController->{$this->aURL[1]}();
                    break;
                default:
                    $this->oController->index();
                    break;
            }
        }
    }

    public function getURL(){
        $sURL = isset($_GET['Location']) ? $_GET['Location'] : null;
        $aURL = rtrim($sURL, '/');
        $aURL = filter_var($sURL, FILTER_SANITIZE_URL);
        $this->aURL = explode('/', $aURL);
    }
}
?>
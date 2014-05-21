<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 18:05
 * @Author: Max Berends
 */
class Controller {
    protected $oModel;
    protected $oView;
    function __construct(){
        $this->oView = new View();
    }

    final public function loadModel($sModel,$sSubmodel = ""){

        $sModelPath = AbsPath.MVC_MODEL_PATH."class.".$sModel."Model.php";
        $sModeName = $sModel."Model";


        //Do we have a sub model given?
        if(strlen($sSubmodel) > 0){
            //Get the URL
            $sSubModelPath = AbsPath.MVC_MODEL_PATH."class.".$sModel.$sSubmodel."Model.php";
            //Check if it exists.
            if(file_exists($sSubModelPath)){
                //Use it as model path
                $sModelPath = $sSubModelPath;
                $sModeName = $sModel.$sSubmodel."Model";
            }
        }

        if(file_exists($sModelPath)){
            require $sModelPath;
            $this->oModel = new $sModeName();
        }
    }


}
?>
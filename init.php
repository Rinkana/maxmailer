<?php
define ("HttpPath","http://" . $_SERVER['HTTP_HOST'] . "/", true);
define ("AbsPath",$_SERVER["DOCUMENT_ROOT"]."/", true);
define ("RequestPath","http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"], true);
error_reporting(E_ALL);
include(AbsPath."config/Config.php");

//If a file is not found this will load it. Used for classes
function autoload($class) {
    $aDirectories = array(
        GEN_LIBRARY_PATH,
        GEN_LIBRARY_PATH."FB/",
        GEN_LIBRARY_PATH."FB/FormElements/",
        GEN_LIBRARY_PATH."FB/FormValidation/",
        GEN_LIBRARY_PATH."FB/FormTemplates/",
        MVC_CONTROLLER_PATH,
        MVC_MODEL_PATH
    );
    $class = explode("\\",$class);
    //$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = end($class);
    // if file does not exist in LIBS folder [set it in config/config.php],
    // then check in LIBS/external
    foreach($aDirectories as $sDirectory){
        if (file_exists($sDirectory ."class.". $class . ".php")) {
            require $sDirectory."class." . $class . ".php";
        }
    }
}

spl_autoload_register("autoload"); //Register the file not found handler

Session::init(); //INIT SESSION

$oErrorHandler = new Debug(); //Debugger

$oRouter = new Router();
?>
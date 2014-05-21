<?php
/**
 * User: Rinkana
 * Date: 12-12-13
 * Time: 22:21
 * @Author: Max Berends
 */
class Post {
    public static function get($sName,$bReturnEmpty = false){
        if(isset($_POST[$sName])){
            return $_POST[$sName];
        }elseif($bReturnEmpty){
            return "";
        }
        return false;
    }
    public static function set($sName, $Value){
        $_POST[$sName] = $Value;
        return true;
    }
}
?>
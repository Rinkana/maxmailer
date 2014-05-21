<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 18:08
 * @Author: Max Berends
 */
class Session {
    public static function init(){
        if (session_id() == '') {
            session_start();
            session_name(GEN_SESSION_NAME);
        }
    }
    public static function set($sKey, $Value){
        $_SESSION[$sKey] = $Value;
    }
    public static function remove($sKey){
        unset($_SESSION[$sKey]);
    }
    public static function get($sKey){
        if (isset($_SESSION[$sKey])) {
            return $_SESSION[$sKey];
        }
        return false;
    }
    public static function destroy(){
        session_destroy();
    }
}
?>
<?php
/**
 * User: Rinkana
 * Date: 17-11-13
 * Time: 14:42
 * @Author: Max Berends
 */class Authenticate {
    public static function checkLoggedIn(){
        Session::init();
        Session::remove("PreLoginURL");//So we will not return to the old URL.
        if(!Session::get("LoggedIn")){
            Session::set("PreLoginURL",RequestPath);
            header('location: '.HttpPath."Login");
        }
    }
}
?>
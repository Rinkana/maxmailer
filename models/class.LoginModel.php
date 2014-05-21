<?php
/**
 * User: Rinkana
 * Date: 17-11-13
 * Time: 14:05
 * @Author: Max Berends
 */class LoginModel extends Model {
    public function login(){
        if(isset($_POST["UserName"]) && isset($_POST["UserPassword"])){
            $UserName = $_POST["UserName"];
            $db = new Database();
            $SQL = "SELECT userID,userSalt,userPassword FROM tblusers WHERE userName = :Name";
            $UserRes = $db->FetchSingleArray($SQL, array(":Name" => $UserName));
            if($UserRes){
                $UserPasswordHash = Password::Hash($_POST["UserPassword"],array("Salt" => $UserRes["userSalt"],"Pepper" => SEC_PEPPER));
                if($UserPasswordHash["Success"]){
                    if($UserPasswordHash["Hash"] == $UserRes["userPassword"]){
                        Session::init();
                        Session::set("LoggedIn",true);
                        Session::set("UserID",$UserRes["userID"]);
                        return true;
                    }
                    //Passwords are not the same
                    return false;
                }
                //Hashing did not succeed
                return false;
            }
            //No user found
            return false;
        }
        //Not all data is given
        return false;
    }
    public function logout(){
        Session::destroy();
    }
    public function checkLoggedIn(){
        return Session::get("LoggedIn");
    }
}
?>
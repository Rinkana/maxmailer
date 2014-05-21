<?php
/**
 * User: Rinkana
 * Date: 23-11-13
 * Time: 11:12
 * @Author: Max Berends
 */class Password {
    public static function Hash($sPassword, $aOptions){

        if(!function_exists('crypt')){
            throw new Exception("Unable to hash password, function crypt is not found");
        }elseif(!is_string($sPassword)){
            throw new Exception("Unable to hash password, password is not a string");
        }elseif(!strlen($sPassword) >= SEC_PASSWORD_MIN_LENGTH){
            throw new Exception("Unable to hash password, password is not long enough");
        }elseif(SEC_PASSWORD_MAX_LENGTH > 0 && $sPassword > SEC_PASSWORD_MAX_LENGTH){
            throw new Exception("Unable to hash password, password is too long");
        }elseif(SEC_CRYPT_COST < 5 || SEC_CRYPT_COST > 30){
            throw new Exception("Unable to hash password, crypt cost needs to be between 5 and 30");
        }elseif(!SEC_SALT_MIN_LENGTH >= 22){
            throw new Exception("Unable to hash password, salt min length needs to be at least 22");
        }

        $aReturn = array(
            "Success" => false
        );

        if(isset($aOptions["Salt"]) && strlen($aOptions["Salt"]) > SEC_SALT_MIN_LENGTH){
            $sSalt = $aOptions["Salt"];
        }else{
            $sSalt = self::GenerateSalt();
        }
        if(isset($aOptions["Pepper"])){
            $sSalt .= $aOptions["Pepper"];
        }
        $aReturn["Salt"] = $sSalt;

        $sSalt = sprintf("$2y$%02d$", SEC_CRYPT_COST).base64_encode($sSalt);

        $sHash = crypt($sPassword,$sSalt);

        $aReturn["Hash"] = $sHash;

        if(isset($aReturn["Salt"]) && isset($aReturn["Hash"]) && strlen($aReturn["Hash"]) >= 13){
            $aReturn["Success"] = true;
        }
        return $aReturn;
    }
    public static function GenerateSalt(){
        $sSalt = "";
        $iSaltLength = rand(SEC_SALT_MIN_LENGTH, SEC_SALT_MAX_LENGTH); //Random number between min and max length
        $sSeed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');
        shuffle($sSeed);
        for($i = 0; $i <= $iSaltLength;$i++){
            $iSeed = rand(0,count($sSeed));
            $sSalt .= $sSeed[$iSeed];
            shuffle($sSeed);
        }

        if(strlen($sSalt) >= SEC_SALT_MIN_LENGTH){
            return $sSalt;
        }
        throw new Exception("Salt could not be generated");
    }
}
?>
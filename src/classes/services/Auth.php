<?php
/**
 * Auth
 *
 * @description
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Services;

class Auth{
    
    protected $dev_id = '';
    protected $app_id = '';
    protected $token = '';
    
    /**
     * @name __construct
     * @description
     *
     * @return void
     */
    public function __construct() {
        
    }
    
    /**
     *
     * SetDevId
     */
    public function setDevId($dev_id) {
        
        $this->dev_id = $dev_id;
    }
    
    /**
     *
     * SetAppId
     */
    public function setAppId($app_id) {
        
        $this->app_id = $app_id;
    }
    
    /**
     *
     * SetToken
     */
    public function setToken($token) {
        
        $this->token = $token;
    }
    
    /**
     *
     * Validation app and dev ids
     */
    public function isValidConfig($dev_id, $app_id){
        
        /**
         * @note Check on db in real case
         */
        if(empty($this->dev_id) || empty($this->app_id)){
            return false;
        }
        if($this->dev_id != $dev_id || $this->app_id != $app_id){
            return false;
        }
        return true;
    }
    
    /**
     *
     * Validation token
     */
    public function isActiveToken(){
        
        /**
         * @note Check on your db if token is active. This is a demo then the empty check it's enough.
         */
        if(empty($this->token)){
            return false;
        }
        
        return true;
    }
    
    /**
     *
     * Generates the signature
     */
    public function generateSignature()
    {
        /**
         * Token = Header.Payload.Signature
         */
        
        // Create token header as a JSON string
        $header = json_encode(['typ' => 'APIKeys', 'alg' => 'HS256']);
        
        // Create token payload as a JSON string
        $payload = json_encode(['user_id' => $this->dev_id]);
        
        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        
        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        
        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->app_id, true);
        
        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        // Create New Token
        $this->token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        
        /* @note Store the new token on db */
        
        return $this->token;
    }
}
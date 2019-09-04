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

if(!class_exists('Auth'))
{
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
        public function __construct() 
        {
            
        }
        
        /**
         * @name __construct
         * @description
         * 
         * @param string $dev_id
         *
         * @return void
         */
        public function setDevId(string $dev_id) : void
        {
            
            $this->dev_id = $dev_id;
        }
        
        /**
         * @name setAppId
         * @description
         * 
         * @param string $app_id
         *
         * @return void
         */
        public function setAppId(string $app_id)  : void
        {
            
            $this->app_id = $app_id;
        }
        
        /**
         * @name setToken
         * @description
         * 
         * @param ?string $token
         *
         * @return void
         */
        public function setToken(?string $token)  : void
        {
            
            $this->token = $token;
        }
        
        /**
         * @name getToken
         * @description
         *
         * @return string
         */
        public function getToken() : string 
        {
            return $this->token;
        }
    
        /**
         * @name isValidConfig
         * @description Validation app and dev ids
         * 
         * @param string $dev_id
         * @param string $app_id
         *
         * @return bool
         */
        public function isValidConfig(string $dev_id, string $app_id) : bool
        {
            
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
         * @name isActiveToken
         *
         * @return bool
         */
        public function isActiveToken() : bool
        {
            
            /**
             * @note Not implemented. Check on your db if token is active. This is a demo then the empty check it's enough.
             */
            if(empty($this->token)){
                return false;
            }
            
            return true;
        }
        
        /**
         * @name generateSignature
         * @description Generates the signature
         *
         * @return string
         */
        public function generateSignature() : string
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
}
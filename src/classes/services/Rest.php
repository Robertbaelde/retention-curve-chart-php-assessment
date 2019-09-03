<?php
/**
 * Rest
 *
 * @description 
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Services;

if(!class_exists('Rest'))
{
    /**
     * @name Rest
     * @description
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Rest
    {
        /**
         * @property Auth $auth
         *
         */
        protected $auth = null;
        
        /**
         * @property bool $isValidCall
         *
         */
        protected $isValidCall = false;
        
        /**
         * @property string $method 
         * (onlyl GET implemented)
         * 
         */
        protected $method = 'GET';
        
        /**
         * @property string $endpoint 
         * (eg: /foo/process/1)
         * 
         */
        protected $endpoint = '';
    
        /**
         * @property array $args
         * 
         */
        protected $args = array();
        
        /**
         * @property string $classMethodToCall
         *
         */
        protected $classMethodToCall = '';
        
        /**
         * @name __construct
         *
         * @partam Auth $auth
         * @param string $endpoint
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct(Auth $auth, string $endpoint)
        {
            $this->auth = $auth;
            
            $this->endpoint = $this->sanitizeInputs($endpoint);
    
            $this->args = $this->setArgs();
            
            $this->classMethodToCall = $this->convertEndpointInMethodName($this->args);
        }
        
        /**
         * @name processAPI
         *
         * @param string $params
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        public function processAPI(array $params) : string
        {
            if(!$this->auth->isActiveToken()) {
                
                return $this->sendResponse(array("message-error" => "401 Unauthorized " . $this->endpoint), 401);
            }
            
            if ($this->isValidCall()) {
    
                return $this->sendResponse($this->{$this->classMethodToCall}($params));
            }
            
            return $this->sendResponse(array("message-error" => "No Endpoint " . $this->endpoint), 404);
        }
        
        /**
         * @name processAPI
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return bool
         */
        public function isValidCall() : bool
        {        
            if (method_exists($this, $this->classMethodToCall)) {
                
                $this->isValidCall = true;
            }
            
            return $this->isValidCall;
        }
        
        /**
         * @name convertEndpointInMethodName
         *
         * @param array $data
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        private function convertEndpointInMethodName(array $data) : string
        {
            return lcfirst(join('', array_map(function($i){
                return str_replace(' ', '', trim(ucwords(strtolower(str_replace('-', ' ', $i)))));
            }, $data)));
        }
        
        /**
         * @name sanitizeInputs
         *
         * @param string $data
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        private function sanitizeInputs(string $data) : string
        {
            /* 
             * Treat any inputs as untrusted!
             * */
            return trim(strip_tags($data));
        }
        
        
        /**
         * @name sendResponse
         *
         * @param array $data
         * @param int $status
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        private function sendResponse(array $data, int $status = 200) : string
        {
            /* Enable it if you want to allows restricted resources on a web page from another domain outside the domain */
            //header("Access-Control-Allow-Orgin: *");
            
            header("Access-Control-Allow-Methods: GET");
            header("Content-Type: application/json");
            header("HTTP/1.1 " . $status . " " . $this->getRequestStatus($status));
            
            return json_encode($data);
        }
        
        /**
         * @name getRequestStatus
         *
         * @param int $code
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        private function getRequestStatus(int $code) : string
        {
            $status = array(
                200 => 'OK',
                401 => 'Unauthorized',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                500 => 'Internal Server Error',
            );
            
            return ($status[$code])?$status[$code]:$status[500];
        }
        
        /**
         * @name setArgs
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        private function setArgs() : array
        {
            if ($this->endpoint) {
                
                $args = explode('/', rtrim($this->endpoint, '/'));
                array_shift($args);
                array_shift($args);
                
                return $args;
            }
            
            return array();
        }
    }
}
<?php
/**
 * DbDataManager
 *
 * @description Concrete DbDataManager implement the algorithm while following the base Strategy interface. 
 * The interface makes them interchangeable in the Context.
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Strategy;

if(!class_exists('DbDataManager'))
{
    class DbDataManager implements iDataStrategy
    {
        private $host = '';
        private $post = '';
        private $dbname = '';
        private $username = '';
        private $password = '';
        
        /**
         * @name __construct
         *
         * @param array $params
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct(array $params)
        {
            $this->setConnection($params);
        }
        
        /**
         * @name getHost
         *
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        public function getHost(): string
        {
            return $this->host;
        }
        
        /**
         * @name setConnection
         *
         * @param array $params
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function setConnection(array $params): void
        {
            $this->host = $params['host'];
            $this->post = $params['post'];
            $this->dbname = $params['dbname'];
            $this->username = $params['username'];
            $this->password = $params['password'];
        }
        
        /**
         * @name select
         *
         * @param array $params
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function select(array $params): array
        {
            return array('Not implemented');
        }
    }
}
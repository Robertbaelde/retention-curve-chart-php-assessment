<?php
/**
 * CsvDataManager
 *
 * @description Concrete CsvDataManager implement the algorithm while following the base Strategy interface. 
 * The interface makes them interchangeable in the Context.
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Strategy;

if(!class_exists('CsvDataManager'))
{
    class CsvDataManager implements iDataStrategy
    {
        private $filename = '';
        private $delimiter = ',';
        private $header = null;
        
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
         * @name getFilename
         *
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        public function getFilename(): string
        {
            return $this->filename;
        }
        
        /**
         * @name getDelimiter
         *
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return string
         */
        public function getDelimiter(): string
        {
            return $this->delimiter;
        }
        
        /**
         * @name getHeader
         *
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getHeader(): array
        {
            return $this->header;
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
            $this->filename = $params['filename'];
            $this->delimiter = $params['delimiter'];
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
            if(!$this->filename) {
                return array();
            } 
            
            $header = null;
            $resultSet = array();
        
            if (($handle = fopen($this->filename, 'r')) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
                    if(!$header) {
                        $header = $row;
                    }
                    else {
                        $combined = array_combine($header, $row);
                        
                        array_push($resultSet, $combined);
                    }
                }
            }
    
            return $resultSet;
        }
    }
}
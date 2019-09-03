<?php
/**
 * Context
 *
 * @description The Context defines the interface of interest to clients. It acts as single point of contact for client. 
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Strategy;

if(!class_exists('Context'))
{
    class Context
    {
        /**
         * @var iDataStrategy The Context maintains a reference to one of the Strategy
         * objects. The Context does not know the concrete class of a strategy. It
         * should work with all strategies via the iDataStrategy interface.
         */
        private $strategy;
        
        /**
         * @name __construct
         * @desc Usually, the Context accepts a strategy through the constructor, 
         * but also provides a setter to change it at runtime.
         *
         * @param iDataStrategy $strategy
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct(iDataStrategy $strategy)
        {
            $this->strategy = $strategy;
        }
    
        /**
         * @name setStrategy
         * @desc Usually, the Context allows replacing a Strategy object at runtime.
         *
         * @param iDataStrategy $strategy
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function setStrategy(iDataStrategy $strategy) : void
        {
            $this->strategy = $strategy;
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
            $this->strategy->setConnection($params);
        }
        
        /**
         * @name getData
         * @desc The Context delegates some work to the Strategy object instead of 
         * implementing multiple versions of the algorithm on its own.
         *
         * @param array $params
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getData(array $params): array
        {
            return $this->strategy->select($params);
        }
    }
}
<?php
/**
 * RetentionDay
 *
 *
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Entities;

if(!class_exists('RetentionDay'))
{
    /**
     * @name RetentionDay
     * @description RetentionDay
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class RetentionDay
    {   
        public $createdAt = null;
        public $onboardings = array();
        
        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct()
        {
            
        }
        
        /**
         * @name setCreatedAt
         *
         * @param ?string $created_at
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function setCreatedAt(?string $createdAt) : void
        {
            if ($createdAt) {
                $this->createdAt = new \DateTime($createdAt);
            }
        }
        
        /**
         * @name getCreatedAt
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return ?\DateTime
         */
        public function getCreatedAt() : ?\DateTime 
        {
            return $this->createdAt;
        }
        
        /**
         * @name addOnboarding
         *
         * @param RetentionOnboarding $retentionOnboarding
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function addOnboarding(RetentionOnboarding $retentionOnboarding) : void
        {
            array_push($this->onboardings, $retentionOnboarding);
        }
        
        /**
         * @name getOnboardings
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getOnboardings() : array
        {
            return $this->onboardings;
        }
        
        /**
         * @name getOnboardingByArrayIndex
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return ?RetentionOnboarding
         */
        public function getOnboardingByArrayIndex(int $index) : ?RetentionOnboarding
        {
            if ($index > -1 && $index <= count($this->onboardings) - 1) {
                return $this->onboardings[$index];
            }
            
            return null;
        }
    }
}
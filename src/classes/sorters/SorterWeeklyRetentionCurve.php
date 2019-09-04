<?php
/**
 * SorterWeeklyRetentionCurve
 *
 * @description 
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Sorters;

use Entities\RetentionDay;
use Entities\RetentionWeek;
use Entities\RetentionWeeks;
use Entities\RetentionOnboarding;

if(!class_exists('SorterWeeklyRetentionCurve'))
{
    /**
     * @name SorterWeeklyRetentionCurve
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class SorterWeeklyRetentionCurve implements iSorter
    { 
        protected $retentionWeeks = null;
        
        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct()
        {
            $this->retentionWeeks = new RetentionWeeks();
        }
        
        /**
         * @name getData
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function getData() : RetentionWeeks
        {
            return $this->retentionWeeks;
        }
        
        /**
         * @name process
         *
         * @param array $data
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function process(array $data) : void
        {
            $startDate = null;
            $compareDate = null;
            $retentionDay = new RetentionDay();
            $retentionWeek = new RetentionWeek();
            
            $len = count($data) - 1;
            
            for ($i = 0; $i <= $len; $i++) {
                
                $combined = $data[$i];
                
                $user_id = $combined['user_id'];
                $onboarding_perentage = $combined['onboarding_perentage'];
                $currentDate = $combined['created_at'];
                
                /**
                 * First loop OR same date
                 */
                if (!$compareDate || $compareDate == $currentDate) {
    
                    if (!$retentionDay->getCreatedAt()) {
        
                        $retentionDay->setCreatedAt($currentDate);
                    }
                    
                    $retentionOnboarding = new RetentionOnboarding();
                    $retentionOnboarding->setUserId($user_id);
                    $retentionOnboarding->setPercentage($onboarding_perentage);
                    
                    $retentionDay->addOnboarding($retentionOnboarding);
                    
                    // needed for first loop
                    if (!$compareDate) {
                        
                        $startDate = $currentDate;
                        $compareDate = $currentDate;
                    }
                    
                    /**
                     * Finisch the days without a complete week
                     */
                    if($i == $len){
    
                        $retentionWeek->addDay($retentionDay);
                        
                        $this->retentionWeeks->addWeek($retentionWeek);
                        
                        break;
                    }
                } else {
                    
                    /**
                     * Change day between lines
                     */
                    $startDateTime = new \DateTime($startDate);
                    $currentDatetime = new \DateTime($currentDate);
                    
                    $isAWeek = ($startDateTime->diff($currentDatetime)->format('%a') % 7 == 0);
    
                    /**
                     * is a week or just some days?
                     */
                    if ($isAWeek) {
                        
                        $this->retentionWeeks->addWeek($retentionWeek);
                        
                        $retentionWeek = new RetentionWeek();
                    } else {
                        
                        $retentionWeek->addDay($retentionDay);
                    }
                    
                    $compareDate = $currentDate;
                    
                    $retentionDay = new RetentionDay();
                    
                    $retentionOnboarding = new RetentionOnboarding();
                    $retentionOnboarding->setUserId($user_id);
                    $retentionOnboarding->setPercentage($onboarding_perentage);
                    
                    $retentionDay->addOnboarding($retentionOnboarding);
                }
            }
        }
    }
}
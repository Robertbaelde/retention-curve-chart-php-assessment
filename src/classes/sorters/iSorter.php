<?php 

namespace Sorters;

use Entities\RetentionWeeks;

/**
 * iSorter
 *
 * @description
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

interface iSorter
{
    public function getData() : RetentionWeeks;
    public function process(array $data) : void;
}
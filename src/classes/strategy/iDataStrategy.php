<?php 
/**
 * iDataStrategy
 *
 * @description The iDataStrategy interface declares operations common to all supported versions of concrete DataStrategy.
 * The Context uses this interface to call the algorithm defined by Concrete Strategies.
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Strategy;

interface iDataStrategy
{
    public function setConnection(array $params): void;
    public function select(array $params): array;
}
<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Services\Rest;
use \Sorters\SorterWeeklyRetentionCurve;
use \Strategy\CsvDataManager;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class SorterWeeklyRetentionCurveTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSorterRetentionCurve(): void
    {
        
    }
}
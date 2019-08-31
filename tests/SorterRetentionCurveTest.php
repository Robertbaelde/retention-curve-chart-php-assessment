<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Services\Rest;
use \Sorters\SorterRetentionCurve;
use \Strategy\CsvDataManager;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class SorterRetentionCurveTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSorterRetentionCurve(): void
    {
        
    }
}
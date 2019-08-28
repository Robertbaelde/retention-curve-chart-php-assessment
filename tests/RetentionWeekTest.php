<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Entities\RetentionDay;
use \Entities\RetentionOnboarding;
use \Entities\RetentionWeek;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class RetentionWeekTest extends TestCase
{
    /**
     * Days Tests
     */
    public function testDays(): void
    {
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionOnboarding
         */
        $retentionOnboarding = $this->getMockBuilder(RetentionOnboarding::class)
        ->setMethods([])
        ->getMock();
        
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionDay
         */
        $retentionDay = $this->getMockBuilder(RetentionDay::class)
        ->setMethods([])
        ->getMock();

        /*
         * RetentionWeek
         */
        $retentionWeek = new RetentionWeek();
        $retentionWeek->addDay($retentionDay);
        $days = $retentionWeek->getDays();
        
        $this->assertCount(1, $days);
    }
}
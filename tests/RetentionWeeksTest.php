<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Entities\RetentionDay;
use \Entities\RetentionOnboarding;
use \Entities\RetentionWeek;
use \Entities\RetentionWeeks;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class RetentionWeeksTest extends TestCase
{
    /**
     * Weeks Tests
     */
    public function testWeek(): void
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
        
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionWeek0
         */
        $retentionWeek0 = $this->getMockBuilder(RetentionWeek::class)
        ->setMethods([])
        ->getMock();
        
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionWeek1
         */
        $retentionWeek1 = $this->getMockBuilder(RetentionWeek::class)
        ->setMethods([])
        ->getMock();

        /*
         * RetentionWeeks
         */
        $retentionWeeks = new RetentionWeeks();
        $retentionWeeks->addWeek($retentionWeek0);
        $retentionWeeks->addWeek($retentionWeek1);
        $weeks = $retentionWeeks->getWeeks();
        
        $this->assertCount(2, $weeks);
    }
}
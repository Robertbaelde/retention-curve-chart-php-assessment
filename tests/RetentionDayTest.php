<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Entities\RetentionDay;
use \Entities\RetentionOnboarding;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class RetentionDayTest extends TestCase
{
    /**
     * CreatedAt Tests
     */
    public function testCreatedAtAsDatetime(): void
    {
        $retentionDay = new RetentionDay();
        $retentionDay->setCreatedAt('2016-07-20');
        
        $this->assertInstanceOf(
            DateTime,
            $retentionDay->getCreatedAt()
        );
    }
    
    public function testCreatedAtAsNull(): void
    {
        $retentionDay = new RetentionDay();
        $retentionDay->setCreatedAt(null);
        
        $this->assertNull($retentionDay->getCreatedAt());
    }
    
    public function testCreatedAtAsEmpty(): void
    {
        $retentionDay = new RetentionDay();
        $retentionDay->setCreatedAt('');
        
        $this->assertNull($retentionDay->getCreatedAt());
    }
    
    /**
     * Onboardings Tests
     */
    public function testAddOnboarding(): void
    {
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionOnboarding
         */
        $retentionOnboarding = $this->getMockBuilder(RetentionOnboarding::class)
        ->setMethods(['setPercentage'])
        ->getMock();
        
        $retentionOnboarding->expects($this->once())->method('setPercentage')->with($this->equalTo(50));
        $retentionOnboarding->setPercentage('50');

        /*
         * RetentionDay
         */
        $retentionDay = new RetentionDay();
        $retentionDay->addOnboarding($retentionOnboarding);
        
        $onboardings = $retentionDay->getOnboardings();
        
        $this->assertCount(1, $onboardings);
    }
    
    public function testGetOnboardingByIndex(): void
    {
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionOnboarding
         */
        $retentionOnboarding = $this->getMockBuilder(RetentionOnboarding::class)
        ->setMethods([])
        ->getMock();
        
        /*
         * RetentionDay
         */
        $retentionDay = new RetentionDay();
        $retentionDay->addOnboarding($retentionOnboarding);

        $onboarding = $retentionDay->getOnboardingByArrayIndex(0);
        
        $this->assertCount(1, [$onboarding]);
    }
    
    public function testGetOnboardingByWrongIndex(): void
    {
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject $retentionOnboarding
         */
        $retentionOnboarding = $this->getMockBuilder(RetentionOnboarding::class)
        ->setMethods([])
        ->getMock();
        
        /*
         * RetentionDay
         */
        $retentionDay = new RetentionDay();
        $retentionDay->addOnboarding($retentionOnboarding);
        
        $onboarding = $retentionDay->getOnboardingByArrayIndex(3);
        
        $this->assertNull($onboarding);
    }
}
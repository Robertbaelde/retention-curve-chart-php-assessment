<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Entities\RetentionOnboarding;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class RetentionOnboardingTest extends TestCase
{
    /**
     * CreatedAt Tests
     */
    public function testUserId(): void
    {
        $retentionOnboarding = new RetentionOnboarding();
        $retentionOnboarding->setUserId('3132');
        
        $this->assertEquals(3132, $retentionOnboarding->getUserId());
    }
    
    /**
     * Percentage Tests
     */
    public function testPercentage(): void
    {
        $retentionOnboarding = new RetentionOnboarding();
        $retentionOnboarding->setPercentage('50');
        
        $this->assertEquals(50, $retentionOnboarding->getPercentage());
    }
}
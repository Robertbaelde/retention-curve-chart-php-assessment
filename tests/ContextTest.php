<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Strategy\Context;
use \Strategy\CsvDataManager;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class ContextTest extends TestCase
{
    /**
     * Connection Tests
     */
    public function testData(): void
    {
        /*
         * @todo Mock the iStrategy, setConnection and get the data
         * 
         */
        
        $csvDataManager = new CsvDataManager();
        $csvDataManager->setConnection(array(
            'filename' => 'data/export.csv',
            'delimiter' => ';'));
        
        $context = new Context($csvDataManager);
        $resultSet = $context->getData(array('SELECT * FROM Onboarding'));
        
        $this->assertCount(339, $resultSet);
    }
}
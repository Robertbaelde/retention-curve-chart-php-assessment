<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Strategy\CsvDataManager;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class CsvDataManagerTest extends TestCase
{
    /**
     * Connection Tests
     */
    public function testConnection(): void
    {
        $csvDataManager = new CsvDataManager();
        $csvDataManager->setConnection(array(
            'filename' => 'data/export.csv', 
            'delimiter' => ';'
        ));
        
        $this->assertEquals('data/export.csv', $csvDataManager->getFilename()); 
    }
    
    /**
     * Select Tests
     */
    public function testSelect(): void
    {
        $csvDataManager = new CsvDataManager();
        $csvDataManager->setConnection(array(
            'filename' => 'data/export.csv',
            'delimiter' => ';'
        ));
        
        $resultSet = $csvDataManager->select(array('SELECT * FROM Onboarding'));

        $this->assertCount(339, $resultSet);
    }
}
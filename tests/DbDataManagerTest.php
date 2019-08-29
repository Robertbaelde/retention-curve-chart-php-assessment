<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Strategy\DbDataManager;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class DbDataManagerTest extends TestCase
{
    /**
     * Connection Tests
     */
    public function testConnection(): void
    {
        $dbDataManager = new DbDataManager();
        $dbDataManager->setConnection(array(
            'host' => 'localhost',
            'port' => '339',
            'dbname' => 'DatabaseName',
            'username' => 'root',
            'password' => 'Syui546FWE$&Fwuyf8wauyf-6u7yy'
        ));
        
        $this->assertEquals('localhost', $dbDataManager->getHost());
    }
    
    /**
     * Select Tests
     */
    public function testSelect(): void
    {
        $dbDataManager = new DbDataManager();
        $resultSet = $dbDataManager->select(array('SELECT * FROM Onboarding'));

        $this->assertCount(1, $resultSet);
    }
}
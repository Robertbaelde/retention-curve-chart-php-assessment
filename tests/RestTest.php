<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Services\Rest;
use Services\RestRetentionCurve;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class RestTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testWrongRestClass(): void
    {
        /*
         * @note Run in separate mode allows me to test an API result without Headers error already sent message.
         * */
        
        $endpoint = '/private-api/get-retention-curve-weekly-cohorts'; 
        
        $rest = new Rest($endpoint);
        
        $resultSet = $rest->processAPI(array('foo' => true, 'pluto' => 'far'));
        
        $this->assertEquals('{"foo":true,"pluto":"far"}', str_replace(' ', '', $resultSet));
    }
    
    /**
     * @runInSeparateProcess
     */
    public function testRestSuperClassWrongEndpoint(): void
    {
        /*
         * @note Run in separate mode allows me to test an API result without Headers error already sent message.
         * */
        
        $endpoint = '/private-api/another-endpoint/whatever';
        
        $rest = new Rest($endpoint);
        
        $resultSet = $rest->processAPI(array('foo' => true, 'pluto' => 'far'));
        
        $this->assertEquals('{"foo":true,"pluto":"far"}', str_replace(' ', '', $resultSet));
    }
    
    /**
     * @runInSeparateProcess
     */
    public function testRetentionCurveClass(): void
    {
        $endpoint = '/private-api/get-retention-curve-weekly-cohorts';
        
        $rest = new RestRetentionCurve($endpoint);
        
        $resultSet = $rest->processAPI(array('foo' => true, 'pluto' => 'far'));
        
        $this->assertEquals('{"foo":true,"pluto":"far"}', str_replace(' ', '', $resultSet));
    }
}
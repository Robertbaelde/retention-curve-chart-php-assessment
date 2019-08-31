<?php 



/*
 * 
 * @todo First test manage data
 * 
 * */

//use Services\Rest;
use Services\RestRetentionCurve;


$endpoint = '/private-api/get/retention-curve/weekly-cohorts';
//$endpoint = '/private-api/get/unaltracosa/nonso';
$data = ['foo' => true, 'pluto' => 'far'];


/*
$args = ['get', 'retention-curve', 'weekly-cohorts'];

var_dump($args);

$args = array_map (function($arg){ 
    return str_replace(' ', '', trim(ucwords(strtolower(str_replace('-', ' ', $arg))))); 
    }, $args
);

echo join('', $args);

    var_dump($args);

die();*/


//$API = new Rest($endpoint);
$API = new RestRetentionCurve($endpoint);

//print_r( $API->__get('args'));

echo $API->processAPI($data);


die();







$e = trim(strip_tags($e));

//print_r($e);

$arrArgs = explode('/', rtrim($e, '/'));

array_shift($arrArgs);

print_r($arrArgs);

//echo explode('/', rtrim($e, '/'))[2];

//print_r(explode('/', rtrim($_SERVER['REQUEST_URI'], '/')));

//$this->endpoint = array_shift($this->args);

/*
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
echo "<pre>";
print_r($_SERVER['REQUEST_URI']); // /foo/process/1
echo "</pre>";
*/
//print_r(explode('/', rtrim('http://temper.localhost/foo/par/1', '/')));
//$clean_input = trim(strip_tags($data));
die();


use \Entities\RetentionOnboarding;
use \Entities\RetentionDay;
use \Entities\RetentionWeek;
use \Entities\RetentionWeeks;


$header = null;
$filename = 'data/export.csv';
$delimiter = ';';
$startDate = null;
$compareDate = null;
$retentionDay = new RetentionDay();
$retentionWeek = new RetentionWeek();
$retentionWeeks = new RetentionWeeks();

// Convert CSV into PHP array
if (($handle = fopen($filename, 'r')) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
        if(!$header) {
            $header = $row;
        }
        else {
            // key => value            
            $combined = array_combine($header, $row);

            $currentDate = $combined['created_at'];

            // first loop or same day
            if (!$compareDate || $compareDate == $currentDate) {
                
                //echo "FIRST LOOP OR SAME DAY: " . $compareDate . ' == ' . $currentDate . "<br />";
                
                //$retentionDay = new RetentionDay();
                if (!$retentionDay->getCreatedAt()) {
                    
                    //$retentionDay = new RetentionDay();
                    
                    $retentionDay->setCreatedAt($currentDate);
                }
                
                $retentionOnboarding = new RetentionOnboarding();
                $retentionOnboarding->setUserId($combined['user_id']);
                $retentionOnboarding->setPercentage($combined['onboarding_perentage']);

                $retentionDay->addOnboarding($retentionOnboarding);
                
                // needed for first loop
                if (!$compareDate) {
                    $startDate = $currentDate;
                    $compareDate = $currentDate;
                }
            } else {
                // next week or next day
                //echo "NEXT WEEK OR NEXT DAY<br />";
                
                $startDateTime = new \DateTime($startDate);
                $currentDatetime = new \DateTime($currentDate);
                
                $isAWeek = ($startDateTime->diff($currentDatetime)->format('%a') % 7 == 0);
                
                //var_dump($isAWeek);
                //var_dump($retentionDay);
                
                if ($isAWeek) {

                    $retentionWeeks->addWeek($retentionWeek);
                    
                    $retentionWeek = new RetentionWeek();
                } else {

                    $retentionWeek->addDay($retentionDay);
                }

                $compareDate = $currentDate;
                
                $retentionDay = new RetentionDay();
                
                $retentionOnboarding = new RetentionOnboarding();
                $retentionOnboarding->setUserId($combined['user_id']);
                $retentionOnboarding->setPercentage($combined['onboarding_perentage']);
                
                $retentionDay->addOnboarding($retentionOnboarding);
            } 
        }
    }
    
    fclose($handle);
}

echo "Weeks: " . count($retentionWeeks->getWeeks());
echo "<br />";
echo "Days first week: " . count($retentionWeeks->getWeekByArrayIndex(1)->getDays());
echo "<br />";
echo "Onboarding per day: " . (count(  $retentionWeeks->getWeekByArrayIndex(1)->getDays()[1]->getOnboardings()  ));
echo "<br />";


echo "<pre>";
print_r($retentionWeeks);
echo "</pre>";

<?php

require __DIR__ . '/../vendor/autoload.php';

$response = array();

// ############################################


$m = new \Moment\Moment("2019-04-14");



//$m = new \Moment\Moment();

$i = 0;
$toTimeZone = "";
//$m->addDays($i - 7);
//$toTimeZone = 540;
//$m->addMinutes($toTimeZone);

echo $m->format() . "<br>";
/* 
echo $m->getYear() . "<br>";
echo ($m->getMonth() - 1) . "<br>";
echo $m->getDay() . "<br>";
*/

echo $m->format("Y") . "<br>";
echo $m->format("n") . "<br>";
echo $m->format("j") . "<br>";

echo $m->format("G") . "<br>";
echo $m->format("i") . "<br>";
echo $m->format("s") . "<br>";


$momentFromVo = $m->from('2020-03-16');

echo $momentFromVo->getYears() . "<br>";
echo $momentFromVo->getMonths() . "<br>";
echo $momentFromVo->getDays() . "<br>";




$momentEndDate = new \Moment\Moment("2019-04-14");

$momentPeriod = $momentEndDate->getPeriod("month");

echo $momentPeriod->getEndDate()->getDay() . "<br>";

echo $momentEndDate->getDay() . "<br>";

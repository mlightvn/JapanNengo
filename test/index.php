<?php

require '../src/NamTenTen/JapanNengo.php';
require 'debug.phar'; // https://github.com/namtenten/debug-functions/tree/master/build

use NamTenTen\JapanNengo;

$nengo = new JapanNengo();

$date = 19890102; // integer: YYYYMMDD
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_date . "\n";

$date = "2019/04-30"; // string: YYYYMMDD
$nengo_year = $nengo->toNengoYear($date);
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_year . "\n";
echo $date . " ⇒ " . $nengo_date . "\n";

$date = "20190501";
$nengo_year = $nengo->toNengoYear($date);
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_year . "\n";
echo $date . " ⇒ " . $nengo_date . "\n";

$date = "20191107";
$nengo_array = $nengo->toNengoArray($date);
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_date . "\n";
var_dump($nengo_array);
echo "\n";

$date = 20201231;
$nengo_array = $nengo->toNengoArray($date);
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_date . "\n";
var_dump($nengo_array);
echo "\n";

$donate_url = $nengo->donateUrl();
echo "Donate Url: " . $donate_url . "\n\n";

$author = $nengo->author();
var_dump($author);
echo "\n";


$wareki = "令和元年11月07日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

// $a = true;
// echo "{$a}";
// echo "\n";

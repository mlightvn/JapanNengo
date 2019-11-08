<?php

require '../src/NamTenTen/JapanNengo.php';
require 'debug.phar'; // https://github.com/namtenten/debug-functions/tree/master/build

use NamTenTen\JapanNengo;

$nengo = new JapanNengo();

echo "==========================================\n";
echo "西暦を和暦に変換\n";
echo "==========================================\n";

$date = 19890102; // integer: YYYYMMDD
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_date . "\n";

$date = "2019/04/30"; // string: YYYY/MM/DD
$nengo_year = $nengo->toNengoYear($date);
$nengo_date = $nengo->toNengoDate($date);
echo $date . " ⇒ " . $nengo_year . "\n";
echo $date . " ⇒ " . $nengo_date . "\n";

$date = "20190501"; // string: YYYYMMDD
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

echo "==========================================\n";
echo "和暦を西暦に変換\n";
echo "==========================================\n";

$wareki = "昭和64年01月02日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$wareki = "平成元年01月08日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$wareki = "平成31年04月30日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$wareki = "令和元年05月01日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$wareki = "令和元年11月07日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$wareki = "令和1年11月07日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$seireki = $nengo->toYear($wareki);
echo "{$wareki} ⇒ {$seireki}\n";

$wareki = "令和2年11月07日";
$seireki = $nengo->toDate($wareki);
echo "{$wareki} ⇒ {$seireki}\n";
echo "\n";

$wareki = "令和2年11月07日";
$seireki = $nengo->toDateArray($wareki);
echo "{$wareki}\n";
var_dump($seireki);
echo "\n";
echo "\n";

// echo "==========================================\n";
// echo "作者情報\n";
// echo "==========================================\n";

// $donate_url = $nengo->donateUrl();
// echo "Donate Url: " . $donate_url . "\n\n";

// $author = $nengo->author();
// var_dump($author);
// echo "\n";

<?php
// 批量查询域名对应的ip、地区

require 'vendor/autoload.php';
use itbdw\Ip\IpLocation;

$domain         = file('domain.txt');
$qqwry_filepath = '/abspath/qqwry.dat';
foreach ($domain as $value) {
    $value = trim($value);
    if (!$value) {
        continue;
    }
    $ip = trim(`nslookup $value |grep 'Address' | tail -n 1 | awk '{print $2}'`);

    $areaInfo = IpLocation::getLocation($ip);
    echo "\n" . $value . "\t" . implode("\t", $areaInfo);
}

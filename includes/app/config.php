<?php
//DATABASE CONNECTION $db
$db=mysqli_connect("localhost","USERNAME","PASSWORD","DB");
if (mysqli_connect_errno($db))
  {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

//PHP CONSTANTS
date_default_timezone_set('America/New_York');

//DATABASE CONSTANTS
$constants = array();
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'options'");
while($row = mysqli_fetch_array($result))
	{
  		$constants[$row[0]] = $row[1];
  	}

//CREATE DRIVER
$driverQuery1 = "DROP TABLE IF EXISTS `driver`;";
$driverQuery2 = "CREATE TABLE `driver` (
  `FundCode` char(16) character set ascii NOT NULL default '',
  `MCCCountryCode` char(8) character set ascii NOT NULL default '',
  `ProjectCode` char(32) character set ascii NOT NULL default '',
  `ActivityCode` char(32) character set ascii NOT NULL default '',
  `FundName` char(64) character set ascii default NULL,
  `MCCCountryName` char(64) character set ascii default NULL,
  `ProjectName` char(64) character set ascii default NULL,
  `ActivityName` char(64) character set ascii default NULL,
  `DACCode` char(16) character set ascii default NULL,
  `DACName` char(32) character set ascii default NULL,
  `start_date` date default NULL,
  `end_control` date default NULL,
  `end_date` date default NULL,
  `Status` char(32) character set ascii default NULL,
  `IATI_COUNTRY_CODE` varchar(2) character set latin1 default '',
  `IATI_NAME` varchar(64) character set latin1 default NULL,
  `IATI_LAT` varchar(16) character set latin1 default NULL,
  `IATI_LON` varchar(16) character set latin1 default NULL,
  `docTitle` varchar(255) character set ascii default NULL,
  `docURL` varchar(255) character set ascii default NULL,
  `description` varchar(255) character set ascii default NULL,
  `DACRegionCode` varchar(255) character set ascii default NULL,
  `DACRegionName` varchar(255) character set ascii default NULL
) ";
$driverQuery3 = "INSERT INTO `driver` (`FundCode`,`MCCCountryCode`,`ProjectCode`,`ActivityCode`,`FundName`,`MCCCountryName`,`ProjectName`,`ActivityName`,`DACCode`,`DACName`,`start_date`,`end_control`,`end_date`,`Status`,`IATI_COUNTRY_CODE`,`IATI_NAME`,`IATI_LAT`,`IATI_LON`,`docTitle`,`docURL`,`description`,`DACRegionCode`,`DACRegionName`) select `data`.`FundCode` AS `FundCode`,`data`.`MCCCountryCode` AS `MCCCountryCode`,`data`.`ProjectCode` AS `ProjectCode`,`data`.`ActivityCode` AS `ActivityCode`,`data`.`FundName` AS `FundName`,`data`.`MCCCountryName` AS `MCCCountryName`,`data`.`ProjectName` AS `ProjectName`,`data`.`ActivityName` AS `ActivityName`,`data`.`DACCode` AS `DACCode`,`data`.`DACName` AS `DACName`,min(`data`.`QTRStart`) AS `start_date`,min(`data`.`QTREnd`) AS `end_control`,max(`data`.`QTREnd`) AS `end_date`,`data`.`Status` AS `Status`,`countries`.`country_code` AS `IATI_COUNTRY_CODE`,`countries`.`name` AS `IATI_NAME`,`countries`.`lat` AS `IATI_LAT`,`countries`.`lon` AS `IATI_LON`,`descriptions`.`docTitle` AS `docTitle`,`descriptions`.`docURL` AS `docURL`,`descriptions`.`description` AS `description`,`countries`.`RegionCode` AS `DACRegionCode`,`countries`.`RegionName` AS `DACRegionName` from ((`data` left join `countries` on((`countries`.`mcc_country_code` = convert(`data`.`CountryCode` using latin1)))) left join `descriptions` on((`descriptions`.`MCCCountryCode` = `data`.`MCCCountryCode`))) group by `data`.`FundCode`,`data`.`MCCCountryCode`,`data`.`ProjectCode`,`data`.`ActivityCode` order by `data`.`MCCCountryCode`,`data`.`FundCode`,`data`.`ProjectCode`,`data`.`ActivityCode`";
$deleteDriver = mysqli_query($db, $driverQuery1);
$createDriver = mysqli_query($db, $driverQuery2);

?>
<?php
//--------------------------   IATI GENERATOR DEVELOPED BY THE MILLENNIUM CHALLENGE CORPORATION (V1.03a) ----------------------------------


//DATABASE CONNECTION $db
$db=mysqli_connect("localhost","USERNAME","PASSWORD","DB");
if (mysqli_connect_errno($db))
  {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
  }


//------------------------POPULATE BUDGET TABLE

//CREATE BUDGET
$budgetBQuery1 = "DROP TABLE IF EXISTS `budget_base`;";
$budgetBQuery2 = "CREATE TABLE `budget_base` (
  `budget` double(11,2) NOT NULL,
  `start` date NOT NULL,
  `country_code` char(3) collate utf8_unicode_ci NOT NULL,
  `fund_code` char(16) collate utf8_unicode_ci NOT NULL,
  `fy` int(11) NOT NULL,
  KEY `fy` (`fy`),
  KEY `country_code` (`country_code`)
) ";

$budgetBQuery3 = "INSERT INTO `budget_base` (`budget`, `start`, `country_code`, `fund_code`, `fy`) SELECT Sum(`data`.Commitment) AS budget, `data`.QTRStart AS `start`, `data`.CountryCode, `data`.FundCode AS fund_code, '1' AS fy FROM `data` GROUP BY `data`.CountryCode, `data`.FundCode, `data`.QTRStart ORDER BY `data`.CountryCode ASC, `data`.QTRStart ASC";

$budgetBQuery4 = "UPDATE budget_base SET fy = IF(MONTH(`start`) > 9, YEAR(`start`) + 1, YEAR(`start`))";

//CREATE NEW TABLE
$deleteBudgetB = mysqli_query($db, $budgetBQuery1);
$createBudgetB = mysqli_query($db, $budgetBQuery2);

//INSERT ALL FIELDS
$importBudgetB = mysqli_query($db, $budgetBQuery3);

//COMPUTE FISCAL YEAR AND UPDATE
$calculateFY = mysqli_query($db, $budgetBQuery4);

$budgetQuery1 = "DROP TABLE IF EXISTS `budget`;";
$budgetQuery2 = "CREATE TABLE `budget` (
  `budget` double(11,2) NOT NULL,
  `country_code` char(3) collate utf8_unicode_ci NOT NULL,
  `fund_code` char(16) collate utf8_unicode_ci NOT NULL,
  `fy` int(11) NOT NULL,
  KEY `fy` (`fy`),
  KEY `country_code` (`country_code`)
) ";

$budgetQuery3 = "INSERT INTO `budget` (`budget`, `country_code`, `fund_code`, `fy`) SELECT Sum(`budget_base`.budget) AS budget, `budget_base`.country_code AS country_code, `budget_base`.fund_code AS fund_code, `budget_base`.fy AS fy FROM `budget_base` GROUP BY `budget_base`.country_code, `budget_base`.fund_code, `budget_base`.fy ORDER BY `budget_base`.country_code ASC, `budget_base`.fund_code ASC, `budget_base`.fy ASC";

//CREATE NEW TABLE
$deleteBudget = mysqli_query($db, $budgetQuery1);
$createBudget = mysqli_query($db, $budgetQuery2);

//INSERT ALL FIELDS
$importBudget = mysqli_query($db, $budgetQuery3);

//PHP CONSTANTS
date_default_timezone_set('America/New_York');

//DATABASE CONSTANTS
$constants = array();
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'options'");
while($row = mysqli_fetch_array($result))
	{
  		$constants[$row[0]] = $row[1];
  	}

//Start IATI XML
$xml=new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><iati-organisations></iati-organisations>');

//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'iati-organisations'");

while($row = mysqli_fetch_array($result))
	{
  		$xml->addAttribute($row[0],$row[1]);
  	}

//SESSION DRIVEN ATTRIBUTES
$xml->addAttribute("generated-datetime",date(DATE_ATOM));

//--------------------------   BEGIN IATI ORGANISATION  ---------------------------------------------------

$organisation = $xml->addChild("iati-organisation");

//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'iati-organisation'");

while($row = mysqli_fetch_array($result))
	{
  		$organisation->addAttribute($row[0],$row[1]);
  	}

//SESSION DRIVEN ATTRIBUTE
$organisation->addAttribute("last-updated-datetime",$constants['maxDate'] . "T00:00:00-04:00");


//----------------------------------------REPORTING ORG
$org = $organisation->addChild("reporting-org","INTERNATIONAL AID ORG");

//CONSTANT DYNAMIC ATTRIBUTES
$result = mysqli_query($db,"SELECT `key`, `value` FROM constants WHERE `section` = 'reporting-org'");

while($row = mysqli_fetch_array($result))
	{
  		$org->addAttribute($row[0],$row[1]);
  	}
	
//-----------------------------------------IATI IDENTIFIER
$iatiIdentifier = $organisation->addChild("iati-identifier","US-18");

//-----------------------------------------NAME
$name = $organisation->addChild("name","INTERNATIONAL AID ORG");
	$name->addAttribute("xml:lang","en");
	
//-----------------------------------------TOTAL BUDGET
$totalBudgetQuery = mysqli_query($db,"SELECT Sum(budget) AS budget, fy FROM `budget` GROUP BY fy ORDER BY fy ASC");

//LOOP BUDGET VALUES
while($tbRow = mysqli_fetch_array($totalBudgetQuery))
	{
  		//SET DATES
  		$startDate = $tbRow['fy'] - 1 . "-10-01";
		$endDate = $tbRow['fy'] . "-09-30";
  		
  		$tb = $organisation->addChild("total-budget");	
			$periodStart = $tb->addChild("period-start",$startDate);
				$periodStart->addAttribute("iso-date",$startDate);
			$periodEnd = $tb->addChild("period-end",$endDate);
				$periodEnd->addAttribute("iso-date",$endDate);
			$value = $tb->addChild("value",floor($tbRow['budget']));
				$value->addAttribute("value-date",$startDate);
				$value->addAttribute("currency","USD"); 
  		
  		//COUNTRY BUDGET
		$subBudgetQuery = mysqli_query($db,"SELECT Sum(budget) AS budget FROM `budget` WHERE fy = '" . $tbRow['fy'] . "' AND country_code <> '' GROUP BY fy");
		
		$sbRow = mysqli_fetch_row($subBudgetQuery);
		$sb = $tb->addChild("budget",floor($sbRow[0]));
			$sb->addAttribute("type","country");
		
		//ADMIN BUDGET
		$subBudgetQuery = mysqli_query($db,"SELECT Sum(budget) AS budget FROM `budget` WHERE fy = '" . $tbRow['fy'] . "' AND country_code = '' AND fund_code <> '2750BXDILD' GROUP BY fy");
		
		$sbRow = mysqli_fetch_row($subBudgetQuery);
		$sb = $tb->addChild("budget",floor($sbRow[0]));
			$sb->addAttribute("type","admin");
		
		//DUE DILIGENCE BUDGET
		$subBudgetQuery = mysqli_query($db,"SELECT Sum(budget) AS budget FROM `budget` WHERE fy = '" . $tbRow['fy'] . "' AND country_code = '' AND fund_code = '2750BXDILD'GROUP BY fy");
		
		$sbRow = mysqli_fetch_row($subBudgetQuery);
		$sb = $tb->addChild("budget",floor($sbRow[0]));
			$sb->addAttribute("type","due-diligence");
		
		//SET MAX YEAR
		$maxYear = $tbRow['fy'];
	}

//------------------------------------------RECIPIENT COUNTRY BUDGET

$countryQuery = mysqli_query($db,"SELECT country_code FROM budget WHERE country_code <> '' GROUP BY country_code ORDER BY country_code ASC");

while($countryRow = mysqli_fetch_array($countryQuery))
	{
	//GET IATI COUNTRY CODE
	$countryCodeQuery = mysqli_query($db,"SELECT IATI_COUNTRY_CODE, IATI_NAME FROM `driver` WHERE `MCCCountryCode` = '" . $countryRow['country_code'] . "' GROUP BY IATI_COUNTRY_CODE");
		
		$countryqRow = mysqli_fetch_row($countryCodeQuery);
		$countryCode = htmlentities($countryqRow[0]);
		$countryName = htmlentities($countryqRow[1]);

	//RECIPIENT COUNTRY DOCUMENTS
	$cDocQuery = mysqli_query($db,"SELECT driver.docTitle, driver.docURL FROM driver WHERE driver.IATI_COUNTRY_CODE = '" . $countryCode . "' GROUP BY driver.docTitle, driver.docURL");
	while($cDocRow = mysqli_fetch_array($cDocQuery))
		{
			if(!empty($cDocRow['docURL'])){
				$documentLink = $organisation->addChild("document-link");
				$documentLink->addAttribute("url",$cDocRow['docURL']);
				$documentLink->addAttribute("format","application/pdf");
				$rcID = $documentLink->addChild("recipient-country", $countryName);
						$rcID->addAttribute("code",$countryCode);
				$documentLinklanguage = $documentLink->addChild("language","en");
				$documentLinkCategory = $documentLink->addChild("category");
					$documentLinkCategory->addAttribute("code","B03");
				$documentLinkTitle = $documentLink->addChild("title",$cDocRow['docTitle'] . ": " . $countryName);
			}else{
				$documentLink = $organisation->addChild("document-link");
				$documentLink->addAttribute("url","http://www.mcc.gov/documents/guidance/mcc-guidelines-programprocurement.pdf");
				$documentLink->addAttribute("format","application/pdf");
				$rcID = $documentLink->addChild("recipient-country", $countryName);
						$rcID->addAttribute("code",$countryCode);
				$documentLinklanguage = $documentLink->addChild("language","en");
				$documentLinkCategory = $documentLink->addChild("category");
					$documentLinkCategory->addAttribute("code","B03");
				$documentLinkTitle = $documentLink->addChild("title","Compact Procurement Guidelines: " . $countryName);
			}
		}
	
	//RECIPIENT COUNTRY BUDGET
	$rcQuery = mysqli_query($db,"SELECT Sum(budget) AS budget, fy FROM `budget` WHERE country_code = '" . $countryRow['country_code'] . "' GROUP BY country_code, fy ORDER BY fy ASC");
	while($rcRow = mysqli_fetch_array($rcQuery))
		{
  			//SET DATES
 	 		$startDate = $rcRow['fy'] - 1 . "-10-01";
			$endDate = $rcRow['fy'] . "-09-30";
  			
  			$rc = $organisation->addChild("recipient-country-budget");
				$rcID = $rc->addChild("recipient-country",$countryName);
					$rcID->addAttribute("code",$countryCode);
				$periodStart = $rc->addChild("period-start",$startDate);
					$periodStart->addAttribute("iso-date",$startDate);
				$periodEnd = $rc->addChild("period-end",$endDate);
					$periodEnd->addAttribute("iso-date",$endDate);
				$value = $rc->addChild("value",floor($rcRow['budget']));
					$value->addAttribute("value-date",$startDate);
					$value->addAttribute("currency","USD"); 
  			$maxYear = $rcRow['fy'];	
  		}
  	//FUTURE COUNTRY BUDGET 4 MORE YEARS
  	for ($i = 1; $i <= 4; $i++) 
		{
			//SET FUTURE DATES
			$maxYear++;
			$startDate = $maxYear - 1 . "-10-01";
			$endDate = $maxYear . "-09-30";
		
			$rc = $organisation->addChild("recipient-country-budget");
				$rcID = $rc->addChild("recipient-country",$countryName);
					$rcID->addAttribute("code",$countryCode);
				$periodStart = $rc->addChild("period-start",$startDate);
					$periodStart->addAttribute("iso-date",$startDate);
				$periodEnd = $rc->addChild("period-end",$endDate);
					$periodEnd->addAttribute("iso-date",$endDate);
				$value = $rc->addChild("value","0");
					$value->addAttribute("value-date",$startDate);
					$value->addAttribute("currency","USD");
		     
		}	  	
  	}

//-----------------------------------------------DOCUMENTS
$documentQuery = mysqli_query($db,"SELECT * FROM `documents` WHERE `category` LIKE '%B%'");

while($documentRow = mysqli_fetch_array($documentQuery))
{
	$documentLink = $organisation->addChild("document-link");
	$documentLink->addAttribute("url",$documentRow['url']);
	$documentLink->addAttribute("format",$documentRow['format']);
		$documentLinklanguage = $documentLink->addChild("language","en");
		//LIST CATEGORIES
		foreach (explode(',', $documentRow['category']) as $cat)
		{
			if (substr($cat, 0, 1) === 'B') 
			{
				$documentLinkCategory = $documentLink->addChild("category");
					$documentLinkCategory->addAttribute("code",$cat);
			}
		}
		$documentLinkTitle = $documentLink->addChild("title",$documentRow['title']);
}

//------------------------------------------OUTPUT
if($xml->asXML('output/organisation.xml'))
{
	echo "IATI Org File Created";
}else{
	echo "Error Making IATI Org File";
}

?>
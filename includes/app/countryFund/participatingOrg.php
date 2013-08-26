<?php
//United States of America - Funding
$participatingOrg1 = $activity->addChild("participating-org","United States of America");
$participatingOrg1->addAttribute("role","Funding");
$participatingOrg1->addAttribute("type","10");
$participatingOrg1->addAttribute("ref","US");

//Millennium Challenge Corporation - Extending
$participatingOrg2 = $activity->addChild("participating-org","Millennium Challenge Corporation");
$participatingOrg2->addAttribute("role","Extending");
$participatingOrg2->addAttribute("type","10");
$participatingOrg2->addAttribute("ref","US-18");

if($countryFundRow['FundName'] == "Compact"){
	$accountable = "Millennium Challenge Account - " . $countryFundRow['MCCCountryName'];
	$implementing = "Millennium Challenge Account - " . $countryFundRow['MCCCountryName'];
	$accCode = "US-8";
	$impCode = "US-8";
}else{
	$accountable = "Millennium Challenge Corporation";
	$implementing = "Millennium Challenge Corporation";
	$accCode = "US-18";
	$impCode = "US-18";	
}
	
?>
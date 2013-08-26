<?php
//General Description
if(isset($countryFundRow['description']))
{
	$descGen = $countryFundRow['description'];
}else{
	$descGen = $countryFundRow['MCCCountryName'] . ":" . $countryFundRow['FundCode'] . " Country Effort / Fund Level";
}
$description1 = $activity->addChild("description",htmlentities($descGen));
$description1->addAttribute("xml:lang","en");
$description1->addAttribute("type","1");

//Objectives
$description2 = $activity->addChild("description","Good governance, economic freedom and investment in the citizens of " . htmlentities($countryFundRow['IATI_NAME']));
$description2->addAttribute("xml:lang","en");
$description2->addAttribute("type","2");

?>
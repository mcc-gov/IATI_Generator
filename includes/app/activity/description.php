<?php
//General Description
if(isset($activityRow['description']))
{
	$descGen = $activityRow['description'];
}else{
	$descGen = $activityRow['MCCCountryName'] . ":" . $activityRow['FundCode'] . " " . $activityRow['ProjectName'] . " - " . $activityRow['ActivityName'];
}
$description1 = $activity->addChild("description",htmlentities($descGen));
$description1->addAttribute("xml:lang","en");
$description1->addAttribute("type","1");

//Objectives
$description2 = $activity->addChild("description","Good governance, economic freedom and investment in the citizens of " . htmlentities($activityRow['IATI_NAME']));
$description2->addAttribute("xml:lang","en");
$description2->addAttribute("type","2");

//Target Groups
$description3 = $activity->addChild("description",htmlentities($activityRow['IATI_NAME']));
$description3->addAttribute("xml:lang","en");
$description3->addAttribute("type","3");
?>
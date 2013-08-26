<?php
if($countryFundRow['Status'] == "Completion")
{
	$activityStatusValue = "Completion";
	$activityStatusCode = "3";
}else if($countryFundRow['Status'] == "Implementation")
{
	$activityStatusValue = "Implementation";
	$activityStatusCode = "2";
}else 
{
	$activityStatusValue = "Not Applicable";
	$activityStatusCode = "0";
}

$activitystatus = $activity->addChild("activity-status",$activityStatusValue);
$activitystatus->addAttribute("xml:lang","en");
$activitystatus->addAttribute("code",$activityStatusCode);
?>
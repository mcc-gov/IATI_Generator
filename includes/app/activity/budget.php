<?php
$budgetQuery = mysqli_query($db,"SELECT Sum(Commitment), Sum(Disbursement) FROM `data` WHERE FundCode = '" . $activityRow['FundCode'] . "' AND MCCCountryCode = '" . $activityRow['MCCCountryCode'] . "' AND ProjectCode = '" . $activityRow['ProjectCode'] . "' AND ActivityCode = '" . $activityRow['ActivityCode'] . "' GROUP BY FundCode, MCCCountryCode, ProjectCode, ActivityCode");

$budgetRow3 = mysqli_fetch_row($budgetQuery);

$budgetTotal = floor($budgetRow3[0]);

$budget = $activity->addChild("budget");
$budget->addAttribute("type","2");
	$budgetPeriodStart = $budget->addChild("period-start",$activityRow['start_date']);
	$budgetPeriodStart->addAttribute("iso-date",$activityRow['start_date']);
	$budgetPeriodEnd = $budget->addChild("period-end",$activityRow['end_date']);
	$budgetPeriodEnd->addAttribute("iso-date",$activityRow['end_date']);
	$budgetValue = $budget->addChild("value",$budgetTotal);
	$budgetValue->addAttribute("value-date",$activityRow['start_date']);
	$budgetValue->addAttribute("currency","USD");
?>
<?php
$budgetQuery = mysqli_query($db,"SELECT Sum(Commitment), Sum(Disbursement) FROM `data` WHERE FundCode = '" . $projectRow['FundCode'] . "' AND MCCCountryCode = '" . $projectRow['MCCCountryCode'] . "' AND ProjectCode = '" . $projectRow['ProjectCode'] . "' GROUP BY FundCode, MCCCountryCode, ProjectCode");

$budgetRow2 = mysqli_fetch_row($budgetQuery);

$budgetTotal = floor($budgetRow2[0]);

$budget = $activity->addChild("budget");
$budget->addAttribute("type","2");
	$budgetPeriodStart = $budget->addChild("period-start",$projectRow['start_date']);
	$budgetPeriodStart->addAttribute("iso-date",$projectRow['start_date']);
	$budgetPeriodEnd = $budget->addChild("period-end",$projectRow['end_date']);
	$budgetPeriodEnd->addAttribute("iso-date",$projectRow['end_date']);
	$budgetValue = $budget->addChild("value",$budgetTotal);
	$budgetValue->addAttribute("value-date",$projectRow['start_date']);
	$budgetValue->addAttribute("currency","USD");
?>
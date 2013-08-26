<?php
$budgetQuery = mysqli_query($db,"SELECT Sum(Commitment), Sum(Disbursement) FROM `data` WHERE FundCode = '" . $countryFundRow['FundCode'] . "' AND MCCCountryCode = '" . $countryFundRow['MCCCountryCode'] . "' GROUP BY FundCode, MCCCountryCode");

$budgetRow1 = mysqli_fetch_row($budgetQuery);

$budgetTotal = floor($budgetRow1[0]);

$budget = $activity->addChild("budget");
$budget->addAttribute("type","2");
	$budgetPeriodStart = $budget->addChild("period-start",$countryFundRow['start_date']);
	$budgetPeriodStart->addAttribute("iso-date",$countryFundRow['start_date']);
	$budgetPeriodEnd = $budget->addChild("period-end",$countryFundRow['end_date']);
	$budgetPeriodEnd->addAttribute("iso-date",$countryFundRow['end_date']);
	$budgetValue = $budget->addChild("value",$budgetTotal);
	$budgetValue->addAttribute("value-date",$countryFundRow['start_date']);
	$budgetValue->addAttribute("currency","USD");
?>
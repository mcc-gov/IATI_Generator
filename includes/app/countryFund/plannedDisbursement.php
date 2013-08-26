<?php
$pdTotal = floor($budgetRow1[0] - $budgetRow1[1]);

$plannedDisbursement = $activity->addChild("planned-disbursement");
$plannedDisbursement->addAttribute("updated",$countryFundRow['end_date']);
	$plannedDisbursementPeriodStart = $plannedDisbursement->addChild("period-start",$countryFundRow['start_date']);
	$plannedDisbursementPeriodStart->addAttribute("iso-date",$countryFundRow['start_date']);
	$plannedDisbursementPeriodEnd = $plannedDisbursement->addChild("period-end",$countryFundRow['end_date']);
	$plannedDisbursementPeriodEnd->addAttribute("iso-date",$countryFundRow['end_date']);
	$plannedDisbursementValue = $plannedDisbursement->addChild("value",$pdTotal);
	$plannedDisbursementValue->addAttribute("value-date",$countryFundRow['start_date']);
	$plannedDisbursementValue->addAttribute("currency","USD");
?>
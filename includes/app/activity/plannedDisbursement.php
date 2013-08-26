<?php
$pdTotal = floor($budgetRow3[0] - $budgetRow3[1]);

$plannedDisbursement = $activity->addChild("planned-disbursement");
$plannedDisbursement->addAttribute("updated",$activityRow['end_date']);
	$plannedDisbursementPeriodStart = $plannedDisbursement->addChild("period-start",$activityRow['start_date']);
	$plannedDisbursementPeriodStart->addAttribute("iso-date",$activityRow['start_date']);
	$plannedDisbursementPeriodEnd = $plannedDisbursement->addChild("period-end",$activityRow['end_date']);
	$plannedDisbursementPeriodEnd->addAttribute("iso-date",$activityRow['end_date']);
	$plannedDisbursementValue = $plannedDisbursement->addChild("value",$pdTotal);
	$plannedDisbursementValue->addAttribute("value-date",$activityRow['start_date']);
	$plannedDisbursementValue->addAttribute("currency","USD");
?>
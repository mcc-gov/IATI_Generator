<?php
$pdTotal = floor($budgetRow2[0] - $budgetRow2[1]);

$plannedDisbursement = $activity->addChild("planned-disbursement");
$plannedDisbursement->addAttribute("updated",$projectRow['end_date']);
	$plannedDisbursementPeriodStart = $plannedDisbursement->addChild("period-start",$projectRow['start_date']);
	$plannedDisbursementPeriodStart->addAttribute("iso-date",$projectRow['start_date']);
	$plannedDisbursementPeriodEnd = $plannedDisbursement->addChild("period-end",$projectRow['end_date']);
	$plannedDisbursementPeriodEnd->addAttribute("iso-date",$projectRow['end_date']);
	$plannedDisbursementValue = $plannedDisbursement->addChild("value",$pdTotal);
	$plannedDisbursementValue->addAttribute("value-date",$projectRow['start_date']);
	$plannedDisbursementValue->addAttribute("currency","USD");
?>
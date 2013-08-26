<?php
	$countryBudget = $activity->addChild("country-budget-items");
	$countryBudget->addAttribute("vocabulary","1");
		$budgetItem = $countryBudget->addChild("budget-item");
		$budgetItem->addAttribute("code","1.4.3");
		$budgetItem->addAttribute("percentage","100");
			$bDesc = $budgetItem->addChild("description",htmlentities($countryFundRow['MCCCountryName'] . "-" . $countryFundRow['FundName'] . " Account Budget Item"));
			$bDesc->addAttribute("xml:lang","en");
?>
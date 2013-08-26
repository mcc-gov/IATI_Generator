<?php
$conditions = $activity->addChild("conditions");
$conditions->addAttribute("attached","1");
	//CONDITION 1
	$condition = $conditions->addChild("condition","According to MCC’s statute, a country may have its eligibility or assistance suspended or terminated if the country has engaged in activities contrary to the national security interests of the United States");
	$condition->addAttribute("type","1");
	//CONDITION 2
	$condition = $conditions->addChild("condition","According to MCC’s statute, a country may have its eligibility or assistance suspended or terminated if the country has engaged in a pattern of actions inconsistent with MCA eligibility criteria");
	$condition->addAttribute("type","1");
	//CONDITION 3
	$condition = $conditions->addChild("condition","According to MCC’s statute, a country may have its eligibility or assistance suspended or terminated if the country has failed to adhere to its responsibilities under a MCC program agreement");
	$condition->addAttribute("type","1");
?>
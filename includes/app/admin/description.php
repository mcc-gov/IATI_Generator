<?php
//General Description
$description1 = $activity->addChild("description","MCC-" . htmlentities($activityRow['FundName']));
$description1->addAttribute("xml:lang","en");
$description1->addAttribute("type","1");
?>
<?php
$title = $activity->addChild("title",htmlentities($projectRow['MCCCountryName'] . "-" . $projectRow['FundName'] . "-" . $projectRow['ProjectName']));
$title->addAttribute("xml:lang","en");
?>
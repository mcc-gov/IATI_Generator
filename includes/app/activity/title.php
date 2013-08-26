<?php
$title = $activity->addChild("title",htmlentities($activityRow['MCCCountryName'] . "-" . $activityRow['FundName'] . "-" . $activityRow['ProjectName'] . "-" . $activityRow['ActivityName']));
$title->addAttribute("xml:lang","en");
?>
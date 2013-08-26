<?php
$title = $activity->addChild("title","MCC-" . htmlentities($activityRow['FundName']));
$title->addAttribute("xml:lang","en");
?>
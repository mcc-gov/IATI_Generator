<?php
$title = $activity->addChild("title",htmlentities($countryFundRow['MCCCountryName'] . "-" . $countryFundRow['FundName']));
$title->addAttribute("xml:lang","en");
?>
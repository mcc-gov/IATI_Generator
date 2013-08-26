<?php
$iatiIdentifier = $activity->addChild("iati-identifier","US-18-" . htmlentities($countryFundRow['MCCCountryCode'] . "-" . $countryFundRow['FundCode']));
?>
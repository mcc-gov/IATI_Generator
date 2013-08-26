<?php
$recipientCountry = $activity->addChild("recipient-country",htmlentities($countryFundRow['IATI_NAME']));
$recipientCountry->addAttribute("code",$countryFundRow['IATI_COUNTRY_CODE']);
$recipientCountry->addAttribute("percentage","100");
?>
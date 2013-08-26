<?php
$recipientCountry = $activity->addChild("recipient-country",htmlentities($activityRow['IATI_NAME']));
$recipientCountry->addAttribute("code",$activityRow['IATI_COUNTRY_CODE']);
$recipientCountry->addAttribute("percentage","100");
?>
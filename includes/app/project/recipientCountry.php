<?php
$recipientCountry = $activity->addChild("recipient-country",htmlentities($projectRow['IATI_NAME']));
$recipientCountry->addAttribute("code",$projectRow['IATI_COUNTRY_CODE']);
$recipientCountry->addAttribute("percentage","100");
?>
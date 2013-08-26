<?php
$location = $activity->addChild("location");
$location->addAttribute("percentage","100");
	$locationName = $location->addChild("name",htmlentities($activityRow['IATI_NAME']));
	$locationCoordinates = $location->addChild("coordinates");
	$locationCoordinates->addAttribute("latitude",$activityRow['IATI_LAT']);
	$locationCoordinates->addAttribute("longitude",$activityRow['IATI_LON']); 
	$locationCoordinates->addAttribute("precision","9");
    $locationType = $location->addChild("location-type");
	$locationType->addAttribute("code","PCL");
	$locationDescription = $location->addChild("description",htmlentities($activityRow['IATI_NAME']));
	$locationAdministrative = $location->addChild("administrative",htmlentities($activityRow['IATI_NAME']));
	$locationAdministrative->addAttribute("country",$activityRow['IATI_COUNTRY_CODE']);
	$Gazetteer = $location->addChild("gazetteer-entry",$activityRow['IATI_COUNTRY_CODE']);
	$Gazetteer->addAttribute("gazetteer-ref","NGA");

?>
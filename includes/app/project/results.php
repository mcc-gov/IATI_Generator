<?php
	//Start Result Loop
	$indicatorQuery = mysqli_query($db,"SELECT * FROM indicators WHERE `country` = '" . $projectRow['MCCCountryName'] . "'  AND (('" . $projectRow['ProjectName'] . "' LIKE CONCAT('%',`project`,'%')) OR ISNULL(`project`))");
	
if(mysqli_num_rows($indicatorQuery) > 0){

	$result = $activity->addChild("result");
	$result->addAttribute("type","2");
	$result->addAttribute("aggregation-status","false");
		$resultTitle = $result->addChild("title",htmlentities($projectRow['MCCCountryName'] . "-" . $projectRow['ProjectName'] . " " . "Results"));
		$resultDescription = $result->addChild("description",htmlentities("Results of " . $projectRow['MCCCountryName'] . " Project Titled '" . $projectRow['ProjectName'] . "'"));
		$resultDescription->addAttribute("type","1");

while($indicatorRow = mysqli_fetch_array($indicatorQuery))
{
	//SET VARIABLES
	$indicatorTitle = (empty($indicatorRow['indicator']) ? $projectRow['ProjectName'] . "Indicator" : $indicatorRow['indicator']);
	$indicatorDescriptionBase = htmlentities((empty($indicatorRow['notes']) ? "Indicator for " . $projectRow['ProjectName'] : $indicatorRow['indicator']));
	$indicatorDescription = $indicatorRow['classification'] . " " . $indicatorRow['indicator_level'] . " of " . $indicatorDescriptionBase;
	$baselineYear = substr($projectRow['start_date'],0,4);
	$baselineValue = $indicatorRow['baseline'];
	$targetValue = $indicatorRow['target'];
	$actualValue = $indicatorRow['actual'];
	
	$resultIndicator = $result->addChild("indicator");
	$resultIndicator->addAttribute("measure",$indicatorRow['measure']);
	$resultIndicator->addAttribute("ascending","true");
		$indicatorTitle = $resultIndicator->addChild("title",htmlentities($indicatorTitle));
		$indicatorDescription = $resultIndicator->addChild("description",htmlentities($indicatorDescription));
		$indicatorDescription->addAttribute("type","1");
		$indicatorBaseline = $resultIndicator->addChild("baseline");
		$indicatorBaseline->addAttribute("year",$baselineYear);
		$indicatorBaseline->addAttribute("value",$baselineValue);
			$baselineComment = $indicatorBaseline->addChild("comment",$indicatorDescriptionBase . " Baseline");
		$indicatorPeriod = $resultIndicator->addChild("period");
			$periodStart = $indicatorPeriod->addChild("period-start",$projectRow['start_date']);
			$periodStart->addAttribute("iso-date",$projectRow['start_date']);
			$periodEnd = $indicatorPeriod->addChild("period-end",$projectRow['end_date']);
			$periodEnd->addAttribute("iso-date",$projectRow['end_date']);
			$periodTarget = $indicatorPeriod->addChild("target");
			$periodTarget->addAttribute("value",$targetValue);
				$targetComment = $periodTarget->addChild("comment",$indicatorDescriptionBase . " Target");
			$periodActual = $indicatorPeriod->addChild("actual");
			$periodActual->addAttribute("value",$actualValue);
				$actualComment = $periodActual->addChild("comment",$indicatorDescriptionBase . " Actual");
}
}else{
	$result = $activity->addChild("result");
	$result->addAttribute("type","3");
	$result->addAttribute("aggregation-status","false");
		$resultTitle = $result->addChild("title",htmlentities($projectRow['MCCCountryName'] . "-" . $projectRow['ProjectName'] . " " . "Results"));
		$resultDescription = $result->addChild("description",htmlentities("Results of " . $projectRow['MCCCountryName'] . " Project Titled '" . $projectRow['ProjectName'] . "'"));
		$resultDescription->addAttribute("type","1");
	
	//SET VARIABLES
	$indicatorTitle = "Project Performance";
	$indicatorDescriptionBase = "Project Indicator";
	$indicatorDescription = "Indicator for " . htmlentities($projectRow['MCCCountryName'] . "-" . $projectRow['ProjectName']);
	$baselineYear = substr($projectRow['start_date'],0,4);
	$baselineValue = "pending";
	$targetValue = "pending";
	$actualValue = "pending";
	
	$resultIndicator = $result->addChild("indicator");
	$resultIndicator->addAttribute("measure","pending");
	$resultIndicator->addAttribute("ascending","true");
		$indicatorTitle = $resultIndicator->addChild("title",$indicatorTitle);
		$indicatorDescription = $resultIndicator->addChild("description",$indicatorDescription);
		$indicatorDescription->addAttribute("type","1");
		$indicatorBaseline = $resultIndicator->addChild("baseline");
		$indicatorBaseline->addAttribute("year",$baselineYear);
		$indicatorBaseline->addAttribute("value",$baselineValue);
			$baselineComment = $indicatorBaseline->addChild("comment",$indicatorDescriptionBase . " Baseline");
		$indicatorPeriod = $resultIndicator->addChild("period");
			$periodStart = $indicatorPeriod->addChild("period-start",$projectRow['start_date']);
			$periodStart->addAttribute("iso-date",$projectRow['start_date']);
			$periodEnd = $indicatorPeriod->addChild("period-end",$projectRow['end_date']);
			$periodEnd->addAttribute("iso-date",$projectRow['end_date']);
			$periodTarget = $indicatorPeriod->addChild("target");
			$periodTarget->addAttribute("value",$targetValue);
				$targetComment = $periodTarget->addChild("comment",$indicatorDescriptionBase . " Target");
			$periodActual = $indicatorPeriod->addChild("actual");
			$periodActual->addAttribute("value",$actualValue);
				$actualComment = $periodActual->addChild("comment",$indicatorDescriptionBase . " Actual");
		
}
?>
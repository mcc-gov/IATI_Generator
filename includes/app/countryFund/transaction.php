<?php
//Start Transaction Loop
	$transactionQuery = mysqli_query($db,"SELECT * FROM data WHERE `MCCCountryCode` = '" . $activityRow['MCCCountryCode'] . "'  AND `FundCode` = '" . $activityRow['FundCode'] . "'  AND `ProjectCode` = '" . $activityRow['ProjectCode'] . "'  AND `ActivityCode` = '" . $activityRow['ActivityCode'] . "' ORDER BY `QTRStart`");

while($transactionRow = mysqli_fetch_array($transactionQuery))
{

$transaction = $activity->addChild("transaction");
$transaction->addAttribute("ref",$transactionRow['MCCCountryCode'] . "-" . $transactionRow['FundCode'] . "-" . $transactionRow['ProjectCode'] . "-" . $transactionRow['ActivityCode'] . "-" .$transactionRow['QTRStart']. "-C");

// AID TYPE
	$aidType = $transaction->addChild("aid-type");
	$aidType->addAttribute("code","C01");
	
// DESCRIPTION
	$description = $transaction->addChild("description",htmlentities("Commitment: " . $transactionRow['MCCCountryName'] . "-" . $transactionRow['FundName'] . "-" . $transactionRow['ProjectName'] . "-" . $transactionRow['ActivityName'] . "-" .$transactionRow['QTRStart']));
	$description->addAttribute("type","1");

// DISBURSEMENT CHANNEL
	$disbursementChannel = $transaction->addChild("disbursement-channel");
	$disbursementChannel->addAttribute("code","1");
	
// FINANCE CODE
	$financeCode = $transaction->addChild("finance-code");
	$financeCode->addAttribute("code","110");
	
// FLOW TYPE
	$flowType = $transaction->addChild("flow-type");
	$flowType->addAttribute("code","10");		

// PROVIDER ORG
	$providerOrg = $transaction->addChild("provider-org","Millennium Challenge Corporation");
	$providerOrg->addAttribute("ref",$constants['providerCode']);
	
// RECEIVER ORG (Swith Case Fund Type) see participating org 4
	$receiverOrg = $transaction->addChild("receiver-org",htmlentities($activityRow['IATI_NAME']));
	
// TIED STATUS
	$tiedStatus = $transaction->addChild("tied-status");
	$tiedStatus->addAttribute("code","5");
	
// TRANSACTION DATE
	$transactionDate = $transaction->addChild("transaction-date",$transactionRow['QTRStart']);
	$transactionDate->addAttribute("iso-date",$transactionRow['QTRStart']);	

// TRANSACTION TYPE
	$transactionType = $transaction->addChild("transaction-type","COMMITMENT");
	$transactionType->addAttribute("code","C");
	
//  VALUE
	$transactionValue = $transaction->addChild("value",$transactionRow['Commitment']);
	$transactionValue->addAttribute("value-date",$transactionRow['QTRStart']);
	$transactionValue->addAttribute("currency","USD");
//------------------------------------------------------------------------------------------------------
$transaction = $activity->addChild("transaction");
$transaction->addAttribute("ref",$transactionRow['MCCCountryCode'] . "-" . $transactionRow['FundCode'] . "-" . $transactionRow['ProjectCode'] . "-" . $transactionRow['ActivityCode'] . "-" .$transactionRow['QTRStart']. "-D");

// AID TYPE
	$aidType = $transaction->addChild("aid-type");
	$aidType->addAttribute("code","C01");
	
// DESCRIPTION
	$description = $transaction->addChild("description",htmlentities("Disbursement: " . $transactionRow['MCCCountryName'] . "-" . $transactionRow['FundName'] . "-" . $transactionRow['ProjectName'] . "-" . $transactionRow['ActivityName'] . "-" .$transactionRow['QTRStart']));
	$description->addAttribute("type","1");

// DISBURSEMENT CHANNEL
	$disbursementChannel = $transaction->addChild("disbursement-channel");
	$disbursementChannel->addAttribute("code","1");
	
// FINANCE CODE
	$financeCode = $transaction->addChild("finance-code");
	$financeCode->addAttribute("code","110");
	
// FLOW TYPE
	$flowType = $transaction->addChild("flow-type");
	$flowType->addAttribute("code","10");		

// PROVIDER ORG
	$providerOrg = $transaction->addChild("provider-org","Millennium Challenge Corporation");
	$providerOrg->addAttribute("ref",$constants['providerCode']);
	
// RECEIVER ORG (Swith Case Fund Type) see participating org 4
	$receiverOrg = $transaction->addChild("receiver-org",htmlentities($activityRow['IATI_NAME']));
	
// TIED STATUS
	$tiedStatus = $transaction->addChild("tied-status");
	$tiedStatus->addAttribute("code","5");
	
// TRANSACTION DATE
	$transactionDate = $transaction->addChild("transaction-date",$transactionRow['QTRStart']);
	$transactionDate->addAttribute("iso-date",$transactionRow['QTRStart']);	

// TRANSACTION TYPE
	$transactionType = $transaction->addChild("transaction-type","DISBURSEMENT");
	$transactionType->addAttribute("code","D");
	
//  VALUE
	$transactionValue = $transaction->addChild("value",$transactionRow['Disbursement']);
	$transactionValue->addAttribute("value-date",$transactionRow['QTRStart']);
	$transactionValue->addAttribute("currency","USD");

}
?>
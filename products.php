<!DOCTYPE html>
<head>
<?php include ("global/header.php") ?>
<?php include ("_classes/SearchQuery.php");?>
</head>
<body>
<form name="form1" id="form1">
<table class="tblFrame tblFrameDropShadow" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody><tr><td></td></tr>
<tr>
<td class="trFrameBody">
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->

<?
extract($_REQUEST);
?>

<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tbody>
<tr>
<td width="50%" class="PageHeader">Internet Subscription Plans:</td>
<td width="50%" align="right"></td>
</tr>
<tr id="FormSearchCriteria">
<td>

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
<fieldset>
<legend>Search & Filters</legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td width="80" class="HeaderBlue">Search:</td>
<td class="CellGrey1">

<?
$options = "...,Product Name|ProductName,Price|Price";
$json = '{"Type":"List","Name":"sColumn","Selected":"'.$sColumn.'"}';
Forms_DropDown($options,$json)
?>

</td>
<td width="80" class="HeaderBlue">For:</td>
<td class="CellGrey1">

<? Forms_TextField('{"Name":"sString","Value":"'.$sString.'"}') ?>

</td>
</tr>
<tr>
<td class="HeaderBlue">Type:</td>
<td class="CellGrey1">

<?
$Options = "...,UpLoad Speed|UploadSpeed,Download Speed|DownloadSpeed";
$Json = '{"Type":"List","Name":"sType","Selected":"'.$sType.'"}';
Forms_DropDown($Options,$Json)
?>

</td>
<td class="HeaderBlue">Speed:</td>
<td class="CellGrey1">

<?
$Options = "...,Less Than 100|<100,Greater Than 100|>100";
$Json = '{"Type":"List","Name":"sSpeed","Selected":"'.$sSpeed.'"}';
Forms_DropDown($Options,$Json)
?>

</td>
</tr>
<tr>
<td class="HeaderBlue">Technology:</td>
<td class="CellGrey1">

<?
$Options = "...,DialUp,Fiber";
$Json = '{"Type":"List","Name":"sTechnology","Selected":"'.$sTechnology.'"}';
Forms_DropDown($Options,$Json)
?>

</td>
<td class="HeaderBlue">Static IP:</td>
<td class="CellGrey1">

<?
$Options = "...,Yes|1,No|0";
$Json = '{"Type":"List","Name":"sStaticIP","Selected":"'.$sStaticIP.'"}';
Forms_DropDown($Options,$Json)
?>

</td>
</tr>
</table>
</fieldset>
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->


</td>
<td>

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
<fieldset>
<legend>Page Options</legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td width="80" class="HeaderBlue">From Date:</td>
<td class="CellGrey4"></td>
<td width="80" class="HeaderBlue">To Date:</td>
<td class="CellGrey4"></td>
</tr>
<tr>
<td class="HeaderYellow">Quick Date:</td>
<td class="CellGrey4">
</td>
<td class="HeaderBlue">Records:</td>
<td class="CellGrey1">
</td>
</tr>
<tr>
<td class="HeaderBlue">Order By:</td>
<td class="CellGrey1">

<?
$Options = "Product Name|ProductName,Price|Price";
$Json = '{"Type":"List","Name":"sOrderBy","Selected":"'.$sOrderBy.'","Onchange":"fncGetTo(\'\',500)"}';
Forms_DropDown($Options,$Json)
?>

</td>
<td class="HeaderBlue">Sort:</td>
<td class="CellGrey1">

<?
$Options = "Ascending|ASC,Descending|DESC";
$Json = '{"Type":"List","Name":"sSort","Selected":"'.$sSort.'","Onchange":"fncGetTo(\'\',500)"}';
Forms_DropDown($Options,$Json)
?>

</td>
</tr>
</table>
</fieldset>
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->


</td>
</tr>
<tr>
<td>
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
<td align="right">
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->

    <BUTTON onClick="fncValue('PageNo',1);fncSubmitGet('',1,1000);return false;"><i class="fas fa-search"></i> Search/Filter</BUTTON>
    <BUTTON onClick="fncNavTo('?');return false;"><i class="fas fa-sync"></i> Reset</BUTTON>

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
</tr>
<tr>
<td colspan="2">

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->

<?
$Sql = "";
//Class for UploadSpeed
if($sType=="UploadSpeed"){
	$obj_srch=new UploadSpeed();
	$obj_srch->sColumn=$sColumn;
	$obj_srch->sString=$sString;
	$obj_srch->sType=$sType;
	$obj_srch->sSpeed=$sSpeed;
	$obj_srch->sTechnology=$sTechnology;
	$obj_srch->sStaticIP=$sStaticIP;
	$obj_srch->sOrderBy=$sOrderBy;
	$obj_srch->sSort=$sSort;

	if($sSpeed=="<100"&&$sTechnology=="Fiber"){ $Sql=$obj_srch->UploadSpeedlessThan100AndFiber(); }
	else if($sSpeed=="<100"){ $Sql=$obj_srch->UploadSpeedlessThan100(); }
}
//Class for DownloadSpeed
if($sType=="DownloadSpeed"){
	$obj_srch=new DownloadSpeed();
	$obj_srch->sColumn=$sColumn;
	$obj_srch->sString=$sString;
	$obj_srch->sType=$sType;
	$obj_srch->sSpeed=$sSpeed;
	$obj_srch->sTechnology=$sTechnology;
	$obj_srch->sStaticIP=$sStaticIP;
	$obj_srch->sOrderBy=$sOrderBy;
	$obj_srch->sSort=$sSort;

	if($sSpeed==">100"){ $Sql=$obj_srch->DownloadSpeedGreaterThan100(); }
	else if($sSpeed=="<100"&&$sTechnology=="Fiber"){ $Sql=$obj_srch->DownloadSpeedLessThan100AndFiber(); }
	else if($sSpeed=="<100"){ $Sql=$obj_srch->DownloadSpeedLessThan100(); }
}	

Misc_Echo($Sql);
//Prints all record if the search filters does not match any rules
if($Sql==""){
	echo "No Search conditions added for selected filters!";
	$Sql = "select * from MINIAPPS..InternetProducts";
}
$dat = odbc_exec($Database,$Sql);
?>

<fieldset>
<legend>Products</legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2" style="">
<tbody>
<tr align="center">
<td width="40" class="HeaderOrange">No.</td>
<td class="HeaderOrange">Product Name</td>
<td class="HeaderOrange">Price</td>
<td class="HeaderOrange">Upload Speed</td>
<td class="HeaderOrange">Download Speed</td>
<td class="HeaderOrange">Tech</td>
<td class="HeaderOrange">Statis IP</td>
<td width="80" class="HeaderOrange">Status</td>
<td width="60" class="HeaderYellow">Actions</td>
</tr>

<?
$Row=0;
while($rs1 = odbc_fetch_array($dat)){
$Row = $Row+1;

extract($rs1);
if($StaticIP==1){ $StaticIP="Yes"; }
	else{ $StaticIP="No"; }
?>
<tr>
<td class="CellGrey1"><?=$Row."."?></td>
<td class="CellGrey1"><?=$ProductName?></td>
<td class="CellGrey1"><?=$Price?></td>
<td class="CellGrey1"><?=$UploadSpeed?></td>
<td class="CellGrey1"><?=$DownloadSpeed?></td>
<td class="CellGrey1"><?=$Technology?></td>
<td class="CellGrey1"><?=$StaticIP?></td>
<? Html_StatusCell('{"Status":"'.$Status.'"}') ?>
<td class="CellGrey1 Center">

<i class="fas fa-search IconButtonG" title="View/Modify" ></i>

</td>
</tr>
<?
}
?>

</tbody>
</table>
</fieldset>
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->


</td>
</tr>
<tr>
<td colspan="2">
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->

<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tbody>
<tr>
<td>
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
<td align="center">
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
<td align="right">
<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
</tr>
</tbody>
</table>


<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
</tr>
</tbody>
</table>

<!-- ----------------------------------------------------------------->
<!-- ----------------------------------------------------------------->
</td>
</tr>
</tbody>
</table>
</form>
</body>
</html>
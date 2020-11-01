<?
include ("functions/database.php");


function Forms_DropDown($Param,$JsonOrArray){

	if(is_array($JsonOrArray)) {$Array=$JsonOrArray;}else{$Array=json_decode($JsonOrArray,true);}
	extract($Array);
	
	if($Class=="") $Class = "BgGrey1";
	if($Style=="") $Style = "width:100%;";
	if($Addclass!="") $Class = "$Class $Addclass";
	if($Addstyle!="") $Style = "$Style $Addstyle";

	if($Readonly==1) {$Extra = $Extra."disabled ";$Class = Strings_Replace($Class,"BgGrey1","BgGrey4");}
	if($Validate==1) {$Extra = $Extra.'validate="1" ';}
	if($Onchange!="") $Extra = $Extra.'onchange="'.$Onchange.'" ';

	if($Id=="") $Id=$Name;
	
	if($Option1!="") {
		if($Option1=="ANY"||$Option1=="ALL"||$Option1=="..."){
			$Opt = "<option value=''>".$Option1."</option>";
		}else{
			$Arr = explode("|",$Option1);
			$Opt = "<option value='".$Arr[1]."'>".$Arr[0]."</option>";
		}
	}
	
	if($f=="") $f=$Type;

	if($f=="Static"||$Type==""||$Type=="Static"){
		$Opt .= $Param;
	}
	if($f=="Preload"){
		$Opt .= $Param;
		if($Selected!="") $Opt = Strings_Replace($Opt,'oid="'.$Selected.'"',"selected");		
	}
	if($f=="List"){
		$Dims = explode(",",$Param);
		for ($i = 0; $i < count($Dims); $i++) {
			$TxtVal = explode("|",$Dims[$i]);
			$Txt = $TxtVal[0];
			$Val = $TxtVal[1];
			if($Val=="") $Val = $Txt;
			if($Val=="ANY"||$Val=="ALL"||$Val=="...") $Val = "";
			$Val=trim($Val);
			if($Selected==$Val){$S="selected";}else{$S="";}
			$Opt .= "<option value=\"$Val\" $S>$Txt</option>";
		}
	}
	if($f=="SqlList"){
		if($Param!=""){
		//Misc_Echo($Param);
		global $Database;
		$dat = odbc_exec($Database,$Param);
		while($Array = odbc_fetch_array($dat)){
			$Val="";$Txt="";
			extract($Array);
			if($Val=="") $Val = $Txt;
			if($Txt=="") $Txt = $Val;
			if($Val=="ANY"||$Val=="ALL"||$Val=="...") $Val = "";
			if($Val==$Selected){$S="selected";}else{$S="";}	
			$Opt .= "<option $S value='$Val' title='$Tit'>$Txt</option>";
		}
		}
	}

	$Html = "
	<select name=\"$Name\" id=\"$Id\" class=\"$Class\" style=\"$Style\" $Extra>
	$Opt
	</select>
	";
	
	if($Return==1) return $Html;
	echo $Html;

}
function Forms_TextField($JsonOrArray){
	
	if(is_array($JsonOrArray)) {extract($JsonOrArray);}else{$Array = json_decode($JsonOrArray,true);extract($Array);}
	if($Class=="") $Class = "BgGrey1";
	if($Addclass!="") $Class = "$Class $Addclass";
	if($Style=="") $Style = "width:100%";
	if($Addstyle=="") $Style .= ";$Addstyle";
	if($Max=="") $Max = "50";
	if($Id=="") $Id = $Name;
	if($Onchange!="") $Extra = $Extra.'onchange="'.$Onchange.'" ';
	if($Onblur!="") $Extra = $Extra.'onblur="'.$Onblur.'" ';
	if($Placeholder!="") $Extra = $Extra.'placeholder="'.$Placeholder.'" ';
	if($Readonly==1) {$Extra = $Extra."readonly ";}
	if($Readonly==2) {$Extra = $Extra."readonly ";$Class = Strings_Replace($Class,"BgGrey1","BgGrey4");} 
	if($Disabled==1) {$Extra = $Extra."disabled ";$Class = Strings_Replace($Class,"BgGrey1","BgGrey4");} 
	if($Validate!=""){
		$Extra = $Extra.'validate="'.$Validate.'"';
		if(Strings_Left($Validate,7)=='Numeric') $Class = "$Class Right Numeric Validate";
		if($Validate=='Decimals|ExchangeRate') $Class = "$Class Right Numeric Validate";
		if($Validate=='Decimals|Currency') $Class = "$Class Right Numeric Decimals Validate";
		if($Validate=='DecimalsNoNegative|Currency') $Class = "$Class Right Numeric Decimals Validate";
	}
	
	$Html = "<input type=\"text\" id=\"$Id\" name=\"$Name\" class=\"$Class\" style=\"$Style\" maxlength=\"$Max\" value=\"$Value\" $Extra>";	
	if($Return==1){return $Html;die;}
	echo $Html;

}
function Html_StatusCell($JsonOrArray){

	if(is_array($JsonOrArray)) {extract($JsonOrArray);}else{$Array = json_decode($JsonOrArray,true);extract($Array);}
	//misc_printarray($Array);
	if($f=="") $f="Default";

	if($f=="Default"){
		switch ($Status) {
		case "0":
			$Array = array("CellRed4","DISABLED","DIS","DI");
			break;
		case "1":
			$Array = array("CellGreen1","ACTIVE","ACT","AC");
			break;
		case "2":
			$Array = array("CellBlue1","CLOSED","CLO","CL");
			break;
		case "VOID":
			$Array = array("CellRed4","VOID","VOI","VO");
			break;
		case "REVISED":
			$Array = array("CellYellow1","REVISED","REV","RE");
			break;
		case "EXPIRED":
			$Array = array("CellRed4","EXPIRED","EXP","EX");
			break;
		case "PENDING":
			$Array = array("CellGrey4","PENDING","PEN","PE");
			break;
		case "SAVED":
			$Array = array("CellGrey4","SAVED","SAV","SA");
			break;
		case "DRAFT":
			$Array = array("CellGrey4","DRAFT","DRA","DR");
			break;
		case "ACTIVE":
			$Array = array("CellGreen1","ACTIVE","ACT","AC");
			break;
		case "TEMPLATE":
			$Array = array("CellBlue1","TEMPLATE","TEM","TE");
			break;
		case "PAID":
			$Array = array("CellBlue1","PAID","PAI","PA");
			break;
		case "COMPLETED":
			$Array = array("CellGreen1","COMPLETED","COM","CO");
			break;
		default:
			$Array = array("CellGrey4","????","???");
		}
	}

	$Class = 'Center '.$Array[0];
	$Title = ($Title!='') ? $Array[1].":$Title": $Array[1];
	$Text = $Array[1];
	if($Output=='3') {$Text=$Array[2];$SpanClass="LinkInfo";}	
	if($Output=='2') {$Text=$Array[3];$SpanClass="LinkInfo";}	
	if($Onclick!=''){
		$Onclick = 'onclick="'.$Onclick.'"';
		$SpanClass = 'LinkBlue';
	}
	
	$Html = "<td class=\"$Class\"><span class=\"$SpanClass\" title=\"$Title\" $Onclick>$Text</span></td>";
	if($Text=='') $Html = "<td class=\"$Class\"></td>";

		
	//if($Output=="") $Html = "<td class=\"Center ".$Array[0]."\" style=\"".$Style."\">".$Array[1]."</td>";
	//if($Output=="Short") $Html = "<td class=\"Center ".$Array[0]."\" style=\"".$Style."\"><span class=\"InfoOnly\" title=\"".$Array[1]."\">".$Array[2]."</span></td>";
	if($Output=="Array") return $Array;
	if($Return==1) return $Html;
	echo $Html;

}
function Misc_Echo($Str){

	global $G_Authority;
	if($G_Authority<=20) echo "<p>$Str</p>";

}
?>
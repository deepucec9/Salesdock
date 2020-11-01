<?
class UploadSpeed{
	
	public function UploadSpeedlessThan100(){
		$Sql = "";
		if($this->sColumn!=""&&$this->sString!="") $Sql = "$Sql and $this->sColumn like '%$this->sString%' ";
		if($this->sType!=""){
			if($this->sSpeed!="") $Sql = "$Sql and $this->sType$this->sSpeed ";
		}
		

		$Sql =	"
				select * from MINIAPPS..InternetProducts where Status='1' $Sql order by $this->sOrderBy $this->sSort ; 
				";
		//Misc_Echo($Sql);
		return $Sql;
	}
	public function UploadSpeedlessThan100AndFiber(){
		$Sql = "";
		if($this->sColumn!=""&&$this->sString!="") $Sql = "$Sql and $this->sColumn like '%$this->sString%' ";
		if($this->sType!=""){
			if($this->sSpeed!="") $Sql = "$Sql and $this->sType$this->sSpeed ";
		}
		if($this->sTechnology!="") $Sql = "$Sql and Technology = '$this->sTechnology' ";
		if($this->sStaticIP!="") $Sql = "$Sql and StaticIP = '$this->sStaticIP' ";

		$Sql =	"
				select * from MINIAPPS..InternetProducts where Status='1' $Sql order by $this->sOrderBy $this->sSort ; 
				";
		//Misc_Echo($Sql);
		return $Sql;
	}
	
}

class DownloadSpeed{
	
	public function DownloadSpeedGreaterThan100(){
		$Sql = "";
		if($this->sColumn!=""&&$this->sString!="") $Sql = "$Sql and $this->sColumn like '%$this->sString%' ";
		if($this->sType!=""){
			if($this->sSpeed!="") $Sql = "$Sql and $this->sType$this->sSpeed ";
		}

		$Sql =	"
				select * from MINIAPPS..InternetProducts where Status='1' $Sql order by $this->sOrderBy $this->sSort ; 
				";
		//Misc_Echo($Sql);
		return $Sql;
	}
	public function DownloadSpeedLessThan100(){
		$Sql = "";
		if($this->sColumn!=""&&$this->sString!="") $Sql = "$Sql and $this->sColumn like '%$this->sString%' ";
		if($this->sType!=""){
			if($this->sSpeed!="") $Sql = "$Sql and $this->sType$this->sSpeed ";
		}

		$Sql =	"
				select * from MINIAPPS..InternetProducts where Status='1' $Sql order by $this->sOrderBy $this->sSort ; 
				";
		//Misc_Echo($Sql);
		return $Sql;
	}
	public function DownloadSpeedLessThan100AndFiber(){
		$Sql = "";
		if($this->sColumn!=""&&$this->sString!="") $Sql = "$Sql and $this->sColumn like '%$this->sString%' ";
		if($this->sType!=""){
			if($this->sSpeed!="") $Sql = "$Sql and $this->sType$this->sSpeed ";
		}
		if($this->sTechnology!="") $Sql = "$Sql and Technology='$this->sTechnology'";

		$Sql =	"
				select * from MINIAPPS..InternetProducts where Status='1' $Sql order by $this->sOrderBy $this->sSort ; 
				";
		//Misc_Echo($Sql);
		return $Sql;
	}
}
?>
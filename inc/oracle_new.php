<?php
class ORACLE{
	var $username='';
	var $password='';
	var $servername='';
	var $rp = '';
	var $stmt='';
	var $rows='';
	var $results='';
	var $str='';
	function ORACLE($username='',$password='',$servername=''){
		$this->servername=$servername;
		$this->username=$username;
		$this->password=$password;
		if(!empty($servername) && !empty($username)){
			$this->connect();
		}
	}
	function connect(){
		$this->rp=oci_connect($this->username, $this->password, $this->servername)or die("資料庫連接失敗");
	}

	#######################################################
	# 2015.10.21 Rewrite and test finish by Ting-Rui Chen #
	#######################################################
	function query($Qstr){
		if ($Qstr) {
			$this -> str = $Qstr;
			//change encoding before query cuz
			$Qstr = mb_convert_encoding($Qstr, "BIG5", "UTF-8");
			$stmt=oci_parse($this->rp, $Qstr); // parse sql to oracle statement

			if (!@oci_execute($stmt,OCI_COMMIT_ON_SUCCESS)){ // execute and auto commit to database
					//error occur and print error and sql
					$oci_err=@OCIError($stmt);
					return $oci_err; //add by boblee!
					//echo "<p>資料處理失敗，錯誤訊息: " . $oci_err[message] . "<br>錯誤請求指令" . $this -> str ."</p><hr>";
			}
			else {
				return $stmt;
			}
		}
	}

	#######################################################
	# 2015.10.21 Rewrite and test finish by Ting-Rui Chen #
	#######################################################
	function fetch_array($resource){
			$this->rows = oci_fetch_all($resource, $this->results);
			#轉換編碼
			for ($nCOL=1; $nCOL <= oci_num_fields($resource); $nCOL++) { // For each col. to do change encoding
					$Field_Name = oci_field_name($resource, $nCOL); // Get current field name
					for ($nROW=0; $nROW < sizeof($this->results[$Field_Name]); $nROW++) { // For each row to do change encoding
							$this->results[$Field_Name][$nROW] = mb_convert_encoding($this->results[$Field_Name][$nROW], "UTF-8", "BIG5");
					}
			}
			return $this->results;
	}

	function fetch_row($resource){
		return oci_fetch_row($resource);
	}
	function free_result($resource){
		return oci_free_statement($resource);
	}
	function num_rows($resource){
		return $this->$rows;
	}

	function next_id($table)
	{
		$Q = "SELECT MAX(ID) FROM ".$table;
		$id = $this->query_array($Q);
		return ($id['MAX(ID)'][0] == '') ? 0 : ++$id['MAX(ID)'][0];
	}

	#######################################################
	# 2015.11.16 Rewrite and test finish by Ting-Rui Chen #
	#######################################################
	function insert_id(){
		$pos = strpos($this->str, "INTO");
		$pos2 = strpos($this->str, "(");
		if($pos === false)
		{
			$pos = strpos($this->str, "into");
			if($pos === false){echo "<p>錯誤！！</p>";}
			else{
				$pos += 5;
				$len = $pos2 - $pos;
				$name = substr($str, $pos, $len);
			}
		}
		else
		{
			$pos += 5;
			$len = $pos2 - $pos;
			$name = substr($str, $pos, $len);
		}

		if($name != "")
		{
			$Q = "SELECT MAX(ID) FROM ".$name;
			$id = $this->query_array($Q);
			return ++$id['MAX(ID)'][0];
		}
		else
		{
			echo "<p>錯誤！！</p>";
		}
	}

	function query_first_row($Qstr){
		return $this->fetch_row($this->query($Qstr));
	}
	
	#####################################
	# 2016.11.05 Write and test finishd #
	#####################################
	
	/*
	*	this function "query_array" has been rewrited
	*	which can optionally returns JSON type array used for dataTable, jqGrid, ...etc.
	*
	*	@param  string $Qstr	  : SQL statement
	*	@param  bool   $isRowMode : An optional parameter decide OCI_FETCH_MODE
	*	@return array of data
	*
	*	usage:
	*	Default. Column Mode:
	*	$data = $db -> query_array($sql);
	*	
	*	For dataTable, jqGrid. Row Mode:
	*	$aaData['rows'] = $db -> query_array($sql, true);
	*/
	function query_array($Qstr, $isRowMode = false){
		$resource = $this->query($Qstr);
		
		if(!$isRowMode)
			return $this->fetch_array($resource);
		
		$this->rows = oci_fetch_all($resource, $this->results,
									0, -1, //skip, maxrows(-1 = all rows)
									OCI_ASSOC + OCI_FETCHSTATEMENT_BY_ROW);
		//Convert Encoding
		for($i = 0 ; $i < sizeof($this->results) ; $i++){
			array_walk(
				$this->results[$i],
				function(&$val){
					$val = mb_convert_encoding($val, "UTF-8", "BIG5");
				}
			);
		}
		
		return $this->results;
	}
	
	/*
	*	this function "fetch_cell" is used to fetch a datum.
	*
	*	@param  string $Qstr    : SQL statement
	*	@param  bool   $colName : An optional parameter can be used to fetch a specific column.
	*	@return mixed $ret
	*
	*	usage:
	*	$val = $db -> fetch_cell($sql);
	*	OR
	*	$val = $db -> fetch_cell($sql [,string $Field_Name]);
	*/
	function fetch_cell($Qstr, $colName = ""){
		return $colName === ""  ? oci_fetch_row($this->query($Qstr))[0]
								: oci_fetch_assoc($this->query($Qstr))[strtoupper($colName)];
	}
}
?>

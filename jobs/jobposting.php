<?
class JobPosting {
	// Display properties
	var $type;
	var $nameOfPoster;
	var $emailOfPoster;
	var $jobTitle;
	var $expiryDate;
	var $jobPosting;
	var $contactInformation;
	var $id;
	var $publishDate;
	
	// Non-display properties
	var $isPublished;
	
	function JobPosting	($type,
						$nameOfPoster,
						$emailOfPoster,
						$jobTitle,
						$expiryDate,
						$jobPosting,
						$contactInformation)
	{
		$this->type = $type;
		$this->nameOfPoster = $nameOfPoster;
		$this->jobTitle = $jobTitle;
		$this->expiryDate = $expiryDate;
		$this->jobPosting = str_replace("\n", "<br/>", $jobPosting);
		$this->contactInformation = str_replace("\n", "<br/>", $contactInformation);
		$this->emailOfPoster = $emailOfPoster;
		
		$this->isPublished = false;
	}
	
	function isValid(&$refToInvalidFields) {
		
		$refToInvalidFields = array();
		
		if ( !string_isset_within_length($this->type, 50) ) {
			//echo "fails on 1";
			array_push($refToInvalidFields, "type");
			//return false;
		}
		
		if ( !string_isset_within_length($this->nameOfPoster, 100) ) {
			//echo "fails on 2";
			array_push($refToInvalidFields, "nameOfPoster");
			//return false;
		}
		
		if ( !string_isset_within_length($this->emailOfPoster, 100) ) {
			//echo "fails on 3";
			array_push($refToInvalidFields, "emailOfPoster");
			//return false;
		}
		else {
			$isAValidEmailAddress = preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/" , $this->emailOfPoster);
			
			if ( !$isAValidEmailAddress ) {
				//echo "invalid email " . $isAValidEmailAddress;
				array_push($refToInvalidFields, "emailOfPoster");
				//return false;
			}
		}
		
		if ( !string_isset_within_length($this->jobTitle, 100) ) {
			array_push($refToInvalidFields, "jobTitle");
		}
		
		if ( !strlen($this->jobPosting) > 0 ) {
			//echo "fails on 4";
			array_push($refToInvalidFields, "jobPosting");
			//return false;
		}
		
		if ( !strlen($this->contactInformation) > 0 ) {
			//echo "fails on 5";
			array_push($refToInvalidFields, "contactInformation");
			//return false;
		}
		
		if ( !isset($this->expiryDate) ) {
			//echo "fails on 6";
			array_push($refToInvalidFields, "expiryDate");
			//return false;
		}
		else {
			$td = date($this->expiryDate);
			if ( !checkdate($td['month'], $td['day'], $td['year']) ) {
				//echo "fails on 7";
				array_push($refToInvalidFields, "expiryDate");
				//return false;
			}
			else
			{
				$dateIsInThePast = ($this->expiryDate < time());
				
				if ( $dateIsInThePast ) {
					//echo "date is in the past";
					array_push($refToInvalidFields, "expiryDate");
					//return false;
				}
			}
		}
		
		if ( count($refToInvalidFields) == 0 ) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function save() {
		if ( $this->isValid($refNull) ) {
			// write to database
			$db = mysql_connect(DBHOST, DBUSER, DBPASS);
			mysql_select_db(DBNAME);
			
			$sql = "INSERT INTO submitted_job_postings (type, nameOfPoster, emailOfPoster, jobTitle, expiryDate, jobPosting, contactInformation) VALUES ([type], [nameOfPoster], [emailOfPoster], [jobTitle], [expiryDate], [jobPosting], [contactInformation])";
			
			sql_insert_parameter($sql, "type", $this->type);
			sql_insert_parameter($sql, "nameOfPoster", $this->nameOfPoster);
			sql_insert_parameter($sql, "jobTitle", $this->jobTitle);
			sql_insert_parameter($sql, "expiryDate", date("Y-m-d", $this->expiryDate));
			sql_insert_parameter($sql, "jobPosting", $this->jobPosting);
			sql_insert_parameter($sql, "contactInformation", $this->contactInformation);
			sql_insert_parameter($sql, "emailOfPoster", $this->emailOfPoster);
			
			if ( mysql_query($sql) ) {
				$retVal = true;
			}
			else {
				//echo "query failed";
				$retVal = false;
			}
			
			mysql_close($db);
			return $retVal;
		}
		else {
			return false;
		}
	}
}
?>
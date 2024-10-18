<?
class JobListingCollection {
	var $items;
	
	function JobListingCollection($criteria = null, $subset = null) {
		$this->items = array();
		
		$db = mysql_connect(DBHOST, DBUSER, DBPASS);
		mysql_select_db(DBNAME);
		
		if ( $criteria == "type" ) {
			if ( $subset == null ) {
				$sql = "SELECT s.*, 1 AS isPublished FROM published_job_postings AS p INNER JOIN submitted_job_postings AS s ON (s.id = p.id) WHERE s.expiryDate > now() ORDER BY s.type, s.expiryDate DESC";
			}
			else {
				$sql = "SELECT s.*, NOT ISNULL(p.id) AS isPublished FROM published_job_postings AS p RIGHT JOIN submitted_job_postings AS s ON (s.id = p.id) ORDER BY s.type, s.expiryDate DESC";
			}
		}
		else {
			if ( $subset == null ) {
				$sql = "SELECT s.*, 1 AS isPublished FROM published_job_postings AS p INNER JOIN submitted_job_postings AS s ON (s.id = p.id) WHERE s.expiryDate > now() ORDER BY s.expiryDate DESC";
			}
			else {
				$sql = "SELECT s.*, NOT ISNULL(p.id) AS isPublished FROM published_job_postings AS p RIGHT JOIN submitted_job_postings AS s ON (s.id = p.id) ORDER BY s.expiryDate DESC";
			}
		}

		$result = mysql_query($sql);

		while ( $row = mysql_fetch_assoc($result) ) {
			
			$job = new JobPosting	($row['type'],
									$row['nameOfPoster'],
									$row['emailOfPoster'],
									$row['jobTitle'],
									strtotime($row['expiryDate']),
									JobListingCollection::convertUrlsToLinks($row['jobPosting']),
									JobListingCollection::convertUrlsToLinks($row['contactInformation']) );

			$job->id				= $row['id'];
			$job->publishDate		= strtotime($row['publishDate']);
			$job->isPublished		= $row['isPublished'];
			
			array_push($this->items, $job);
		}
		
		mysql_free_result($result);
		mysql_close($db);
	}
	
	function getJobPostingById($unique_identifier, $showUnpublishedJobs = false) {
		$db = mysql_connect(DBHOST, DBUSER, DBPASS);
		mysql_select_db(DBNAME);
		
		if ( $showUnpublishedJobs ) {
			$sql = "SELECT s.* FROM submitted_job_postings AS s WHERE s.id = [id]";
		}
		else {
			$sql = "SELECT s.* FROM published_job_postings AS p INNER JOIN submitted_job_postings AS s ON (s.id = p.id) WHERE p.id = [id] AND s.expiryDate > now()";
		}
		
		sql_insert_parameter($sql, "id", $unique_identifier);

		$result = mysql_query($sql);
		
		if ( mysql_num_rows($result) == 0 ) {
			return false;
		}
		
		$row = mysql_fetch_assoc($result);
		$job = new JobPosting	($row['type'],
								$row['nameOfPoster'],
								$row['emailOfPoster'],
								$row['jobTitle'],
								strtotime($row['expiryDate']),
								JobListingCollection::convertUrlsToLinks($row['jobPosting']),
								JobListingCollection::convertUrlsToLinks($row['contactInformation']) );
		
		$job->id = $unique_identifier;
		
		mysql_free_result($result);
		mysql_close($db);
		
		return $job;
	}
	
	function getPositionTypes() {
		global $POSITION_TYPES;
		return $POSITION_TYPES;
	}
	
	function convertUrlsToLinks($text) {
		$jobPostingBody			= $text;
		$jobPostingBody			= eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
		    									'<a href="\\1">\\1</a>', $jobPostingBody);
		$jobPostingBody			= eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
												'\\1<a href="https://\\2">\\2</a>', $jobPostingBody);
		$jobPostingBody			= eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})',
												'<a href="mailto:\\1">\\1</a>', $jobPostingBody);
		return $jobPostingBody;
	}
	
	function publishJobPosting($unique_identifier) {
		$db = mysql_connect(DBHOST, DBADMINUSER, DBADMINPASS);
		mysql_select_db(DBNAME);
		
		$sql = "INSERT INTO published_job_postings (id) VALUES ([id])";
		
		sql_insert_parameter($sql, "id", $unique_identifier);
		
		if ( mysql_query($sql) ) {
			$retVal = true;
		}
		else {
			$retVal = false;
		}
        
		$sql = "UPDATE submitted_job_postings SET publishDate = NOW() WHERE id = [id]";
		
		sql_insert_parameter($sql, "id", $unique_identifier);
		
		if ( mysql_query($sql) ) {
			$retVal = true;
		}
		else {
			$retVal = false;
		}
		
		mysql_close($db);
		
		return $retVal;
	}
	
	function unpublishJobPosting($unique_identifier) {
		$db = mysql_connect(DBHOST, DBADMINUSER, DBADMINPASS);
		mysql_select_db(DBNAME);
		
		$sql = "DELETE FROM published_job_postings WHERE id = [id]";
		
		sql_insert_parameter($sql, "id", $unique_identifier);
		
		if ( mysql_query($sql) ) {
			$retVal = true;
		}
		else {
			$retVal = false;
		}
		
		mysql_close($db);
		return $retVal;
	}
}
?>
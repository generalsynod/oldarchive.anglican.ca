<?
require_once('settings.php');

function string_isset_within_length($string, $maxLength) {
	return (strlen($string) > 0 && strlen($string) <= $maxLength);
}

function sql_insert_parameter(&$sql, $parameterName, $parameterValue) {
	$sql = str_replace('[' . $parameterName . ']', '\'' . addslashes($parameterValue) . '\'', $sql);
}

function stripslashes_array($data) {
    if (is_array($data)){
        foreach ($data as $key => $value){
            $data[$key] = stripslashes_array($value);
        }
        return $data;
    }else{
        return stripslashes($data);
    }
}

function convert_special_chars($string) 
{ 
	$search = array(	chr(0xe2) . chr(0x80) . chr(0x98),
						chr(0xe2) . chr(0x80) . chr(0x99),
						chr(0xe2) . chr(0x80) . chr(0x9c),
						chr(0xe2) . chr(0x80) . chr(0x9d),
						chr(0xe2) . chr(0x80) . chr(0x93),
						chr(0xe2) . chr(0x80) . chr(0x94),
						chr(0xe2) . chr(0x80) . chr(0xa6));
						
	$replace = array(	'&#8216;',
						'&#8217;',
						'&#8220;',
						'&#8221;',
						'&#8211;',
						'&#8212;',
						'...');
 
    return str_replace($search, $replace, $string); 
}
?>

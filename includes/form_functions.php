<?php
function check_required_fields($required_array) {
	$field_errors = array();
	foreach($required_array as $fieldname) {
		if (empty($_POST[$fieldname])) {
			$field_errors[] = $fieldname; 
		}
	}
	return $field_errors;
}

function check_max_field_lengths($field_length_array) {
	$field_errors = array();
	foreach($field_length_array as $fieldname => $maxlength ) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $field_errors[] = $fieldname; }
	}
	return $field_errors;
}

function display_errors($error_array) {
	echo "<p>";
	echo "Corrigez les champs suivants:<br />";
	foreach($error_array as $error) {
		echo " - " . $error . "<br />";
	}
	echo "</p>";
}

function dateformat($date)
{
    //separation de la date par / ou -
    $date_format = preg_split('[-]',$date);
    //inverse la date
   return($date_format[2]."-".$date_format[1]."-".$date_format[0]);
} 

function datefr($date){
  $format = "%A %d %B %Y";
  setlocale (LC_TIME, 'fr_FR.utf8'); 
  $date_strtotime = strtotime($date);
  $date_formatee = strftime ($format, $date_strtotime);
  return $date_formatee;
}

function calculAge($date){
  if($date !='')
   return floor((strtotime('now') - strtotime($date)) / 31557600);
}
function estbeneficiaire($age){
    if(($age >= 18)&&($age < 21))
      return 1;
    else if($age >= 21)
      return 2;
}

?>


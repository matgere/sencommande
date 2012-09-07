<?php require_once("../includes/Database.php"); ?>
<?php 
//get the parameters from URL
$keyword = $_GET['keyword'];
$city = $_GET['city'];
$state = $_GET['state'];
$query = mysql_query("SELECT * FROM users WHERE ClinicName LIKE '%$keyword%' AND LocationCity LIKE '%$city%' AND LocationRegion LIKE '%$state%'") or die(mysql_error());

if($query){//If query successfull
    if(mysql_affected_rows()!=0){//and if atleast one record is found
        while($rows = mysql_fetch_array($query)){ //Display the record
            $replace = str_replace(" ", "-", $rows['ClinicName']);
            echo '<p>'.$rows['UserID'] .' - <a href="clinic.php?clinicname='.$replace.'">'.$rows['ClinicName'].'</a> - '.$rows['Phone1'].'-'.$rows['Phone2'].'-'.$rows['Phone3'].' - '.$rows['LocationCity'].', '.$rows['LocationRegion'].' '.$rows['LocationZip'].', '.$rows['LocationCountry'].'</p>';
        }
    }
    else {
        echo 'No Results for:<br />Clinic Name: '.$keyword.'<br />City: '.$city.'<br />State: '.$state.'';//No Match found in the Database
    }
}
else {
    echo 'Parameter Missing in the URL';//If URL is invalid
}
?>
<form action="" id="livesearch" id="livesearch"> 
Clinic Name: <input type="text" id="clinicsearch" name="clinicsearch" autocomplete="off" onkeyup="keyword=this.value; showHint(keyword, city, state);" />
City: <input type="text" id="citysearch" name="citysearch" autocomplete="off" onkeyup="city=this.value; showHint(keyword, city, state);" />
State: <input type="text" id="statesearch" name="statesearch" autocomplete="off" onkeyup="state=this.value; showHint(keyword, city, state);" />
</form>

<script type="text/javascript">
function showHint(keyword, city, state) {
    var xmlhttp;
    if(keyword.length == 0 & city.length == 0 & state.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
    }
    if(window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "gethint.php?keyword=" + keyword + "&city=" + city + "&state=" + state, true);
    xmlhttp.send();
}
</script>


<?php
/**
* replacement for all mysql functions
*
* Be aware, that this is just a workaround to fix-up some old code and the resulting project 
* will be more vulnerable than if you use the recommended newer mysqli-functions instead.
* So only If you are sure that this is not setting your server at risk, you can fix your old
* code by adding this line at the beginning of your old code:

<?php
include_once('fix_mysql.inc.php');
*
* see: https://stackoverflow.com/a/37877644/1069083
*/

if (!function_exists("mysql_connect")){
  /* warning: fatal error "cannot redeclare" if a function was disabled in php.ini with disable_functions:
  disable_functions =mysql_connect,mysql_pconnect,mysql_select_db,mysql_ping,mysql_query,mysql_fetch_assoc,mysql_num_rows,mysql_fetch_array,mysql_error,mysql_insert_id,mysql_close,mysql_real_escape_string,mysql_data_seek,mysql_result
  */
  
  function mysql_connect($host, $username, $password){
    global $dbconnect;
    $dbconnect = mysqli_connect($host, $username, $password);
    return $dbconnect;
  }

  function mysql_pconnect($host, $username, $password){
    global $dbconnect;
    $dbconnect = mysqli_connect("p:".$host, $username, $password);
    return $dbconnect;
  }

  function mysql_select_db($db,$dbconnect){
    return mysqli_select_db ( $dbconnect,$db );
  }

  function mysql_ping($dbconnect){
    return mysqli_ping ( $dbconnect );
  }

  function mysql_query($stmt){
    global $dbconnect;
    return mysqli_query ($dbconnect, $stmt );
  }

  function mysql_fetch_assoc($erg){
    return mysqli_fetch_assoc ($erg );
  }

  function mysql_num_rows($e){
    return mysqli_num_rows ($e );
  }

  function mysql_affected_rows($e=NULL){
    // TODO: still not working when called without argument: mysql_affected_rows()
    return mysqli_affected_rows ($e );
  }

  function mysql_fetch_array($e){
    return mysqli_fetch_array ($e );
  }

  function mysql_error(){
    global $dbconnect;
    return mysqli_error ($dbconnect);
  }

  function mysql_insert_id($cnx){
    return mysqli_insert_id ( $cnx );
  }

  function mysql_close(){
    return true;
  }

  function mysql_real_escape_string($s){
    global $dbconnect;
    return mysqli_real_escape_string($dbconnect,$s);
  }

  function mysql_data_seek($re,$row){
    return mysqli_data_seek($re,$row);
  }
  
  function mysql_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
      mysqli_data_seek($res,$row);
      $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
      if (isset($resrow[$col])){
        return $resrow[$col];
      }
    }
    return false;
  }

  function mysql_escape_string($s) {
    global $dbconnect;
    return mysqli_real_escape_string($dbconnect,$s);
  }
  
  function mysql_fetch_row($e) {
    return mysqli_fetch_row ($e);
  }
  
  function mysql_errno($db) {
    return mysqli_errno ($db);
  }
  
  function mysql_fetch_object($erg) {
    return mysqli_fetch_object ($erg);
  }
  
  function mysql_field_name($result,$i) {
    return mysqli_fetch_field_direct($result,$i);
  }
  
  function mysql_free_result($result) {
    return mysqli_free_result($result);
  }
  
  
  function mysql_get_server_info() {
    global $dbconnect;
    return mysqli_get_server_info($dbconnect);
  }

  function mysql_set_charset($csname) {
    global $dbconnect;
    return mysqli_set_charset($dbconnect,$csname);
  }
}

<?php
/**
* replacement for all mysql functions
*
* @version 3
* @git https://github.com/rubo77/php-mysql-fix
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

  define("MYSQL_ASSOC", MYSQLI_ASSOC);
  define("MYSQL_NUM", MYSQLI_NUM);
  define("MYSQL_BOTH", MYSQLI_BOTH);

  function mysql_fetch_array($result, $result_type = MYSQL_BOTH){
    $row = mysqli_fetch_array($result, $result_type);
    return is_null($row) ? false : $row;
  }

  function mysql_fetch_assoc($result){
    $row = mysqli_fetch_assoc($result);
    return is_null($row) ? false : $row;
  }

  function mysql_fetch_row($result) {
    $row = mysqli_fetch_row($result);
    return is_null($row) ? false : $row;
  }

  function mysql_fetch_object($result) {
    $row = mysqli_fetch_object($result);
    return is_null($row) ? false : $row;
  }

  function mysql_connect($host, $username, $password, $new_link = FALSE, $client_flags = 0){
    global $global_link_identifier;
    $global_link_identifier = mysqli_connect($host, $username, $password);
    return $global_link_identifier;
  }

  function mysql_pconnect($host, $username, $password, $client_flags = 0){
    global $global_link_identifier;
    $global_link_identifier = mysqli_connect("p:".$host, $username, $password);
    return $global_link_identifier;
  }

  function mysql_select_db($dbname, $link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_select_db($link_identifier, $dbname);
  }

  function mysql_ping($link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_ping($link_identifier);
  }

  function mysql_query($stmt, $link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_query($link_identifier, $stmt);
  }

  function mysql_num_rows($result){
    return mysqli_num_rows($result);
  }

  function mysql_affected_rows($link_identifier = NULL){
    // TODO: check, if working when called without argument: mysql_affected_rows()
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_affected_rows($link_identifier);
  }

  function mysql_list_tables($dbname, $link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    $sql = "SHOW TABLES FROM $dbname";
    $result = mysql_query($sql, $link_identifier);
    return $result;
  }

  function mysql_error($link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_error($link_identifier);
  }

  function mysql_errno($link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_errno($link_identifier);
  }

  function mysql_insert_id($link_identifier = NULL){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_insert_id($link_identifier);
  }

  function mysql_close($link_identifier = NULL){
    return true;
  }

  function mysql_real_escape_string($unescaped_string, $link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_real_escape_string($link_identifier, $unescaped_string);
  }

  function mysql_data_seek($result, $row_number){
    return mysqli_data_seek($result, $row_number);
  }

  function mysql_result($result, $row=0, $col=0){
    $numrows = mysqli_num_rows($result);
    if($numrows && $row <= ($numrows-1) && $row >= 0){
      mysqli_data_seek($result, $row);
      $resultrow = (is_numeric($col)) ? mysqli_fetch_row($result) : mysqli_fetch_assoc($result);
      if (isset($resultrow[$col])){
        return $resultrow[$col];
      }
    }
    return false;
  }

  function mysql_escape_string($s, $link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_real_escape_string($link_identifier, $s);
  }

  function mysql_field_name($result, $i) {
    return mysqli_fetch_field_direct($result, $i);
  }

  function mysql_free_result($result) {
    return mysqli_free_result($result);
  }

  function mysql_get_server_info($link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_get_server_info($link_identifier);
  }

  function mysql_set_charset($csname, $link_identifier = null){
    global $global_link_identifier;
    if($link_identifier == null) {
      $link_identifier = $global_link_identifier;
    }
    return mysqli_set_charset($link_identifier, $csname);
  }
}

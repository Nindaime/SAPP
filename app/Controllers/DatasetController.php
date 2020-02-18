<?php
require_once('app/Db/init.php');
class DatasetController {
  //Insert dataset to database
  public function post_dataset($array)
  {
    array_pop($array);
    if(!isset($_SESSION)) {
      session_start();
    }
    $array['StudentMatric'] = $_SESSION['matric'];
    $array['DataType'] = 'Student';
    $query = DB::insert('Dataset', $array);
    if(DB::affectedRows($query) > 0){
        return true;
    }
    return $query;
  }

  //get all dataset from database
  public function get_dataset()
  {
      $array = array();
      $query = DB::queryRaw("SELECT * FROM Dataset");
      while ($data = $query->fetch_object()){
          $array[] = $data;
      }
      return $array;
  }
}
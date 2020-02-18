<?php
require_once('app/Db/init.php');

class OperationController {
  // post train data
  public function TrainData($file)
  {  
      $query = DB::queryRaw('SHOW VARIABLES WHERE Variable_Name = "datadir"');
      while ($data = $query->fetch_object()){
        $array = $data;
      }
      $path = "$array->Value"."student_prediction/";
      $ext = strtolower(pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION));
      $newName = time().".".$ext;
      move_uploaded_file($_FILES["my_file"]["tmp_name"], "$path" . $newName);
      // $folderPath = getcwd().'/'.$path.$newName;
    $query = <<<eof
    LOAD DATA INFILE '$newName'
    INTO TABLE Dataset
    FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    (DatasetID,Gender,AssessmentPercentage,Arrears,MaritalStatus,FamilyMonthlyIncome,FatherQualification,MotherQualification,FatherOccupation,MotherOccupation,NumberOfFriends,StudyHours,Prediction,TravelTime,ClassAttendance,DataType)
eof;
    $db = DB::queryRaw($query);
    if($db){
      unlink($path.$newName);
      return true;
    }else{
      return false;
    }
  }


  // post test data
  public function TestData($file)
  {
    $path = '/var/lib/mysql/student_prediction/';
      $ext = strtolower(pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION));
      $newName = time().".".$ext;
      move_uploaded_file($_FILES["my_file"]["tmp_name"], "$path" . $newName);
      // $folderPath = getcwd().'/'.$path.$newName;
    $query = <<<eof
    LOAD DATA INFILE '$newName'
    INTO TABLE Dataset
    FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    (DatasetID,Gender,AssessmentPercentage,Arrears,MaritalStatus,FamilyMonthlyIncome,FatherQualification,MotherQualification,FatherOccupation,MotherOccupation,NumberOfFriends,StudyHours,Prediction,TravelTime,ClassAttendance,DataType)
eof;
    $db = DB::queryRaw($query);
    if($db){
      unlink($path.$newName);
      return true;
    }else{
      return false;
    }
  }
}
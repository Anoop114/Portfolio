<?php
include("../db.php");


if(isset($_POST['checkView_btn'])){
    $id = $_POST['f_id'];
    $dbRetutn = GetFileDataByID($id);
    
    $arrData = [];
    
    if(mysqli_num_rows($dbRetutn)>0){
        foreach($dbRetutn as $row){
            array_push($arrData,$row);
            header('Content-type: application/json');
            echo json_encode($arrData);
        }
    }else{
        echo $return = "<h5> NO RECORD FOUND. </h5>";
    }
}

?>
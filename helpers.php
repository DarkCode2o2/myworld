<?php 


function getTitle() {
    global $pageTitle;

    if(isset($pageTitle)) {
        echo $pageTitle;
    }else {
        $pageTitle = 'Dark Code';
        echo $pageTitle; 
    }
}

function getData($value = null, $condition = null, $get = null,  $table, $conn) {

    if($value != null && $condition != null) {
        $sql = $conn->prepare("SELECT $get FROM $table WHERE $condition = ?"); 
        $sql->execute([$value]);
        $data = $sql->fetchAll();
    }else {
        $sql = $conn->prepare("SELECT $get FROM $table"); 
        $sql->execute();
        $data = $sql->fetchAll();
    }
    
    if($sql->rowCount() > 0) {
        return  $data;
    }else {
        $data = [];
        return $data;
    }
}
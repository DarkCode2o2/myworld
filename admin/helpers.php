<?php 

function getData($id = null, $ele = null,  $table, $conn) {

    if($id != null) {
        $sql = $conn->prepare("SELECT $ele FROM $table WHERE project_id = ?"); 
        $sql->execute([$id]);
        $data = $sql->fetch();
    }else {
        $sql = $conn->prepare("SELECT $ele FROM $table"); 
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


function getCount($table, $con) {
    $sql = $con->prepare("SELECT COUNT(*) FROM $table");
    $sql->execute();
    $count = $sql->fetchColumn();

    echo $count;
}
<?php

function idToUser($id,$db)
{
    $data = $db->query("select * from users where id = ?;","i",$id);

    if($data===false){
        print("SQL ERROR");
        return false;
    } else {
        return $data[0];
    }
    
}

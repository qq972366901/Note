<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 15:00
 */

    class ModifyUser extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new ModifyUser();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $id=$_GET["id"];
    $pswd=$_GET["pswd"];

    $sql =<<<EOF
                      SELECT * from USER where id = "$id";
EOF;

    $existSql = 0;

    $ret = $db->query($existSql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        if($row['id'] == $id) {
            $existSql = 1;
            break;
        } else {
            $existSql = 0;
            break;
        }
    }

    $updateSql = 0;

    if($existSql==0) {
        $updateSql = 0;
    } else {
        $sql =<<<EOF
              UPDATE USER set password = "$pswd" where id="$id";
EOF;

        $ret = $db->exec($sql);
        if(!$ret){
            $updateSql = 0;
        } else {
            $updateSql = 1;
        }

        echo $updateSql;

        $db->close();
    }
?>
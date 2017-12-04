<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 17:33
 */

    class DeleteNote extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }
    $db = new DeleteNote();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $noteid=$_GET["noteid"];

    $sql =<<<EOF
          DELETE from NOTE where noteid="$noteid";
EOF;
    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "Note deleted successfully\n";
    }


    $db->close();

?>
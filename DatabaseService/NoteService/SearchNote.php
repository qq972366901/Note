<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 22:06
 */

    class SearchNote extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new SearchNote();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];
    $part=$_GET["part"];



    $sql =<<<EOF
              SELECT * from NOTE where userid="$userid" and title like '%$part%';
EOF;

    $arr = array();

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $noteid = $row['noteid'];
        $title = $row['title'];
        $arr[$noteid]=$title;
    }

    $searchNoteJson = json_encode($arr);

    echo $searchNoteJson;

    $db->close();



?>
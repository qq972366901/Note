<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 19:42
 */

    class NoteList extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new NoteList();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];



    $sql =<<<EOF
          SELECT * from NOTE where userid="$userid";
EOF;

    $arr = array();

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $noteid = $row['noteid'];
        $title = $row['title'];
        $arr[$noteid]=$title;
    }

    $noteListJson = json_encode($arr);

    echo $noteListJson;

    $db->close();



?>
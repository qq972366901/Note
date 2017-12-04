<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/5
 * Time: 1:59
 */

    class GetNoteByLabel extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new GetNoteByLabel();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];
    $name=$_GET["name"];



    $sql =<<<EOF
              SELECT distinct noteid,title. from NOTE  where noteid in (select noteid from LABEL a where a.userid = "$userid" and a.name = "$name" ) ;
EOF;

    $arr = array();

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $noteid = $row['noteid'];
        $title = $row['title'];
        $arr[$noteid]=$title;
    }

    $labelNotesJson = json_encode($arr);

    echo $labelNotesJson;

    $db->close();



?>
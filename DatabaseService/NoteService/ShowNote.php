<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 21:08
 */

    class ShowNote extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new ShowNote();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $noteid=$_GET["noteid"];



    $sql =<<<EOF
              SELECT * from NOTE where noteid="$noteid";
EOF;

    $arr = array();

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $title = $row['title'];
        $content = $row['content'];
        $arr[$title]=$content;
    }

    $showNoteJson = json_encode($arr);

    echo $showNoteJson;

    $db->close();

?>
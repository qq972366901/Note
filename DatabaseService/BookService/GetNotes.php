<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 22:37
 */

class GetNotes extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}

$db = new GetNotes();

if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$userid=$_GET["userid"];
$bookid=$_GET["bookid"];



$sql =<<<EOF
          SELECT * from NOTE  where userid="$userid" and bookid="$bookid";
EOF;

$arr = array();

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $noteid = $row['noteid'];
    $title = $row['title'];
    $arr[$noteid]=$title;
}

$getNotesJson = json_encode($arr);

echo $getNotesJson;

$db->close();



?>
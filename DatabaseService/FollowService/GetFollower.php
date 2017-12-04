<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/5
 * Time: 0:51
 */

class GetFollower extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}

$db = new GetFollower();

if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$fromid=$_GET["fromid"];



$sql =<<<EOF
              SELECT * from FOLLOW where fromid="$fromid";
EOF;

$arr = array();

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $toid = $row['toid'];
    array_push($arr,$toid);
}

$followerJson = json_encode($arr);

echo $followerJson;

$db->close();

?>
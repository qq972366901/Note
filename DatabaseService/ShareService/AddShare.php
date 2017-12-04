<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 23:25
 */

class AddShare extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}

$db = new AddShare ();

if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$fromid=$_GET["fromid"];
$toid=$_GET["toid"];
$noteid=$_GET["noteid"];
$droit=$_GET["droit"];

$sql =<<<EOF
              INSERT INTO SHARE (fromid,toid,noteid,droit)
              VALUES ("$fromid","$toid","$noteid","$droit");
EOF;

$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo "Share successfully\n";
}

$db->close();

?>
<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/5
 * Time: 0:18
 */

class AddFollow extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}

$db = new AddFollow ();

if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$fromid=$_GET["fromid"];
$toid=$_GET["toid"];


$sql =<<<EOF
                  SELECT * from FOLLOW where fromid = "$fromid" and toid = "$toid";
EOF;

$existSql = 0;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $existSql = 1;
    break;
}
if($existSql==1) {
    echo "Already followed\n";
} else {
    $sql =<<<EOF
          INSERT INTO FOLLOW (fromid,toid)
          VALUES ("$fromid", "$toid");
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "Follow successfully\n";
    }

    $db->close();
}

?>
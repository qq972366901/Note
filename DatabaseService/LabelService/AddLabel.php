<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/5
 * Time: 1:45
 */

class AddLabel extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}

$db = new AddLabel ();

if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$userid=$_GET["userid"];
$noteid=$_GET["noteid"];
$name=$_GET["name"];

$sql =<<<EOF
                  SELECT * from LABEL where userid = "$userid" and name = "$name";
EOF;

$existSql = 0;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $existSql = 1;
    break;
}
if($existSql==1) {
    echo "Label already existed\n";
} else {
    $sql =<<<EOF
              INSERT INTO LABEL (userid,noteid,name)
              VALUES ("$userid","$noteid","$name");
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "Add label successfully\n";
    }

    $db->close();
}

?>
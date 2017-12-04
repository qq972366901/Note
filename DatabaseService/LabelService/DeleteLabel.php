<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/5
 * Time: 2:12
 */

class DeleteLabel extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}
$db = new DeleteLabel();
if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$noteid=$_GET["noteid"];
$name=$_GET["name"];

$sql =<<<EOF
          DELETE from LABEL where noteid="$noteid" and name = "$name";
EOF;
$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo "Label deleted successfully\n";
}


$db->close();

?>
<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 21:42
 */

class DeleteBook extends SQLite3
{
    function __construct()
    {
        $this->open('Note.db3');
    }
}
$db = new DeleteBook();
if(!$db){
    echo $db->lastErrorMsg();
} else {
    //echo "Opened database successfully\n";
}

$bookid=$_GET["bookid"];

$sql =<<<EOF
          DELETE from BOOK where bookid="$bookid";
EOF;
$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo "Book deleted successfully\n";
}


$db->close();

?>
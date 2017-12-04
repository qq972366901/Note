<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 21:20
 */

    class ChangeBook extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new ChangeBook();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $noteid=$_GET["noteid"];
    $bookid=$_GET["bookid"];



    $sql =<<<EOF
                      UPDATE NOTE set bookid = "$bookid"  where noteid="$noteid";
EOF;
    $updateSql = 0; //success 1, fail 0
    $ret = $db->exec($sql);
    if(!$ret){
        $updateSql = 0;
    } else {
        $updateSql = 1;
    }

    echo $updateSql;

    $db->close();

?>
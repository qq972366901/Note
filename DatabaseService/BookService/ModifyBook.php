<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 21:34
 */

    class ModifyBook extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }
    
    $db = new ModifyBook();
    
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $bookid=$_GET["bookid"];
    $name=$_GET["name"];
    
    
    $sql =<<<EOF
                      UPDATE BOOK set name = "$name"  where bookid="$bookid" and noteid="$bookid";
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
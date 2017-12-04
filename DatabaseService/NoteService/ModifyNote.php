<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 16:53
 */

    class ModifyNote extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new ModifyNote();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $noteid=$_GET["noteid"];
    $title=$_GET["title"];
    $content=$_GET["content"];


        $sql =<<<EOF
                  UPDATE NOTE set title = "$title", content = "$content" where  noteid="$noteid";
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
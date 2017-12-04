<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/5
 * Time: 0:07
 */

    class GetDroit extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new GetDroit();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $toid=$_GET["toid"];
    $noteid=$_GET["noteid"];
    $droit=$_GET["droit"];

    $sql =<<<EOF
                  SELECT * from SHARE where toid = "$toid"  and  noteid = "$noteid";
EOF;

    $myDroit = 0; //0 no right , 1 read  ,  2 write

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){

        $myDroit = $row['password'];

    }
    echo $myDroit;
    $db->close();


?>
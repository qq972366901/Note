<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 22:24
 */

    class SearchBook extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new SearchBook();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];
    $part=$_GET["part"];



    $sql =<<<EOF
              SELECT * from BOOK where userid="$userid" and name like '%$part%';
EOF;

    $arr = array();

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $bookid = $row['bookid'];
        $name = $row['name'];
        $arr[$bookid]=$name;
    }

    $searchBookJson = json_encode($arr);

    echo $searchBookJson;

    $db->close();



?>
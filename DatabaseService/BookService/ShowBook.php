<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 21:53
 */

    class ShowBook extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new ShowBook();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];



    $sql =<<<EOF
                  SELECT * from BOOK where userid="$userid";
EOF;

    $arr = array();

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $bookid = $row['bookid'];
        $name = $row['name'];
        $arr[$bookid]=$name;
    }

    $showBookJson = json_encode($arr);

    echo $showBookJson;

    $db->close();

?>
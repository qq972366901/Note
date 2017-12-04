<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 21:27
 */

    class AddBook extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new AddBook();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];
    $name=$_GET["name"];

    $sql =<<<EOF
          SELECT * from BOOK where userid = "$userid" order by bookid desc;
EOF;

    $bookNum = 1;

    $lastBookid = null;

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $lastBookid = $row['bookid'];
        break;
    }

    if($lastNoteid != null) {
        $tempstr = strstr($lastBookid, '_n_');
        $bookstr = substr($tempstr,3);
        $bookNum = intval($bookstr);
        $bookNum = $bookNum + 1;
    }

    $bookid=$userid."_n_".$bookNum;

    $sql =<<<EOF
                  INSERT INTO BOOK (userid,bookid,name)
                  VALUES ("$userid","$bookid","$name");
EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "Add book successfully\n";
    }

    $db->close();


?>
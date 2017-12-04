<?php
/**
 * Created by PhpStorm.
 * User: zongkan
 * Date: 2017/12/4
 * Time: 15:17
 */
    class AddNote extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new AddNote();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $userid=$_GET["userid"];
    $title=$_GET["title"];
    $content=$_GET["content"];

    $sql =<<<EOF
                      SELECT * from NOTE where userid = "$userid" order by noteid desc;
EOF;

    $noteNum = 1;

    $lastNoteid = null;

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $lastNoteid = $row['noteid'];
        break;
    }

    if($lastNoteid != null) {
        $tempstr = strstr($lastNoteid, '_n_');
        $notestr = substr($tempstr,3);
        $noteNum = intval($notestr);
        $noteNum = $noteNum + 1;
    }

    $noteid=$userid."_n_".$noteNum;

    $sql =<<<EOF
              INSERT INTO NOTE (noteid,userid,title,content)
              VALUES ("$noteid","$userid","$title","$content");
EOF;

        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
            echo "Add note successfully\n";
        }

        $db->close();


?>
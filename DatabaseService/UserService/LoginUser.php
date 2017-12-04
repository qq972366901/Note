<?php
    class LoginUser extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new LoginUser();

    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        //echo "Opened database successfully\n";
    }

    $id=$_GET["id"];
    $pswd=$_GET["pswd"];

    $sql =<<<EOF
              SELECT * from USER where id = "$id";
EOF;

    $pswdRight = 0; //1 : right  ,  0 : wrong

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        if($row['password'] == $pswd) {
            $pswdRight = 1;
            break;
        } else {
            $pswdRight = 0;
            break;
        }
    }
    echo $pswdRight;
    $db->close();
?>
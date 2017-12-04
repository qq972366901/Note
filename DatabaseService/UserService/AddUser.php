<?php
    class AddUser extends SQLite3
    {
        function __construct()
        {
            $this->open('Note.db3');
        }
    }

    $db = new AddUser();

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

    $existSql = 0;

    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        if($row['id'] == $id) {
            $existSql = 1;
            break;
        } else {
            $existSql = 0;
            break;
        }
    }
    if($existSql==1) {
        echo "Id already existed\n";
    } else {
        $sql =<<<EOF
          INSERT INTO USER (id,password)
          VALUES ("$id", "$pswd");
EOF;

        $ret = $db->exec($sql);
        if(!$ret){
            echo $db->lastErrorMsg();
        } else {
            echo "Add user successfully\n";
        }

        $db->close();
    }

?>
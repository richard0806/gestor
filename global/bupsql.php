<?php
/*echo "pass: e98ab18c64ca59fc3747da5cce166709\n";
echo md5('useradmin');*/
$arr_datos = array(
    'db_host'=> 'localhost',  //mysql host
    'db_uname' => "sec_user_gestor",  //usuario
    'db_password' => 'sSG0eo8283a~3', //password
    'db_to_backup' => 'db_gestor', //nombre de la base de datos
    'db_backup_path' => '../db/', //directorio en tu servidor donde se hará el backup
);
backup_mysql_database ( $arr_datos );

function backup_mysql_database($params)
{
    $mtables = array();
    $contents = "– Database: '".$params['db_to_backup']."' —\n";

    $mysqli = new mysqli($params['db_host'], $params['db_uname'], $params['db_password'], $params['db_to_backup'], "3306");
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }

    $results = $mysqli->query("SHOW TABLES");

    while($row = $results->fetch_array()){
            $mtables[] = $row[];
    }

    foreach($mtables as $table){
        $contents .= "– Table `".$table."` —\n";

        $results = $mysqli->query("SHOW CREATE TABLE ".$table);
        while($row = $results->fetch_array()){
            $contents .= $row[1].";\n\n";
        }

        $results = $mysqli->query("SELECT * FROM ".$table);
        $row_count = $results->num_rows;
        $fields = $results->fetch_fields();
        $fields_count = count($fields);

        $insert_head = "INSERT INTO `".$table."` (" ;
        for($i= 0; $i < $fields_count; $i++){
            $insert_head  .= "`".$fields[$i]->name."`";
                if($i < $fields_count–1){
                        $insert_head  .= ', ';
                    }
        }
        $insert_head .=  ")";
        $insert_head .= " VALUES\n";

        if($row_count>){
            $r = ;
            while($row = $results->fetch_array()){
                if(($r % 400)  == ){
                    $contents .= $insert_head;
                }
                $contents .= "(";
                for($i=; $i < $fields_count; $i++){
                    $row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));

                    switch($fields[$i]->type){
                        case 8: case 3:
                            $contents .=  $row_content;
                            break;
                        default:
                            $contents .= "'". $row_content ."'";
                    }
                    if($i < $fields_count–1){
                            $contents  .= ', ';
                        }
                }
                if(($r+1) == $row_count || ($r % 400) == 399){
                    $contents .= ");\n\n";
                }else{
                    $contents .= "),\n";
                }
                $r++;
            }
        }
    }

    if (!is_dir ( $params['db_backup_path'] )) {
            mkdir ( $params['db_backup_path'], 0777, true );
     }

    $backup_file_name = "sql-backup-".date( "d-m-Y–h-i-s").".sql";

    $fp = fopen($backup_file_name ,'w+');
    if (($result = fwrite($fp, $contents))) {
        echo "Respaldo creado. Haz clic aquí para descargar <a href='$backup_file_name'>Descargar </a>";
    }
    fclose($fp);
}
?>

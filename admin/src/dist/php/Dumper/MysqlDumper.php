<?php
class TableDumper {
    public static function dump($filename,$tableName){
        $return = '';
        $conn = FwConnection::conn();
        $result =$conn->query("SELECT * FROM `$tableName`") ;
        $num_fields = $result->rowCount();

        $return .= 'DROP TABLE IF EXISTS '.$tableName.';';
        $row2 = $conn->query('SHOW CREATE TABLE '.$tableName)->fetch(PDO::FETCH_NUM);
        $return .= "\n\n".$row2[1].";\n\n";

        for ($i=1; $i < $num_fields; $i++) {
            while ($row = $result->fetch(PDO::FETCH_NUM)) {
                $return .= 'INSERT INTO '.$tableName.' VALUES(';
                for ($j=0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    if (isset($row[$j])) {
                        $return .= '"'.$row[$j].'"';} else { $return .= '""';}
                    if($j<$num_fields-1){ $return .= ','; }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n\n";
        $file = fopen($filename,'w');
        fwrite($file,$return);
        fclose($file);
        return $filename;
    }
}

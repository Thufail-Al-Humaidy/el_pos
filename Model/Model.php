<?php
require_once __DIR__ . '/../Interface/Interface.php';
require_once __DIR__ . '/../DB/Connections.php';

abstract class Model extends Connection implements ModelInterface{

    public function create_data($datas, $table){
        //var_dump($data);
        $key = array_keys($datas);
        $val = array_values($datas);

        $key = implode(",",$key);
        $val = implode("','", $val);

        $query = "INSERT INTO $table ($key) VALUES ('$val')";
        $result = mysqli_query($this->db, $query);

        if($result){
            return $datas;
        } else {
            return false;
        }
    }

    public function all_data($table){
        $query = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }

    public function convert_data($datas){
        $data = [];
        while($row = mysqli_fetch_assoc($datas)){
            $data[] = $row;
        }
        return $data;
    }

    public function find_data($id,$column, $table){
        $query = "SELECT * FROM $table WHERE $column = $id";
        $result = mysqli_query($this->db, $query);
        $data = $this->convert_data($result);
        if($result->num_rows > 0){
            return $data;
        } else {
            echo "ga ada data dengan id $id ";
        }
    }

    public function update_data($id, $column, $datas, $table){
        $key = array_keys($datas);
        $val = array_values($datas);

        $query = "UPDATE $table SET ";

        for($i = 0; $i < count($key); $i++){
            $query .= $key[$i] . " = '" . $val[$i] . "'";
            if($i != count($key) - 1){
                $query .= " , ";
            }
        }

        $query .= " WHERE {$column} = $id";
        $result = mysqli_query($this->db, $query);
        if($result){
            return $datas;
        } else {
            return false;
        }
    }

    public function delete_data($id,$column, $table){
        $query = "DELETE FROM $table WHERE {$column} = $id";
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    public function search_all($keyword, $table){
        $query = "SELECT * FROM $table $keyword";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }

    public function paginate_data($limit, $start, $table){
        $query = "SELECT * FROM $table LIMIT $limit, $start";
        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }
}
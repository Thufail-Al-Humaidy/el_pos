<?php
require_once __DIR__ . '/Model.php';

class Item extends Model
{
    protected $table = 'items';
    protected $primary_key = 'id_item';

    
    public function create($datas)
    {
        $nama_file = $datas["files"]["attachment"]["name"];
        $file_size = $datas["files"]["attachment"]["size"];
        $tmp_name = $datas["files"]["attachment"]["tmp_name"];
        $file_extension = pathinfo($nama_file, PATHINFO_EXTENSION);
        $allowed_extension = ["jpg", "jpeg", "gif", "svg", "png", "webp"];

        if(!in_array($file_extension, $allowed_extension)){
           return "extensi tidak diizinkan";
        }
        if($file_size > 5120000 ){
           return "file terlalu besar";
        }

        $nama_file = random_int(1000, 9999) . "." . $file_extension;
        move_uploaded_file($tmp_name, "../public/img/items/" . $nama_file);
        //echo realpath("../public/img/items/");
        //var_dump($_FILES);
        $datas = [
            "name_item" => $datas["post"]["name_item"],
            "attachment" => $nama_file,
            "price" => $datas["post"]["price"],
            "category_id" => $datas["post"]["category_id"]
        ];
        return parent::create_data($datas, $this->table);
    }
    public function all()
    {
        return parent::all_data($this->table);
    }
    public function find($id)
    {
        return parent::find_data($id,$this->primary_key, $this->table);
    }
    public function update($id, $datas)
    {
        $attachment = '';
        if ($datas["files"]["attachment"]["name"] !== '') {
            $nama_file = $datas["files"]["attachment"]["name"];
            $file_size = $datas["files"]["attachment"]["size"];
            $tmp_name = $datas["files"]["attachment"]["tmp_name"];
            $file_extension = pathinfo($nama_file, PATHINFO_EXTENSION);
            $allowed_extension = ["jpg", "jpeg", "gif", "svg", "png", "webp"];

            if (!in_array($file_extension, $allowed_extension)) {
                return "extensi tidak diizinkan";
            }
            if ($file_size > 5120000) {
                return "file terlalu besar";
            }
            $nama_file = random_int(1000, 9999) . "." . $file_extension;
            move_uploaded_file($tmp_name, "../public/img/items/" . $nama_file);
            $attachment = $nama_file;
        }
        $datas = [
            "name_item" => $datas["post"]["name_item"],
            "price" => $datas["post"]["price"],
            "category_id" => $datas["post"]["category_id"]
        ];
        if ($attachment !== '') {
            $datas["attachment"] = $attachment;
        }
        return parent::update_data($id, $this->primary_key, $datas, $this->table);
    }
    public function delete($id)
    {
        
        return parent::delete_data($id, $this->primary_key, $this->table);
    }
    public function search($keyword, $start = null, $limit = null)
    {
      $queryLimit = '';
      if(isset($start) && isset($limit)){
         $queryLimit = " LIMIT $start, $limit";
      }
      $keyword = " WHERE name LIKE '%{$keyword}%' $queryLimit";
      return parent::search_all($keyword, $this->table);
    }

    public function paginate($start, $limit){
      return parent::paginate_data($start, $limit, $this->table);
    }

    public function all2($start, $limit){
        $query = "SELECT * FROM  items INNER JOIN categories ON items.category_id = categories.id_category LIMIT $start, $limit;";
        $result = mysqli_query($this->db, $query);
        return $this->convert_data($result);
    }
}

<?php
require_once __DIR__ . '/Model.php';

class User extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id_users';


    public function create($datas)
    {
        return parent::create_data($datas, $this->table);
    }
    public function all()
    {
        parent::all_data($this->table);
    }
    public function find($id)
    {
        parent::find_data($id, $this->primary_key, $this->table);
    }
    public function update($id, $datas)
    {
        parent::update_data($id, $this->primary_key, $datas, $this->table);
    }
    public function delete($id)
    {
        parent::delete_data($id,$this->primary_key, $this->table);
    }

    public function register($datas)
    {
        $name = $datas['post']['full_name'];
        $email = $datas['post']['email'];
        $password = $datas['post']['password'];
        $gender = $datas['post']['gender'];

        $query = "SELECT * FROM {$this->table} WHERE email = '$email'";
        $result = mysqli_query($this->db, $query);
        if (mysqli_num_rows($result) > 0) {
            return "user sudah terdaftar";
        }
        $nama_file = $datas["files"]["avatar"]["name"];
        $file_size = $datas["files"]["avatar"]["size"];
        $tmp_name = $datas["files"]["avatar"]["tmp_name"];
        $file_extension = pathinfo($nama_file, PATHINFO_EXTENSION);
        $allowed_extension = ["jpg", "jpeg", "gif", "svg", "png", "webp"];

        if (!in_array($file_extension, $allowed_extension)) {
            return "ekstensi tidak diizinkan!";
        }
        if ($file_size > 5120000) {
            return "ukuran file terlalu besar!";
        }

        $nama_file = random_int(1000, 9999) . "." . $file_extension;
        move_uploaded_file($tmp_name, "../public/img/users/" . $nama_file);

        $password = base64_encode($password);

        $query_register = "INSERT INTO {$this->table} (full_name, email, avatar, gender, password) VALUES ('$name', '$email','$nama_file', '$gender','$password')";

        $result = mysqli_query($this->db, $query_register);
        if (!$result) {
            return "register gagal";
        }
        
        $_SESSION['full_name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['avatar'] = $nama_file;

        $detail_user = [
            'full_name' => $name,
            'email' => $email,
            'avatar' => $nama_file
        ];
        return $detail_user;
    }

    public function login($email, $password)
    {

        $query = "SELECT * FROM $this->table WHERE email = '$email'";
        $result = mysqli_query($this->db, $query);
        if (mysqli_num_rows($result) == 0) {
            return "user tidak ditemukan";
        }

        $user = mysqli_fetch_assoc($result);
        if (base64_decode($user['password'], false) == $password) {
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email']  = $user['email'];
            $_SESSION['avatar'] = $user['avatar'];
            $detail_user = [
                'full_name' => $user['full_name'],
                'email' => $user['email'],
                'avatar' => $user['avatar']
            ];
            return $detail_user;
        } else {
            return "password salah";
        }
    }

    public function logout()
    {
        session_destroy();
        return "logout berhasil";
    }

    public function update_password($id, $old_pass, $new_pass)
    {
        $query = "SELECT * FROM {$this->table} WHERE id_users = '$id'";
        $result = mysqli_query($this->db, $query);
        if (mysqli_num_rows($result) == 0) {
            return "user tidak ditemukan";
        }
        $user = mysqli_fetch_assoc($result);
        if (base64_decode($user['password'], false) == $old_pass) {
            
            return "berhasil update password";
        }
        $new_pass = base64_encode($new_pass);
        $$queryUpdate = "UPDATE {$this->table} SET password = '$new_pass' WHERE id_users = '$id'";
        $resultUpdate = mysqli_query($this->db, $queryUpdate);
        if (!$resultUpdate) {
            return "gagal update password";
        }
       
        return [
            'full_name' => $newUser['full_name'],
            'email' => $newUser['email'],
            'avatar' => $newUser['avatar']  
        ];
    }
}

<?php
require_once 'Model.php';

class Auth extends Model {
    private $table_name = "SinhVien";

    public function login($MaSV) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 
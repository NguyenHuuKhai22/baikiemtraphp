<?php
require_once 'Model.php';

class SinhVien extends Model {
    private $table_name = "SinhVien";

    public function getAll() {
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table_name . " sv 
                 LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . "
                (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
                VALUES
                (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(":MaSV", $data['MaSV']);
        $stmt->bindParam(":HoTen", $data['HoTen']);
        $stmt->bindParam(":GioiTinh", $data['GioiTinh']);
        $stmt->bindParam(":NgaySinh", $data['NgaySinh']);
        $stmt->bindParam(":Hinh", $data['Hinh']);
        $stmt->bindParam(":MaNganh", $data['MaNganh']);
        
        return $stmt->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . "
                SET HoTen = :HoTen,
                    GioiTinh = :GioiTinh,
                    NgaySinh = :NgaySinh,
                    Hinh = :Hinh,
                    MaNganh = :MaNganh
                WHERE MaSV = :MaSV";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(":MaSV", $data['MaSV']);
        $stmt->bindParam(":HoTen", $data['HoTen']);
        $stmt->bindParam(":GioiTinh", $data['GioiTinh']);
        $stmt->bindParam(":NgaySinh", $data['NgaySinh']);
        $stmt->bindParam(":Hinh", $data['Hinh']);
        $stmt->bindParam(":MaNganh", $data['MaNganh']);
        
        return $stmt->execute();
    }

    public function delete($MaSV) {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        return $stmt->execute();
    }

    public function getById($MaSV) {
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table_name . " sv 
                 LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
                 WHERE sv.MaSV = :MaSV";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 
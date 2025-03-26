<?php
require_once 'Model.php';

class HocPhan extends Model {
    private $table_name = "HocPhan";

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($MaHP) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = :MaHP";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaHP", $MaHP);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDangKyByMaSV($MaSV) {
        $query = "SELECT hp.*, dk.NgayDK 
                 FROM HocPhan hp 
                 JOIN ChiTietDangKy ctdk ON hp.MaHP = ctdk.MaHP 
                 JOIN DangKy dk ON ctdk.MaDK = dk.MaDK 
                 WHERE dk.MaSV = :MaSV";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->execute();
        return $stmt;
    }

    public function getTongTinChi($MaSV) {
        $query = "SELECT SUM(hp.SoTinChi) as TongTinChi
                 FROM HocPhan hp 
                 JOIN ChiTietDangKy ctdk ON hp.MaHP = ctdk.MaHP 
                 JOIN DangKy dk ON ctdk.MaDK = dk.MaDK 
                 WHERE dk.MaSV = :MaSV";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['TongTinChi'] ?? 0;
    }

    public function getSoTinChi($MaHP) {
        $query = "SELECT SoTinChi FROM " . $this->table_name . " WHERE MaHP = :MaHP";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":MaHP", $MaHP);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['SoTinChi'] ?? 0;
    }

    public function dangKyHocPhan($MaSV, $MaHP) {
        try {
            $this->db->beginTransaction();

            // Kiểm tra xem học phần đã được đăng ký chưa
            $query = "SELECT COUNT(*) as count 
                     FROM DangKy dk 
                     JOIN ChiTietDangKy ctdk ON dk.MaDK = ctdk.MaDK 
                     WHERE dk.MaSV = :MaSV AND ctdk.MaHP = :MaHP";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":MaSV", $MaSV);
            $stmt->bindParam(":MaHP", $MaHP);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['count'] > 0) {
                $this->db->rollBack();
                return false;
            }

            // Insert into DangKy
            $query1 = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (CURDATE(), :MaSV)";
            $stmt1 = $this->db->prepare($query1);
            $stmt1->bindParam(":MaSV", $MaSV);
            $stmt1->execute();
            $MaDK = $this->db->lastInsertId();

            // Insert into ChiTietDangKy
            $query2 = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (:MaDK, :MaHP)";
            $stmt2 = $this->db->prepare($query2);
            $stmt2->bindParam(":MaDK", $MaDK);
            $stmt2->bindParam(":MaHP", $MaHP);
            $stmt2->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function xoaDangKy($MaSV, $MaHP) {
        try {
            $this->db->beginTransaction();

            $query = "DELETE FROM ChiTietDangKy 
                     WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = :MaSV) 
                     AND MaHP = :MaHP";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":MaSV", $MaSV);
            $stmt->bindParam(":MaHP", $MaHP);
            $stmt->execute();

            // Xóa DangKy nếu không còn ChiTietDangKy nào
            $query2 = "DELETE FROM DangKy 
                      WHERE MaDK NOT IN (SELECT DISTINCT MaDK FROM ChiTietDangKy)";
            $stmt2 = $this->db->prepare($query2);
            $stmt2->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function xoaTatCaDangKy($MaSV) {
        try {
            $this->db->beginTransaction();

            $query = "DELETE FROM ChiTietDangKy 
                     WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = :MaSV)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":MaSV", $MaSV);
            $stmt->execute();

            $query2 = "DELETE FROM DangKy WHERE MaSV = :MaSV";
            $stmt2 = $this->db->prepare($query2);
            $stmt2->bindParam(":MaSV", $MaSV);
            $stmt2->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function luuDangKy($MaSV) {
        try {
            $this->db->beginTransaction();

            // Cập nhật trạng thái đăng ký
            $query = "UPDATE DangKy 
                     SET TrangThai = 1 
                     WHERE MaSV = :MaSV";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":MaSV", $MaSV);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
?> 
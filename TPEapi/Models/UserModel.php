<?php

require_once 'models/Model.php';

class UserModel extends Model {
    
    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$email]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}

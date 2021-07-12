<?php
class DB{
    public function connect(){
            $pdo = new PDO('mysql:dbname=lesson1;host=localhost','root','root');;
            return $pdo;
    }

    public function update(){
        return 'UPDATE login_mypage SET name=?, mail=?, password=?, comments=? WHERE id=?';
    }

    public function select1(){
       return 'SELECT * FROM login_mypage WHERE id=?';
    }

    public function select2(){
        return 'SELECT * FROM login_mypage WHERE mail=? && password=?';
    }

    public function insert(){
        return "INSERT INTO login_mypage(name,mail,password,picture,comments)VALUES(?,?,?,?,?)";
    }

    public function delete(){
        return "DELETE FROM login_mypage where name = ? && mail = ?";
    }

    public function organize(){
        return "set @n:=0; update`login_mypage` set id=@n:=@n+1; ALTER TABLE `login_mypage` auto_increment = 1;
        ";
    }

}
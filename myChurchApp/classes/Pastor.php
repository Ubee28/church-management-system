<?php 
require_once "Db.php";

class Pastor extends Db
{
    private $dbconn;
    public function __construct(){
        $this->dbconn = $this->connect();   
    }

    public function register($fullname, $email, $phone, $address, $pass1){
        // sql
        $sql ="INSERT INTO pastors(pastor_fullname, pastor_email, pastor_phone, pastor_address, pastor_pwd) VALUES(?,?,?,?,?)";
        // prepare
        $stmt = $this->dbconn->prepare($sql);
        // execute
        $hashed = password_hash($pass1, PASSWORD_DEFAULT);
        $stmt->execute([$fullname, $email, $phone, $address, $hashed]);
        $id = $this->dbconn->lastInsertId();
        return $id;
    }

    public function login($email, $password){
        //sql
        try{
        $sql = "SELECT * FROM pastors WHERE pastor_email = ? LIMIT 1 ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $hashed_password = $result['pastor_pwd'];
            $check = password_verify($password, $hashed_password);
            if($check){
                return $result['pastor_id'];
            }else{
                $_SESSION['errormsg'] = "Invalid password";
                return 0;
            }
        }else{
            $_SESSION['errormsg'] = "Invalid email";
            return 0;
        }


    }
    catch(PDOException $e){
        $_SESSION['errormsg'] = $e->getMessage();
        return 0;
    }
    catch(Exception $e){
        $_SESSION['errormsg'] = $e->getMessage();
        return 0;
    }

   }

   public function check_email($email){
    // write your query
    $sql = "SELECT * FROM pastors WHERE pastor_email =?";
    // prepare
    $stmt = $this->dbconn->prepare($sql);
    // execute
    $stmt->execute([$email]);
    $result = $stmt->rowCount();
    return $result;
    
    }

    public function fetch_all_pastors(){
        $sql = "SELECT * FROM pastors ORDER BY pastor_fullname ASC";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_pastor_by_id($pastor_id){
        $sql = "SELECT * FROM pastors WHERE pastor_id = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$pastor_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }



    public function signout(){
        unset($_SESSION['pastor_id']);
        session_unset();
        session_destroy();
   }


}


?>
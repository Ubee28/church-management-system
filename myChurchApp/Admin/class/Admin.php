<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/myChurchApp/classes/Db.php';



    class Admin extends Db
    {
        private $dbconn;
        public function __construct(){
            $this->dbconn = $this->connect();
        }

        
        public function register($fullname,$email,$pwd1){
            // sql
            $sql = "INSERT INTO admin(admin_fullname, admin_email, admin_password) VALUES(?,?,?)";
            // prepare
            $stmt = $this->dbconn->prepare($sql);
            // execute
            $hashed = password_hash($pwd1,PASSWORD_DEFAULT);
            $stmt->execute([$fullname,$email,$hashed]);
            $id = $this->dbconn->lastInsertId();
            return $id;

        }

        public function login($email,$password){
            //sqql
            try{
                $sql = "SELECT * FROM admin WHERE admin_email=? LIMIT 1";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){//the email exits, get the password from the db and verify with the $password with the one(coming from the form)
                    $hashed_password = $result['admin_password'];
                    $check = password_verify($password,$hashed_password);
                    if($check){//the password is correct, return the id of the user that has just logged in
                        return $result['admin_id'];
                    }else{//the password supplied is not same with the one in the db
                        $_SESSION['errormsg'] = "Invalid password";
                        return 0;
                    }
                }else{//the email does not exits
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
            $sql = "SELECT * FROM admin WHERE admin_email =?";
            // prepare
            $stmt = $this->dbconn->prepare($sql);
            // execute
            $stmt->execute([$email]);
            $result = $stmt->rowCount();
            return $result;
            
        }

        public function get_admin_by_id($admin_id){
            $sql = "SELECT * FROM admin WHERE admin_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$admin_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function signout(){
            unset($_SESSION['admin_id']);
            session_unset();
            session_destroy();
       }


    }

    // $a = new Admin;
    // $check = $a->check_email("Ike@gmail.com");

    // print_r($check);




?>
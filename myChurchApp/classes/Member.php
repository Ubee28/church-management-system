<?php  
    require_once "Db.php";

    class Member extends Db
    {
        private $dbconn;
        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function register($fname,$lname,$email,$phone,$dob,$address,$pass1){
            // sql
            $sql = "INSERT INTO members(member_fname,member_lname,member_email,member_phone, member_dob, member_address,
            member_pwd) VALUES(?,?,?,?,?,?,?)";
            // prepare
            $stmt = $this->dbconn->prepare($sql);
            // execute
            $hashed = password_hash($pass1,PASSWORD_DEFAULT);
            $stmt->execute([$fname,$lname,$email,$phone,$dob,$address,$hashed]);
            $id = $this->dbconn->lastInsertId();
            return $id;

        }

        
        public function login($email,$password){
            //sqql
            try{
                $sql = "SELECT * FROM members WHERE member_email=? LIMIT 1";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){//the email exists, get the password from the db and verify with the $password with the one(coming from the form)
                    $hashed_password = $result['member_pwd'];
                    $check = password_verify($password,$hashed_password);
                    if($check){//the password is correct, return the id of the user that has just logged in
                        return $result['member_id'];
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
            $sql = "SELECT * FROM members WHERE member_email =?";
            // prepare
            $stmt = $this->dbconn->prepare($sql);
            // execute
            $stmt->execute([$email]);
            $result = $stmt->rowCount();
            return $result;
            
        }

        public function fetch_all_members(){
            $sql = "SELECT * FROM members";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetch_members_by_month_and_year($month, $year) {
            $sql = "SELECT * FROM members WHERE MONTH(date_added) = ? AND YEAR(date_added) = ? ORDER BY date_added ASC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$month, $year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        public function fetch_new_members($days) {
            // SQL query to select members added in the last X days
            $sql = "SELECT * FROM members WHERE date_added >= DATE_SUB(NOW(), INTERVAL ? DAY) ORDER BY date_added DESC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$days]); // Bind the number of days
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }
        
        

        public function member_count(){
            $sql = "SELECT * FROM members";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->rowCount();
            return $result;
        }

        public function get_member_by_id($member_id){
            $sql = "SELECT * FROM members WHERE member_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$member_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function update_member($member_fname, $member_lname, $member_email, $member_phone, $member_dob, $member_address, $member_id){
            $sql = "UPDATE members
            SET member_fname = ?,
                member_lname = ?,
                member_email = ?,
                member_phone = ?,
                member_dob   = ?,
                member_address = ?
            WHERE member_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $result = $stmt->execute([$member_fname, $member_lname, $member_email, $member_phone, $member_dob, $member_address, $member_id]);
            return $result;
        }

        public function delete_member($member_id){
            $sql = "DELETE FROM members WHERE member_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $result = $stmt->execute([$member_id]);
            return $result;
        }

        public function signout(){
            unset($_SESSION['member_id']);
            session_unset();
            session_destroy();
       }
        

      

    }

    // $a = new Member;
    // $result = $a->check_email("danelijah7@gmail.com");
    
    // echo "<pre>";
    //     print_r($result);
    // echo "<pre>";





?>
<?php 

require_once "Db.php";

    class Donation extends Db 
    {

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function create_donations($member_id, $donor_name, $donor_email, $donor_phone, $purpose, $amount, $is_anonymous, $payment_method, $status, $prayer_request, $reference){
            $sql = "INSERT INTO donations(member_id, donor_name, donor_email, donor_phone, purpose, amount, is_anonymous, payment_method, status, prayer_request, reference )
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->dbconn->prepare($sql);

            $result = $stmt->execute([$member_id, $donor_name, $donor_email, $donor_phone, $purpose, $amount, $is_anonymous, $payment_method, $status, $prayer_request, $reference]);

            return $result;
        }

        public function updateDonationStatus(
            $reference,
            $status
        ){
            $sql = "UPDATE donations
                    SET status = ?
                    WHERE reference = ?";

            $stmt = $this->dbconn->prepare($sql);

            return $stmt->execute([
                $status,
                $reference
            ]);
         }

        public function getMemberDonations($member_id)
        {
            $sql = "SELECT *
                    FROM donations
                    WHERE member_id = ?
                    ORDER BY created_at DESC";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$member_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function fetch_all_donations()
        {
            $sql = "SELECT *
                    FROM donations
                    ORDER BY created_at DESC";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllDonations($search = "", $status = "", $payment_method = "", $limit = null)
        {
            $sql = "SELECT *
                    FROM donations
                    WHERE 1=1";

            $params = [];

            // Search donor name or purpose
            if(!empty($search)){

                $sql .= " AND (donor_name LIKE ? OR purpose LIKE ?)";

                $params[] = "%$search%";
                $params[] = "%$search%";

            }

            // Status filter
            if(!empty($status)){

                $sql .= " AND status = ?";

                $params[] = $status;

            }

            // Payment method filter
            if(!empty($payment_method)){

                $sql .= " AND payment_method = ?";

                $params[] = $payment_method;

            }

            $sql .= " ORDER BY created_at DESC";

            // Dashboard limit
            if($limit !== null){

                $sql .= " LIMIT " . (int)$limit;

            }

            $stmt = $this->dbconn->prepare($sql);

            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function getSuccessfulDonationCount()
        {
            $sql = "SELECT COUNT(*) AS total
                    FROM donations
                    WHERE status = 'successful'";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        }


        public function getTotalDonationAmount()
        {
            $sql = "SELECT SUM(amount) AS total
                    FROM donations
                    WHERE status = 'successful'";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        }

        public function getMemberDonationSummary($member_id)
        {
            $sql = "SELECT
                    COUNT(*) AS total_donations,
                    SUM(amount) AS total_amount
                    FROM donations
                    WHERE member_id = ?
                    AND status = 'successful'";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$member_id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function fetch_donation_by_id($donation_id)
        {
            $sql = "SELECT *
                    FROM donations
                    WHERE donation_id = ?";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$donation_id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

           


    }

 
?>
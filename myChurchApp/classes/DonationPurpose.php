<?php

require_once "Db.php";

class DonationPurpose extends Db
{
    private $dbconn;

    public function __construct()
    {
        $this->dbconn = $this->connect();
    }

    // Fetch all purposes
    public function fetch_all_purposes()
    {
        $sql = "SELECT *
                FROM donation_purposes
                ORDER BY purpose_name ASC";

        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch only active purposes
    public function fetch_active_purposes()
    {
        $sql = "SELECT *
                FROM donation_purposes
                WHERE active = 1
                ORDER BY purpose_name ASC";

        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add purpose
    public function add_purpose($purpose_name, $description)
{
    // Check if purpose already exists
    $check = "SELECT purpose_id
              FROM donation_purposes
              WHERE purpose_name = ?";

    $stmt = $this->dbconn->prepare($check);
    $stmt->execute([$purpose_name]);

    if($stmt->rowCount() > 0){

        return false;

    }

    $sql = "INSERT INTO donation_purposes
            (purpose_name, description)
            VALUES (?, ?)";

    $stmt = $this->dbconn->prepare($sql);

    return $stmt->execute([
        $purpose_name,
        $description
    ]);
}

    // Fetch one purpose
    public function fetch_one_purpose($purpose_id)
    {
        $sql = "SELECT *
                FROM donation_purposes
                WHERE purpose_id = ?";

        $stmt = $this->dbconn->prepare($sql);

        $stmt->execute([$purpose_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update purpose
    public function update_purpose(
        $purpose_id,
        $purpose_name,
        $description
    )
    {
        $sql = "UPDATE donation_purposes
                SET purpose_name = ?,
                    description = ?
                WHERE purpose_id = ?";

        $stmt = $this->dbconn->prepare($sql);

        return $stmt->execute([
            $purpose_name,
            $description,
            $purpose_id
        ]);
    }

    // Activate
    public function activate($purpose_id)
    {
        $sql = "UPDATE donation_purposes
                SET active = 1
                WHERE purpose_id = ?";

        $stmt = $this->dbconn->prepare($sql);

        return $stmt->execute([$purpose_id]);
    }

    // Deactivate
    public function deactivate($purpose_id)
    {
        $sql = "UPDATE donation_purposes
                SET active = 0
                WHERE purpose_id = ?";

        $stmt = $this->dbconn->prepare($sql);

        return $stmt->execute([$purpose_id]);
    }
}
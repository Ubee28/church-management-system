<?php  

require_once "Db.php";

class Notification extends Db
{
    private $dbconn;
    public function __construct(){
        $this->dbconn = $this->connect();
    }

    public function create_notification($type, $message, $flier, $audience) {
        try {
            $sql = "INSERT INTO notifications (type, message, flier, audience) VALUES (?, ?, ?, ?)";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$type, $message, $flier, $audience]);

            // Return the ID of the inserted notification
            return $this->dbconn->lastInsertId();
        } catch (Exception $e) {
            // Log or handle the error appropriately
            throw new Exception("Failed to create notification: " . $e->getMessage());
        }
    }

    // Get all notifications for a member
    public function get_notifications($audience) {
        try {
            $sql = "SELECT id, type, message, flier, created_at 
                    FROM notifications 
                    WHERE audience = ?
                    ORDER BY created_at DESC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$audience]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to fetch notifications: " . $e->getMessage());
        }
    }
    

    // Mark a notification as read
    public function mark_notifications_as_read($audience) {
        try {
            $sql = "UPDATE notifications SET status = 'read' WHERE audience = ? AND status = 'unread'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$audience]);
        } catch (Exception $e) {
            throw new Exception("Failed to mark notifications as read: " . $e->getMessage());
        }
    }
    
    // Get count of unread notifications for a member
    public function get_unread_count($audience) {
        try {
            $sql = "SELECT COUNT(*) FROM notifications WHERE audience = ? AND status = 'unread'";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$audience]);
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            throw new Exception("Failed to fetch unread count: " . $e->getMessage());
        }
    }

    public function delete_notification($id) {
        $query = "DELETE FROM notifications WHERE id = ?";
        $stmt = $this->dbconn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
    
    
}
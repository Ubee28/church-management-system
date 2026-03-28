<?php  

require_once "Db.php";
error_reporting(E_ALL);

    class Event extends Db
    {
        private $dbconn;
        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function create_event($event_name, $event_date, $event_time, $event_loc, $event_desc, $event_flier){
            $sql = "INSERT INTO events(event_name, event_date, event_time, event_location, event_desc, event_flier)
                    VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $this->dbconn->prepare($sql);
            
            // Pass the array of values to bind to the placeholders
            $result = $stmt->execute([$event_name, $event_date, $event_time, $event_loc, $event_desc, $event_flier]);
        
            return $result;
        }
        

        public function fetch_all_events(){
        $sql = "SELECT * FROM events ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $events;

        }

        public function fetch_events_by_month_and_year($month, $year) {
            $sql = "SELECT * FROM events WHERE MONTH(event_date) = ? AND YEAR(event_date) = ? ORDER BY event_date ASC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$month, $year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        
            
        public function fetch_events_by_year($year){
            $sql = "SELECT * FROM events WHERE YEAR(event_date) = ? ORDER BY event_date ASC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        
                public function fetchFilteredEvents($month, $search)
        {
            // Fetch events from January of the current year and forward
            $sql = "SELECT event_name, DATE_FORMAT(event_date, '%Y-%m-%d') AS date, event_time AS time, event_location, event_type 
                    FROM events 
                    WHERE event_date >= CONCAT(YEAR(CURDATE()), '-01-01')";
            $params = [];

            if ($month) {
                $sql .= " AND DATE_FORMAT(event_date, '%Y-%m') = ?";
                $params[] = $month;
            }

            if ($search) {
                $sql .= " AND (event_name LIKE ? OR event_location LIKE ?)";
                $searchParam = "%{$search}%";
                $params[] = $searchParam;
                $params[] = $searchParam;
            }

            $sql .= " ORDER BY event_date ASC";

            // Debugging
            error_log("SQL: $sql");
            error_log("Params: " . json_encode($params));

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


                public function updateEventStatuses()
        {
            // SQL query to update statuses based on event dates
            $sql = "
                UPDATE events 
                SET event_status = 
                    CASE 
                        WHEN event_date < CURDATE() THEN 'past'
                        WHEN event_type = 'special' THEN 'special'
                        ELSE 'upcoming'
                    END
            ";

            $stmt = $this->dbconn->prepare($sql);

            // Execute the query
            if ($stmt->execute()) {
                return true; // Update successful
            }

            // Log any errors (optional for debugging)
            error_log("Failed to update event statuses.");
            return false;
        }

        
        
        
        
        public function getEventFliers(){
            try {
                // SQL query to fetch the latest 3 fliers based on event_date
                $sql = "SELECT e_flier FROM events WHERE e_flier IS NOT NULL ORDER BY event_date DESC LIMIT 3";
                
                // Prepare the SQL statement
                $stmt = $this->dbconn->prepare($sql);
                
                // Execute the statement
                $stmt->execute();
                
                // Fetch all the fliers
                $fliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Return the fliers
                return $fliers;
            } catch (PDOException $e) {
                // Handle any errors
                echo "Error fetching fliers: " . $e->getMessage();
                return [];
            }
        }

        // Method to fetch carousel events
        public function getCarouselEvents(){
            $sql = "SELECT event_name, event_flier, event_date 
                    FROM events 
                    WHERE in_carousel = 1 
                    ORDER BY event_date DESC 
                    LIMIT 3";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // Method to add event to the carousel
        public function addToCarousel($event_id) {
            $sql = "UPDATE events SET in_carousel = 1 WHERE event_id = ?"; // Assuming your primary key is event_id
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$event_id]);

            // Check if any rows were affected
            return $stmt->rowCount() > 0;
        }

        // Method to remove event from the carousel
        public function removeFromCarousel($event_id) {
            $sql = "UPDATE events SET in_carousel = 0 WHERE event_id = ?"; // Assuming your primary key is event_id
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$event_id]);

            // Check if any rows were affected
            return $stmt->rowCount() > 0;
        }

        // Method to count events currently in the carousel
        public function countEventsInCarousel() {
            $sql = "SELECT COUNT(*) as count FROM events WHERE in_carousel = 1";
            $stmt = $this->dbconn->query($sql); // No need to prepare for simple queries without dynamic values
            $result = $stmt->fetch();

            return $result['count'] ?? 0; // Return 0 if no result
        }

        


        public function upcoming_event_count() {
            // SQL query to get the count of events within the next 30 days
            $sql = "SELECT COUNT(*) FROM events WHERE event_date >= CURDATE() AND event_date <= CURDATE() + INTERVAL 1 MONTH";
            $stmt = $this->dbconn->prepare($sql);  // Prepare the SQL query
            $stmt->execute();  // Execute the query
            $result = $stmt->fetchColumn();  // Fetch the count from the first column of the result
            return $result;  // Return the count
        }
        

        public function update_event($event_name, $event_date, $event_time, $event_location, $event_desc,$event_flier,$event_id){
            $sql = "UPDATE events 
            SET event_name = ?, 
                event_date = ?, 
                event_time = ?, 
                event_location = ?, 
                event_desc = ?,
                event_flier = ? 
            WHERE event_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $result = $stmt->execute([$event_name, $event_date, $event_time, $event_location, $event_desc, $event_flier,$event_id]);
            return $result;
        }

        public function get_event_by_id($event_id){
            $sql = "SELECT * FROM events WHERE event_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$event_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        }

        public function delete_event($event_id){
            $sql = "DELETE FROM events WHERE event_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $result = $stmt->execute([$event_id]);
            return $result;
        }




    }
    
    // $t = new Event;
    // $s = $t->fetch_events_by_month_and_year( 9, 2024);
   


?>
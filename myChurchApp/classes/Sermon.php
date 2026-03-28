<?php  
  require_once "Db.php";
  error_reporting(E_ALL);

      class Sermon extends Db{
          private $dbconn;
          public function __construct(){
              $this->dbconn = $this->connect();
          }

          public function add_sermon($sermon_name, $pastor_id, $sermon_date, $sermon_audio, $sermon_video, $transcriptPath, $outlinePath, $sermon_type) {
            // Extract the file ID from the Google Drive link
            preg_match('/\/d\/(.*?)\//', $sermon_audio, $matches);
            $audioFileId = $matches[1] ?? null;
        
            // Insert the data into the database, including the extracted file ID
            $sql = "INSERT INTO sermon (sermon_title, pastor_id, sermon_date, sermon_audio, sermon_video, transcript, sermon_outline, sermon_type, audio_file_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->dbconn->prepare($sql);
            $result = $stmt->execute([
                $sermon_name,
                $pastor_id,
                $sermon_date,
                $sermon_audio,
                $sermon_video,
                $transcriptPath,
                $outlinePath,
                $sermon_type,
                $audioFileId // Save the extracted file ID here
            ]);
        
            return $result;
        }
        
        
        

        public function fetch_all_sermons() {
          $sql = "SELECT 
                      sermon.sermon_id, 
                      sermon.sermon_title, 
                      sermon.sermon_date, 
                      sermon.sermon_audio, 
                      sermon.sermon_video, 
                      sermon.transcript, 
                      sermon.sermon_outline, 
                      sermon.sermon_type, 
                      pastors.pastor_fullname 
                  FROM sermon 
                  JOIN pastors ON sermon.pastor_id = pastors.pastor_id";
                  
          $stmt = $this->dbconn->prepare($sql);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function fetch_sermons_with_audio_id() {
        $sql = "SELECT sermon.sermon_title, sermon.sermon_audio, sermon.sermon_video, sermon.sermon_date, sermon.audio_file_id, 
                       pastors.pastor_fullname 
                FROM sermon
                JOIN pastors ON sermon.pastor_id = pastors.pastor_id";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
      
      public function fetchFilteredSermons($month, $search)
      {
          $sql = "SELECT sermon_title, pastor_fullname, sermon_date, sermon_audio, sermon_video 
                  FROM sermon JOIN pastors ON sermon.pastor_id = pastors.pastor_id
                  WHERE 1"; // Always true, to simplify adding conditions
          $params = [];
      
          if ($month) {
              $sql .= " AND DATE_FORMAT(sermon_date, '%Y-%m') = ?";
              $params[] = $month;
          }
      
          if ($search) {
              $sql .= " AND (sermon_title LIKE ? OR pastor_fullname LIKE ?)";
              $searchParam = "%{$search}%";
              $params[] = $searchParam;
              $params[] = $searchParam;
          }
      
          $sql .= " ORDER BY sermon_date DESC";
      
          $stmt = $this->dbconn->prepare($sql);
          $stmt->execute($params);
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      


          public function fetch_sermon_by_month_and_year($month, $year){
            $sql = "SELECT * FROM sermon JOIN pastors ON sermon.pastor_id = pastors.pastor_id WHERE MONTH(sermon_date) = ? AND YEAR(sermon_date) = ? ORDER BY sermon_date ASC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$month, $year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }

          public function fetch_sermon_by_year($year){
            $sql = "SELECT * FROM sermon JOIN pastors ON sermon.pastor_id = pastors.pastor_id WHERE YEAR(sermon_date) = ? ORDER BY sermon_date ASC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$year]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }  

          public function fetch_recent_sermon_count(){
            $sql = "SELECT * FROM sermon WHERE MONTH(sermon_date) = ? AND YEAR(sermon_date) = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->rowCount();
            return $result;
          }

          // Method to fetch carousel sermons
          public function getCarouselSermons(){
            $sql = "SELECT sermon_title, pastor_fullname, sermon_date, sermon_video 
                    FROM sermon 
                    JOIN pastors ON sermon.pastor_id = pastors.pastor_id 
                    WHERE in_carousel = 1 
                    LIMIT 3";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // Method to add sermon to the carousel
        public function addToCarousel($sermon_id) {
            $sql = "UPDATE sermon SET in_carousel = 1 WHERE sermon_id = ?"; // Changed from 'id' to 'sermon_id'
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$sermon_id]);

            // Check if any rows were affected
            return $stmt->rowCount() > 0;
        }

        // Method to remove sermon from the carousel
        public function removeFromCarousel($sermon_id) {
            $sql = "UPDATE sermon SET in_carousel = 0 WHERE sermon_id = ?"; // Changed from 'id' to 'sermon_id'
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$sermon_id]);

            // Check if any rows were affected
            return $stmt->rowCount() > 0;
        }

        // Method to count sermons currently in the carousel
        public function countSermonsInCarousel() {
            $sql = "SELECT COUNT(*) as count FROM sermon WHERE in_carousel = 1";
            $stmt = $this->dbconn->query($sql); // 
            $result = $stmt->fetch();

            return $result['count'] ?? 0; // Return 0 if no result
        }

        public function update_sermon($id, $title, $pastor_id, $date, $audio, $video, $transcript, $outline, $type){
        $sql = "UPDATE sermon 
                SET sermon_title = ?, pastor_id = ?, sermon_date = ?, sermon_audio = ?, sermon_video = ?, 
                    transcript = ?, sermon_outline = ?, sermon_type = ? 
                WHERE sermon_id = ?";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([$title, $pastor_id, $date, $audio, $video, $transcript, $outline, $type, $id]);
       }

       

      public function get_sermon_by_id($sermon_id) {
        $sql = "
            SELECT 
                sermon.sermon_id,
                sermon.sermon_title,
                sermon.sermon_date,
                sermon.sermon_audio,
                sermon.sermon_video,
                sermon.transcript,
                sermon.sermon_outline,
                sermon.sermon_type,
                pastors.pastor_id,
                pastors.pastor_fullname
            FROM 
                sermon 
            JOIN 
                pastors 
            ON 
                sermon.pastor_id = pastors.pastor_id 
            WHERE 
                sermon.sermon_id = ?
        ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$sermon_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    

          public function delete_sermon($sermon_id){
            $sql = "DELETE FROM sermon WHERE sermon_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $result = $stmt->execute([$sermon_id]);
            return $result;
          }

  }




?>


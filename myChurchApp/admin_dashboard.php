<?php
session_start();
require_once "adminguard.php";
require_once "Admin/class/Admin.php";
require_once "classes/Sermon.php";
require_once "classes/Event.php";
require_once "classes/Member.php";
require_once "classes/Pastor.php";
// require_once "memberCRUD_guard.php";
// require_once "sermonCRUD_guard.php";
// require_once "eventCRUD_guard.php";

$admin = new Admin;
$admin_data = $admin->get_admin_by_id($_SESSION['admin_id']);

$event = new Event;

$member = new Member;
$total_members = $member->member_count();
$new_members = $member->fetch_new_members(7);
// $events = $event->fetch_events_by_year($year);
// $events = $event->fetch_events_by_month_and_year($month, $year);



$event2 = new Event;
$upcoming_event_count = $event2->upcoming_event_count();

$pastor = new Pastor;

$sermon = new Sermon;
include_once "partials/header.php";

?>





<!-- Sidebar -->
<div class="sidebar">
    <a href="#dashboard">Dashboard</a>
    <a href="#members">Members</a>
    <a href="#attendance">Attendance</a>
    <a href="#events">Events</a>
    <a href="#sermons">Sermons</a>
    <a href="#donations">Donations</a>
    <a href="#groups">Groups</a>
    <a href="#roles">Roles</a>
    <a href="#prayerRequests">Prayer Requests</a>
    <a href="#announcements">Announcements</a>
    <a href="#volunteerOpportunities">Volunteer Opportunities</a>
    <a href="#signups">Volunteer Signups</a>
</div>


<!-- Main Content -->
<div class="content mt-5">

    <h1 class="mt-3">Admin Dashboard</h1>
    
    <!-- Dashboard Cards -->
    <div class="row">
    <!-- Total Members -->
    <div class="col-md-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5><?php echo "Total Members: $total_members"?></h5>
          <p><?php echo count($new_members) . " new, Last Week."  ?></p>
          <a href="#members" class="btn btn-primary">View Members</a>
        </div>
      </div>
    </div>
  
    <!-- Total Events -->
    <div class="col-md-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5>Total Events</h5>
          <p><?php echo "$upcoming_event_count Upcoming this month."?></p>
          <a href="#events" class="btn btn-primary">View Events</a>
        </div>
      </div>
    </div>
  
    <!-- Total Donations -->
    <div class="col-md-3 col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5>Total Donations</h5>
          <p>$12,000 Raised</p>
          <a href="#donations" class="btn btn-primary">View Donations</a>
        </div>
      </div>
    </div>
  
    <!-- Total Sermons -->
    <div class="col-md-3 col-sm-6 offset-md-0"> <!-- No offset needed if it fits the row -->
      <div class="card">
        <div class="card-body">
          <h5>Total Sermons</h5>
          <p>20</p>
          <a href="#sermons" class="btn btn-primary">View Sermons</a>
        </div>
      </div>
    </div>
  </div>

    <!-- Members Section -->
    <div id="members" class="row mt-4">
        <h2>Members</h2>
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                 <!-- Dropdown to filter members by month or year -->
                    <div class="mb-3">
                        <label for="filterMembers" class="form-label">Filter Members</label>
                        <select id="filterMembers" class="form-select">
                            <option value="">Select Filter</option>
                            <option value="month">By Month & Year Added</option>
                            <!-- <option value="year">By Year</option> -->
                        </select>
                    </div>

                    <div id="memberCalendarInput" class="mb-3" style="display: none;">
                        <!-- Calendar input for month/year -->
                        <label for="membercalendarDate" class="form-label">Select Month/Year</label>
                        <input type="month" id="memberCalendarDate" class="form-control">
                    </div>

                    <div class="mb-3">
                        <button id="filterMembersBtn" class="btn btn-primary">Filter Members</button>
                    </div>

                    <div class="table-responsive" id="membersTableContainer">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">S/N</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Date added</th>
                            <th class="text-center">Membership Status</th>
                        </tr>
                        </thead>
                        <tbody id="membersTableBody">
                        <?php 
                        // if(!isset($_GET['memberFilterType']) || !isset($_GET['memberFilterValue'])) {
                            
                            
                        //          echo "<tr><td colspan='7'>Filter to Search members by Month and Year Added.</td></tr>";
                            
                        // }else
                        if(isset($_GET['memberFilterType']) && isset($_GET['memberFilterValue'])){
                            $filterType = $_GET['memberFilterType'];
                            $filterValue = $_GET['memberFilterValue'];

                            if($filterType === 'month'){
                                $month = date('m', strtotime($filterValue));
                                $year = date('Y', strtotime($filterValue));
                                $members = $member->fetch_members_by_month_and_year($month, $year);
                            }
                        }
                    
                        ?>
                            <?php 
                                $sn = 1;
                                if(!empty($members)){
                                    foreach ($members as $member){
                                $date_format = strtotime($member["date_added"]);
                            ?>
                        <tr>
                            <td class="text-center"><?php echo $sn++ ?></td>
                            <td class="text-center"><?php echo $member["member_fname"] ." ". $member["member_lname"] ?></td>
                            <td class="text-center"><?php echo $member["member_email"]; ?></td>
                            <td class="text-center"><?php echo $member["member_phone"];?></td>
                            <td class="text-center"><?php echo date("F d, Y", $date_format);?></td>
                            <td class="text-center"><?php echo $member["member_status"];?></td>

                        </tr>
                            <?php
                            }
                        }else{
                             echo "<tr><td colspan='7'>No Member found for the selected filter.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                     <!-- Link to view all members -->
                     <a href="all_members.php" class="btn btn-link mt-3">See All Members</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Section -->
    <!-- <div id="attendance" class="row mt-4">
        <h2>Attendance</h2>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Attendance Records</h5>
                    <button class="btn btn-success mb-3">Add Attendance</button>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Attendance ID</th>
                            <th>Member ID</th>
                            <th>Event ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                         Example Row 
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>5</td>
                            <td>2024-09-01</td>
                            <td>Present</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Events Section -->
    <div id="events" class="row mt-4">
        <h2>Events</h2>
        <div class="col-md-12">
            <div class="card table-responsive">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Events</h5>
                    
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createEventModal">
                        Add New Event
                    </button>
            <!-- Modal -->
            <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createEventModalLabel">Add New Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Display error/success messages from AJAX -->
            <div id="responseMessage" class="m-3"></div>

            <div class="modal-body">
                <!-- Add Event Form -->
                <form id="eventForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventName" class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="eventName" name="eventName">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventDate" class="form-label">Event Date</label>
                                <input type="date" class="form-control" id="eventDate" name="eventDate">
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-6">
                             <div class="mb-3">
                                <label for="event_loc" class="form-label">Location</label>
                                <input type="text" class="form-control" id="event_loc" name="event_loc">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventTime" class="form-label">Event Time</label>
                                <input type="time" class="form-control" id="eventTime" name="eventTime">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="event_desc" class="form-label">Description</label>
                        <textarea class="form-control" id="event_desc" name="event_desc" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="event_flier" class="form-label">Upload Event Flier</label>
                        <input type="file" class="form-control" id="event_flier" name="event_flier">
                    </div>
                    <button type="submit" name="btn_create" id="createEventBtn" class="btn btn-primary" disabled>Add Event</button>
                </form>
            </div>
        </div>
    </div>
</div>


         <!-- Dropdown to filter events by month or year -->
            <div class="mb-3">
                <label for="filterEvents" class="form-label">Filter Events</label>
                <select id="filterEvents" class="form-select">
                    <option value="">Select Filter</option>
                    <option value="month">By Month & Year</option>
                    <!-- <option value="year">By Year</option> -->
                </select>
            </div>

            <div id="eventCalendarInput" class="mb-3" style="display: none;">
                <!-- Calendar input for month/year -->
                <label for="calendarDate" class="form-label">Select Month & Year</label>
                <input type="month" id="eventCalendarDate" class="form-control">
            </div>

            <div class="mb-3">
            <button id="filterEventsBtn" class="btn btn-primary">Filter Events</button>
            </div>
            
            <!-- Events Table -->
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">S/N</th>
                    <th class="text-center">Event Name</th>
                    <th class="text-center">Event Date</th>
                    <th class="text-center">Time</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">e-Flier</th>
                    <th class="text-center">Home Page</th>
                </tr>
            </thead>
            <tbody id="eventsTableBody">
            <?php 
                //  Fetch sermons based on filter if applied
                if(isset($_GET['eventFilterType']) && isset($_GET['eventFilterValue'])){
                    $eventFilterType = $_GET['eventFilterType'];
                    $eventFilterValue = $_GET['eventFilterValue'];

                    if($eventFilterType === 'month'){
                        $month = date('m', strtotime($eventFilterValue));
                        $year = date('Y', strtotime($eventFilterValue));
                        $events = $event->fetch_events_by_month_and_year($month, $year);

                    }
                } else
            
            ?>
            <?php
            
            $sn = 1;
            if (!empty($events)) {
                foreach ($events as $event) {
                    $date_format = strtotime($event["event_date"]);
                    $time_format = strtotime($event["event_time"]);
                    $pr_carousel = $event['in_carousel']; // Column to track carousel status
            ?>
            <tr>
                <td class="text-center"><?php echo $sn++; ?></td>
                <td class="text-center"><?php echo htmlspecialchars($event["event_name"]); ?></td>
                <td class="text-center"><?php echo date("F d, Y", $date_format); ?></td>
                <td class="text-center"><?php echo date("g:i A", $time_format); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($event["event_location"]); ?></td>
                <td class="text-truncate" style="max-width: 150px;"><?php echo htmlspecialchars($event["event_desc"]); ?></td>
                <td class="text-truncate" style="max-width: 170px;">
                    <img src="<?php echo htmlspecialchars($event["event_flier"]); ?>" alt="Event Flier" style="width: 100px;">
                </td>
                <td>
                    <?php if ($pr_carousel == 1): ?>
                        <!-- Button to remove from carousel -->
                        <button id="btn-<?php echo $event['event_id']; ?>" 
                                type="button"
                                class="btn btn-warning carousel-action"
                                data-event-id="<?php echo $event['event_id']; ?>" 
                                data-action="removed">Remove</button>
                    <?php else: ?>
                        <!-- Button to add to carousel -->
                        <button id="btn-<?php echo $event['event_id']; ?>" 
                                type="button"
                                class="btn btn-success carousel-action" 
                                data-event-id="<?php echo $event['event_id']; ?>" 
                                data-action="added">Add</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php 
                    }
                } else {
                    echo "<tr><td colspan='8'>No events found for the selected filter.</td></tr>";
                }
            ?>
            </tbody>
            </table>
            </div>


                     <!-- Link to view all events -->
                     <a href="all_events.php" class="btn btn-link mt-3">See All Events</a>
            </div>
        </div>
    </div>
</div>

    <!-- Sermons Section -->
    <div id="sermons" class="row mt-4">
        <h2>Sermons</h2>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sermon Records</h5>
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createSermonModal">
                        Add New Sermon
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="createSermonModal" tabindex="-1" aria-labelledby="createSermonModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createSermonModalLabel">Create New Sermon</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                     <!-- Display error/success messages from AJAX -->
                            <div id="responseMessages" class="m-3"></div>

                                <div class="modal-body">
                                            <!-- Sermon Form -->
                                    <form id="sermonForm" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sermonTitle" class="form-label">Sermon Title</label>
                                                    <input type="text" class="form-control" id="sermonTitle" name="sermonTitle">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="Preacher" class="form-label">Preacher</label>
                                                    <select class="form-select" id="Preacher" name="Preacher">
                                                    
                                                    <option>Select a Preacher</option>
                                                    <?php
                                                
                                                        $pastors = $pastor->fetch_all_pastors();
                                                        foreach ($pastors as $pst) {
                                                            echo "<option value='" . htmlspecialchars($pst['pastor_id']) . "'>" . htmlspecialchars($pst['pastor_fullname']) . "</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="SermonDate" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="SermonDate" name="SermonDate">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sermonType" class="form-label">Sermon Type</label>
                                                    <select class="form-select" id="SermonType" name="sermonType">
                                                        <option value="">Select Sermon Type</option>
                                                        <option value="full">Full (Audio, Video, Transcript)</option>
                                                        <option value="audio">Audio Only</option>
                                                        <option value="video">Video Only</option>
                                                        <option value="transcript">Transcript Only</option>
                                                        <option value="text">Text Only</option>
                                                    </select>
                                                    <div id="formatHint" class="form-text text-muted mb-3" style="color:red !important;">
                                                        Please select a sermon type to see the required formats.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="textField" class="form-label">Upload Sermon Outline</label>
                                                        <input type="file" class="form-control" id="textField" name="text" style="display: none;">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="audioField" class="form-label">Audio URL</label>
                                                        <input type="text" class="form-control" id="audioField" name="audio" style="display: none;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="videoField" class="form-label">Video URL</label>
                                                        <input type="text" class="form-control" id="videoField" name="video" style="display: none;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="transcriptField" class="form-label">Upload Transcript</label>
                                                        <input type="file" class="form-control" id="transcriptField" name="transcript" style="display: none;">
                                                    </div>
                                                </div>
                                            </div>

                                        <button type="submit" name="btn_Add" id="AddSermonBtn" class="btn btn-primary" disabled>Add Sermon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- Dropdown to filter sermons by month or year -->
            <div class="mb-3">
                <label for="filterSermons" class="form-label">Filter Recent Sermons</label>
                <select id="filterSermons" class="form-select">
                    <option value="">Select Filter</option>
                    <option value="month">By Month & Year</option>
                    <!-- <option value="year">By Year</option> -->
                </select>
            </div>

            <div id="sermonCalendarInput" class="mb-3" style="display: none;">
                <!-- Calendar input for month/year -->
                <label for="sermonCalendarLabel" class="form-label">Select Month/Year</label>
                <input type="month" id="sermonCalendarDate" class="form-control">
            </div>

            <div class="mb-3">
            <button id="filterSermonsBtn" class="btn btn-primary">Filter Sermons</button>
            </div>
                    <!-- Sermons Table -->
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">S/N</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Preacher</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Audio File</th>
                                <th class="text-center">Video URL</th>
                                <th class="text-center">Transcript</th>
                                <th class="text-center" style="display: flex; align-items: center;">
                                <span style="margin-top: 40px;">Slider</span>  
                                <img src="uploads/video (1).png" height="50px"  style="margin-top: 25px" width="60px" alt="carousel slider icon" style="margin-left: 10px;">
                                </th>
                                <!-- New column for carousel controls -->
                            </tr>
                        </thead>
                        <tbody id="sermonsTableBody">
                        <?php
                            //  Fetch sermons based on filter if applied
                            if(isset($_GET['sermonFilterType']) && isset($_GET['sermonFilterValue'])){
                                $sermonFilterType = $_GET['sermonFilterType'];
                                $sermonFilterValue = $_GET['sermonFilterValue'];

                                if($sermonFilterType === 'month'){
                                    $month = date('m', strtotime($sermonFilterValue));
                                    $year = date('Y', strtotime($sermonFilterValue));
                                    $sermons = $sermon->fetch_sermon_by_month_and_year($month, $year);

                                }
                            } else
                        ?>
                            <?php 
                                $sn = 1;
                            if(!empty($sermons)){
                                foreach($sermons as $sermon){
                                    $sd_format = strtotime($sermon["sermon_date"]);
                                    $in_carousel = $sermon['in_carousel']; // Assume you have this in your database
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $sn++; ?></td>
                                <td class="text-center"><?php echo $sermon["sermon_title"]?></td>
                                <td class="text-center"><?php echo $sermon["pastor_fullname"]?></td>
                                <td class="text-center"><?php echo date("F, d, Y", $sd_format);?></td>
                                <td class="text-truncate" style="max-width: 150px;"><a href="#"><?php echo $sermon["sermon_audio"]?></a></td>
                                <td class="text-truncate" style="max-width: 150px;"><a href="#"><?php echo $sermon["sermon_video"]?></a></td>
                                <td class="text-truncate" style="max-width: 150px;"><a href="#"><?php echo $sermon["Transcript"]?></a></td>
                                <td>
                                    <?php if ($sermon["in_carousel"] == 1): ?>
                                        <!-- Button to remove from carousel -->
                                        <button id="btn-<?php echo $sermon['sermon_id']; ?>" 
                                            type="button"
                                            class="btn btn-warning carousel-action"
                                            data-sermon-id="<?php echo $sermon['sermon_id']; ?>" 
                                            data-action="remove">Remove</button>
                                    <?php else: ?>
                                        <!-- Button to add to carousel -->
                                        <button id="btn-<?php echo $sermon['sermon_id']; ?>" 
                                            type="button"
                                            class="btn btn-success carousel-action" 
                                            data-sermon-id="<?php echo $sermon['sermon_id']; ?>" 
                                            data-action="add">Add</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } 
                            }else {
                                echo "<tr><td colspan='8'>No sermons found for the selected filter.</td></tr>";
                            }
                            
                            ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- Link to view all sermons -->
                    <a href="all_sermons.php" class="btn btn-link mt-3">See All Sermons</a>


    <!-- Other sections (Donations, Groups, Roles, etc.) follow similar patterns -->

</div>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).on('click', '.carousel-action', function(e) {
      e.preventDefault();
      
      let sermonId = $(this).data('sermon-id'); 
      let action = $(this).data('action'); 
      
      $.ajax({
          url: 'process/carousel_action.php',
          method: 'POST',
          data: {
              sermon_id: sermonId,
              action: action
          },
          success: function(response) {
              let res = JSON.parse(response);
              if (res.status === 'success') {
                  if (action === 'add') {
                      $(`#btn-${sermonId}`).text('Remove').data('action', 'remove');
                  } else if (action === 'remove') {
                      $(`#btn-${sermonId}`).text('Add').data('action', 'add');
                  }
              } else {
                  alert('Error: ' + res.message);
              }
          },
          error: function() {
              alert('An error occurred while processing your request.');
          }
      });
  });
</script>

<script>
// Carousel Process AJAX Logic
$(document).on('click', '.carousel-action', function(e) {
    e.preventDefault();
    
    let eventId = $(this).data('event-id'); 
    let action = $(this).data('action'); 
    
    $.ajax({
        url: 'process/eventCarousel.php', // Carousel process logic
        method: 'POST',
        data: { event_id: eventId, action: action },
        success: function(response) {
            let res = JSON.parse(response);
            if (res.status === 'success') {
                if (action === 'added') {
                    $(`#btn-${eventId}`).text('Remove').data('action', 'removed');
                } else if (action === 'removed') {
                    $(`#btn-${eventId}`).text('Add').data('action', 'added');
                }
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function() {
            alert('An error occurred while processing your request.');
        }
    });
});
</script>

<script>
// Event Filtering AJAX Logic
document.addEventListener('DOMContentLoaded', function () {
    const filterEventsDropdown = document.getElementById('filterEvents');
    const eventCalendarInput = document.getElementById('eventCalendarInput');
    const eventCalendarDateInput = document.getElementById('eventCalendarDate');

    filterEventsDropdown.addEventListener('change', function () {
        const selectedValue = filterEventsDropdown.value;

        if (selectedValue === 'month') {
            eventCalendarInput.style.display = 'block';
            eventCalendarDateInput.type = 'month'; // Show month picker
        } else {
            eventCalendarInput.style.display = 'none';
        }
    });

    document.getElementById('filterEventsBtn').addEventListener('click', function () {
        const selectedValue = filterEventsDropdown.value;
        const selectedDate = eventCalendarDateInput.value;

        let url = new URL(window.location);
        url.searchParams.set('eventFilterType', selectedValue);
        if (selectedValue === 'month' && selectedDate) {
            url.searchParams.set('eventFilterValue', selectedDate);
        } else {
            url.searchParams.delete('eventFilterValue');
        }
        window.location.href = url.toString();
    });
});

</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const filterSermonsDropdown = document.getElementById('filterSermons');
        const sermonCalendarInput = document.getElementById('sermonCalendarInput');
        const sermonCalendarDateInput = document.getElementById('sermonCalendarDate');
        const sermonCalendarLabel = document.getElementById('sermonCalendarLabel');

        filterSermonsDropdown.addEventListener('change', function () {
            const selectedValue = filterSermonsDropdown.value;

            if (selectedValue === 'month') {
                // Show the month picker (with year)
                sermonCalendarInput.style.display = 'block';
                sermonCalendarLabel.textContent = 'Select Month & Year';
                sermonCalendarDateInput.type = 'month'; // Show month picker
            } else {
                sermonCalendarInput.style.display = 'none';
            }
        });

        // Event listener for the filter button
        document.getElementById('filterSermonsBtn').addEventListener('click', function () {
            const selectedValue = filterSermonsDropdown.value;
            const selectedDate = sermonCalendarDateInput.value;

            let url = new URL(window.location);
            url.searchParams.set('sermonFilterType', selectedValue);
            if (selectedValue === 'month' && selectedDate) {
                url.searchParams.set('sermonFilterValue', selectedDate);
            } else {
                url.searchParams.delete('sermonFilterValue');
            }
            window.location.href = url.toString();
        });
    });



</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterMembersDropdown = document.getElementById('filterMembers');
    const memberCalendarInput = document.getElementById('memberCalendarInput');
    const memberCalendarDateInput = document.getElementById('memberCalendarDate');
    // const membersTableContainer = document.getElementById('membersTableContainer');
    // const membersTableBody = document.getElementById('membersTableBody');

    // // Initially hide table if no rows are present
    // if (membersTableBody.children.length > 1) {
    //     membersTableContainer.style.display = 'block'; // Show table if rows exist
    // }
    
    filterMembersDropdown.addEventListener('change', function () {
        const selectedValue = filterMembersDropdown.value;

        if (selectedValue === 'month') {
            memberCalendarInput.style.display = 'block';
            memberCalendarDateInput.type = 'month'; // Show month picker
        } else {
            memberCalendarInput.style.display = 'none';
        }
    });

    document.getElementById('filterMembersBtn').addEventListener('click', function () {
        const selectedValue = filterMembersDropdown.value;
        const selectedDate = memberCalendarDateInput.value;

        let url = new URL(window.location);
        url.searchParams.set('memberFilterType', selectedValue);
        if (selectedValue === 'month' && selectedDate) {
            url.searchParams.set('memberFilterValue', selectedDate);
        } else {
            url.searchParams.delete('memberFilterValue');
        }
        window.location.href = url.toString();
    });
});

</script>


</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Event Form Fields
    const eventFormFields = document.querySelectorAll('#eventName, #eventDate, #eventTime, #event_loc, #event_desc, #event_flier');
    const eventSubmitBtn = document.getElementById('createEventBtn');

    function checkEventFormFields() {
        let allFilled = true;

        eventFormFields.forEach(field => {
            if (field.type === 'file') {
                if (field.files.length === 0) {
                    allFilled = false;
                }
            } else {
                if (field.value.trim() === '') {
                    allFilled = false;
                }
            }
        });

        eventSubmitBtn.disabled = !allFilled;
    }

    // Attach event listeners to all fields
    eventFormFields.forEach(field => {
        field.addEventListener('input', checkEventFormFields);
        field.addEventListener('change', checkEventFormFields); 
    });

    checkEventFormFields();

    // Event form submission
    document.getElementById('eventForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const responseMessage = document.getElementById('responseMessage');
        eventSubmitBtn.disabled = true;

        fetch('process/pro_create_event.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                responseMessage.innerHTML = `<div class='alert alert-danger'>${data.message}</div>`;
                eventSubmitBtn.disabled = false;
            } else {
                responseMessage.innerHTML = `<div class='alert alert-success'>Event created successfully!</div>`;
                document.getElementById('eventForm').reset();
                eventSubmitBtn.disabled = true;
                var modal = bootstrap.Modal.getInstance(document.getElementById('createEventModal'));
                modal.hide();
                location.reload();
            }
        })
        .catch(error => {
            responseMessage.innerHTML = "<div class='alert alert-danger'>An error occurred while creating the event.</div>";
            eventSubmitBtn.disabled = false;
        });
    });
});
</script>

<script>
// HTML Elements
const sermonTitle = document.getElementById("sermonTitle");
const sermonDate = document.getElementById("SermonDate");
const preacher = document.getElementById("Preacher");
const sermonType = document.getElementById("SermonType");
const addSermonButton = document.getElementById("AddSermonBtn");
const formatHint = document.getElementById("formatHint");

// Fields for each type
const audioField = document.getElementById("audioField");
const videoField = document.getElementById("videoField");
const transcriptField = document.getElementById("transcriptField");
const textField = document.getElementById("textField");

// Hide all optional fields initially
function hideAllFields() {
    audioField.style.display = "none";
    audioField.value = ""; // Clear input
    videoField.style.display = "none";
    videoField.value = ""; // Clear input
    transcriptField.style.display = "none";
    transcriptField.value = ""; // Clear input
    textField.style.display = "none";
    textField.value = ""; // Clear input
}

// Function to validate visible fields and enable the button accordingly
function validateFields() {
    const selectedType = sermonType.value;
    const preacherSelected = preacher.value && preacher.value !== "Select a Preacher";
    const titleFilled = sermonTitle.value.trim() !== "";
    const dateFilled = sermonDate.value !== "";

    // Validation for fields based on sermon type
    const fieldValidations = {
        audio: audioField.value.trim() !== "",
        video: videoField.value.trim() !== "",
        transcript: transcriptField.files.length > 0,
        text: textField.files.length > 0,
    };

    let areVisibleFieldsValid = true;

    // Check only the fields relevant to the selected sermon type
    switch (selectedType) {
        case "full":
            areVisibleFieldsValid = fieldValidations.audio && fieldValidations.video && fieldValidations.transcript;
            break;
        case "audio":
            areVisibleFieldsValid = fieldValidations.audio;
            break;
        case "video":
            areVisibleFieldsValid = fieldValidations.video;
            break;
        case "transcript":
            areVisibleFieldsValid = fieldValidations.transcript;
            break;
        case "text":
            areVisibleFieldsValid = fieldValidations.text;
            break;
        default:
            areVisibleFieldsValid = false;
    }

    // Enable the button only when all required conditions are met
    const isButtonEnabled = titleFilled && dateFilled && preacherSelected && areVisibleFieldsValid;
    addSermonButton.disabled = !isButtonEnabled;
}

// Add listener to sermon type to update hints and validate fields
sermonType.addEventListener("change", () => {
    const selectedType = sermonType.value;

    // Reset fields visibility and clear existing data
    hideAllFields();

    switch (selectedType) {
        case "full":
            audioField.style.display = "block";
            videoField.style.display = "block";
            transcriptField.style.display = "block";
            formatHint.textContent = "Full: Provide Audio URL, Video URL, and Transcript.";
            break;
        case "audio":
            audioField.style.display = "block";
            formatHint.textContent = "Audio Only: Provide an Audio URL.";
            break;
        case "video":
            videoField.style.display = "block";
            formatHint.textContent = "Video Only: Provide a Video URL.";
            break;
        case "transcript":
            transcriptField.style.display = "block";
            formatHint.textContent = "Transcript Only: Upload a transcript file.";
            break;
        case "text":
            textField.style.display = "block";
            formatHint.textContent = "Text Only: Upload a sermon outline file.";
            break;
        default:
            formatHint.textContent = "Please select a sermon type to see the required formats.";
    }

    validateFields(); // Re-validate after changing sermon type
});

// Attach event listeners for input change
preacher.addEventListener("change", validateFields);
sermonTitle.addEventListener("input", validateFields);
sermonDate.addEventListener("input", validateFields);
audioField.addEventListener("input", validateFields);
videoField.addEventListener("input", validateFields);
transcriptField.addEventListener("change", validateFields);
textField.addEventListener("change", validateFields);

// Submit form using AJAX
document.getElementById("sermonForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const responseMessages = document.getElementById("responseMessages");

    // Disable the button to prevent duplicate submissions
    addSermonButton.disabled = true;

    // Perform AJAX request
    fetch("process/pro_create_sermon.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                responseMessages.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                this.reset(); // Reset form
                hideAllFields(); // Hide optional fields
                addSermonButton.disabled = true; // Keep button disabled
            } else {
                responseMessages.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch((error) => {
            responseMessages.innerHTML = `<div class="alert alert-danger">An error occurred: ${error.message}</div>`;
        })
        .finally(() => {
            addSermonButton.disabled = false; // Re-enable the button
        });
});


</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterDropdown = document.getElementById('filterEvents');
        const calendarInput = document.getElementById('calendarInput');
        const filterEventsBtn = document.getElementById('filterEventsBtn');

        filterDropdown.addEventListener('change', function () {
            if (filterDropdown.value === 'month' || filterDropdown.value === 'year') {
                calendarInput.style.display = 'block';
                if (filterDropdown.value === 'year') {
                    calendarInput.innerHTML = '<label for="calendarDate" class="form-label">Select Year</label><input type="number" id="calendarDate" class="form-control" min="2000" max="' + new Date().getFullYear() + '">';
                } else {
                    calendarInput.innerHTML = '<label for="calendarDate" class="form-label">Select Month</label><input type="month" id="calendarDate" class="form-control">';
                }
            } else {
                calendarInput.style.display = 'none';
            }
        });

        filterEventsBtn.addEventListener('click', function () {
            const filterType = filterDropdown.value;
            const filterValue = document.getElementById('calendarDate').value;

            if (filterType && filterValue) {
                const urlParams = new URLSearchParams({ filterType: filterType, filterValue: filterValue });
                window.location.href = 'admin_dashboard.php?' + urlParams.toString();
            } else {
                alert('Please select a filter and date.');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterDropdown = document.getElementById('filterSermons');
        const calendarInput = document.getElementById('S_calendarInput');
        const filterEventsBtn = document.getElementById('filterSermonsBtn');

        filterDropdown.addEventListener('change', function () {
            if (filterDropdown.value === 'month' || filterDropdown.value === 'year') {
                calendarInput.style.display = 'block';
                if (filterDropdown.value === 'year') {
                    calendarInput.innerHTML = '<label for="calendarDate" class="form-label">Select Year</label><input type="number" id="S_calendarDate" class="form-control" min="2000" max="' + new Date().getFullYear() + '">';
                } else {
                    calendarInput.innerHTML = '<label for="calendarDate" class="form-label">Select Month</label><input type="month" id="S_calendarDate" class="form-control">';
                }
            } else {    
                calendarInput.style.display = 'none';
            }
        });

        filterEventsBtn.addEventListener('click', function () {
            const filterType = filterDropdown.value;
            const filterValue = document.getElementById('S_calendarDate').value;

            if (filterType && filterValue) {
                const urlParams = new URLSearchParams({ filterType: filterType, filterValue: filterValue });
                window.location.href = 'admin_dashboard.php?' + urlParams.toString();
            } else {
                alert('Please select a filter and date.');
            }
        });
    });
</script>



<!-- Back to Top Button -->
<a href="#" class="btn btn-primary back-to-top" id="backToTopBtn" style="display: none;">
  <i class="fas fa-arrow-up"></i>
</a>

<script>
  // Show or hide the "Back to Top" button based on scroll position
  window.onscroll = function() {
    scrollFunction();
  };

  function scrollFunction() {
    const backToTopBtn = document.getElementById("backToTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      backToTopBtn.style.display = "block";
    } else {
      backToTopBtn.style.display = "none";
    }
  }

  // Scroll smoothly to the top when the button is clicked
  document.getElementById("backToTopBtn").addEventListener("click", function(event) {
    event.preventDefault();
    window.scrollTo({top: 0, behavior: 'smooth'});
  });
</script>


</body>
</html>

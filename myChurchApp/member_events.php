<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";


$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);
include_once "partials/header.php";
?>


    <div class="row" style="margin: 70px 0px 295px 0px">
        <?php 
            require_once "partials/menu.php";
        
        ?>
            <div class="col-md-9 p-3">

             <div class="container">
                <!-- Search Bar -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <input type="text" id="searchBar" class="form-control w-50" placeholder="Search events..." />
                    <div class="d-flex align-items-center ms-3">
                        <label for="monthPicker" class="me-2 fw-bold">Filter by Month:</label>
                        <input type="month" id="monthPicker" 
                         class="form-control w-auto" 
                         min="2024-01" 
                         
                        />
                    </div>
                </div>

                <!-- Events Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody id="eventsTableBody">
                            <tr>
                                <td colspan="5" class="text-center text-muted">Loading events...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <!-- Footer -->
    <div class="row bg-dark text-white" style="position:fixed; bottom: 0; left:0; right:0;">
            <div class="col">
                <p class="text-center my-3 "> &copy; 2024 Developed By Me</p>
            </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monthPicker = document.getElementById('monthPicker');
        const searchBar = document.getElementById('searchBar');
        const eventsTableBody = document.getElementById('eventsTableBody');

        // The month picker with current month and restriction
        const today = new Date();
        const currentYear = today.getFullYear();
        const currentMonth = String(today.getMonth() + 1).padStart(2, '0'); // Leading zero for months
        const minValue = `${currentYear}-${currentMonth}`;
        monthPicker.setAttribute('min', minValue);
        monthPicker.setAttribute('value', minValue);

        // Fetch and display events
        function fetchEvents(filter = {}) {
            eventsTableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            `;

            // AJAX logic for fetching filtered events
            fetch('process/fetch_events.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(filter)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const events = data.events;
                        eventsTableBody.innerHTML = events.length
                            ? events.map(event => `
                                <tr>
                                    <td>${event.event_name}</td>
                                    <td>${event.date}</td>
                                    <td>${event.time}</td>
                                    <td>${event.event_location}</td>
                                    <td>${event.event_type}</td>
                                </tr>
                              `).join('')
                            : `<tr>
                                    <td colspan="5" class="text-center text-muted">No events found.</td>
                               </tr>`;
                    } else {
                        eventsTableBody.innerHTML = `
                            <tr>
                                <td colspan="5" class="text-danger text-center">Failed to load events.</td>
                            </tr>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error fetching events:', error);
                    eventsTableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-danger text-center">An error occurred. Please try again.</td>
                        </tr>
                    `;
                });
        }

        // Event listeners for month picker and search bar
        monthPicker.addEventListener('change', () => {
            const selectedMonth = monthPicker.value;
            fetchEvents({ month: selectedMonth, search: searchBar.value });
        });

        searchBar.addEventListener('input', () => {
            const selectedMonth = monthPicker.value;
            fetchEvents({ month: selectedMonth, search: searchBar.value });
        });

        // Initial fetch with default month
        fetchEvents({ month: monthPicker.value });
    });
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const monthPicker = document.getElementById('monthPicker');
    const currentYear = new Date().getFullYear();
    const minDate = `${currentYear}-01`; // First month of the current year

    // Set the min attribute dynamically
    monthPicker.setAttribute('min', minDate);

    // Log for debugging
    console.log('Month picker min attribute set to:', minDate);
});

</script>

 
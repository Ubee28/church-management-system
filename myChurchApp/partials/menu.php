<style>
.list-group-item {
    position: relative;
    padding-bottom: 2.5rem; /* Extra space for the button */
}

.list-group-item h5 {
    margin-bottom: 0.5rem; /* spacing between message and time */
}

.list-group-item small {
    display: block; /* time appears on its own line */
    color: #6c757d; /* Muted text color */
}

.list-group-item img {
    margin-top: 1rem; /* space above the image */
    max-width: 100%; 
    height: auto;
    border-radius: 5px;
}

.delete-notification-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    z-index: 2; /* Button stays above all elements */
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

</style>




<div class="col-md-3">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" 
         style="width: 280px; height: 75vh; position: fixed; top: 70px; z-index: 1040; overflow-y: auto;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="member_dashboard.php" class="nav-link link-body-emphasis active">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="member_profile.php" class="nav-link link-body-emphasis">
                    <i class="fa fa-user-circle"></i> Profile
                </a>
            </li>
            <li>
                <a href="member_sermons.php" class="nav-link link-body-emphasis">
                    <i class="fa fa-file-alt"></i> Sermons
                </a>
            </li>
            <li>
                <a href="member_events.php" class="nav-link link-body-emphasis">
                    <i class="fa fa-calendar-alt"></i> Events
                </a>
            </li>
            <!-- <li>
                <a href="member_donations.php" class="nav-link link-body-emphasis">
                    <i class="fa fa-hand-holding-usd"></i> Donations
                </a>
            </li> -->
            <!-- <li>
                <a href="#" class="nav-link link-body-emphasis">
                    <i class="fa fa-bullhorn"></i> Announcements
                </a>
            </li> -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link link-body-emphasis" id="notificationIcon" data-bs-toggle="modal" data-bs-target="#notificationModal">
                    <i class="fa fa-bell"></i>  Notifications
                    <span class="badge bg-danger" id="notificationBadge" style="display: none;">0</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="nav-link link-body-emphasis">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Notification Modal -->
<div class="modal" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true" 
     style="z-index: 1055;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="position: relative; z-index: 1055;">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="notificationList" class="list-group">
                    <!-- Notifications dynamically loaded -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Bootstrap and Fetching Notifications -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const notificationBadge = document.getElementById('notificationBadge');
    const notificationList = document.getElementById('notificationList');

    // Fetch and display notifications
    function fetchNotifications() {
        notificationList.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        fetch('process/get_notification.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const notifications = data.data;
                    const unreadCount = data.unread_count;

                    // Update badge count
                    if (unreadCount > 0) {
                        notificationBadge.textContent = unreadCount;
                        notificationBadge.style.display = 'inline';
                    } else {
                        notificationBadge.style.display = 'none';
                    }

                    // Populate the notification list
                    notificationList.innerHTML = notifications.length > 0 
                        ? notifications.map(notification => `
                            <div class="list-group-item">
                                <div>
                                    <h5 class="mb-1">${notification.message}</h5>
                                    <small>${new Date(notification.created_at).toLocaleString()}</small>
                                </div>
                                ${notification.flier ? `
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-primary view-flier-btn" 
                                                data-flier="uploads/${notification.flier}">
                                            <i class="fa fa-eye"></i> View Flier
                                        </button>
                                    </div>
                                    <div class="flier-container mt-3" style="display: none;">
                                        <img src="" alt="Flier" class="img-fluid rounded">
                                    </div>
                                ` : ''}
                                <button class="btn btn-sm btn-danger mt-2 delete-notification-btn float-end" 
                                        data-id="${notification.id}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        `).join('') 
                        : '<p class="text-muted">No notifications available.</p>';


                } else {
                    notificationList.innerHTML = '<p class="text-muted">Failed to load notifications.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                notificationList.innerHTML = `
                    <p class="text-danger">An error occurred while loading notifications.</p>
                    <button class="btn btn-primary" onclick="fetchNotifications()">Retry</button>
                `;
            });
    }

    // Mark all notifications as read
    function markAllNotificationsAsRead() {
        fetch('process/mark_notifications_read.php', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Hide the badge and reload notifications
                    notificationBadge.style.display = 'none';
                    fetchNotifications();
                    console.log(data.message);
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => {
                console.error('Error marking notifications as read:', error);
            });
    }

    // Event listener for notification icon
    document.getElementById('notificationIcon').addEventListener('click', markAllNotificationsAsRead);

    fetchNotifications(); // Initial load
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const notificationList = document.getElementById('notificationList');

    notificationList.addEventListener('click', function (e) {
        if (e.target.classList.contains('view-flier-btn')) {
            const button = e.target;
            const flierSrc = button.dataset.flier;
            const flierContainer = button.closest('.list-group-item').querySelector('.flier-container');

            if (flierContainer.style.display === 'none') {
                // Show the flier
                flierContainer.style.display = 'block';
                flierContainer.querySelector('img').src = flierSrc;
                button.innerHTML = '<i class="fa fa-eye-slash"></i> Hide Flier';
            } else {
                // Hide the flier
                flierContainer.style.display = 'none';
                button.innerHTML = '<i class="fa fa-eye"></i> View Flier';
            }
        }
    });
});

</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const notificationList = document.getElementById('notificationList');

    notificationList.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-notification-btn')) {
            const button = e.target;
            const notificationId = button.dataset.id;

            if (confirm('Are you sure you want to delete this notification?')) {
                fetch('process/delete_notification.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: notificationId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Remove the notification from the DOM
                        button.closest('.list-group-item').remove();
                        alert('Notification deleted successfully.');
                    } else {
                        alert('Failed to delete notification. Please try again.');
                    }
                })
                .catch(error => console.error('Error deleting notification:', error));
            }
        }
    });
});


</script>

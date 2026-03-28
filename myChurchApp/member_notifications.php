
<?php
session_start();
require_once "memberguard.php";
require_once "classes/Member.php";
require_once 'classes/Notification.php';

$notification = new Notification();
$notifications = $notification->get_notifications($_SESSION['member_id']);

$member = new Member;
$member_data = $member->get_member_by_id($_SESSION['member_id']);

include_once "partials/header.php";
?>


    <div class="row" style="margin: 70px 0px 295px 0px">
        <?php 
            require_once "partials/menu.php";
        
        ?>
            <div class="col-md-9 p-3">
                <!-- Notification Modal -->
                <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="notificationList" class="list-group">
                                    <!-- Notifications will be dynamically loaded here -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>

        <!-- Footer -->
    <div class="row bg-dark text-white" 
        style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1040; height: 60px; line-height: 60px; margin-left: 280px;">
        <div class="col">
            <p class="text-center my-3"> &copy; 2024 Developed By Me</p>
        </div>
    </div>



</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const notificationList = document.getElementById('notificationList');
    const notificationBadge = document.getElementById('notificationBadge'); // Badge showing unread count

    function fetchNotifications() {
        fetch('process/get_notification.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const notifications = data.data;
                    const unreadCount = data.unread_count;
                    notificationBadge.textContent = unreadCount; // Update badge count

                    if (notifications.length > 0) {
                        notificationList.innerHTML = notifications.map(notification => `
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">${notification.message}</h5>
                                    <small>${new Date(notification.created_at).toLocaleString()}</small>
                                </div>
                                ${notification.flier ? 
                                    `<img src="../uploads/${notification.flier}" alt="Flier" class="img-fluid mt-2" style="max-width: 100%; height: auto;">` 
                                    : ''}
                                <p class="mb-1">${notification.message}</p>
                            </a>
                        `).join('');
                    } else {
                        notificationList.innerHTML = '<p class="text-muted">No notifications available.</p>';
                    }
                } else {
                    notificationList.innerHTML = '<p class="text-muted">Failed to load notifications.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                notificationList.innerHTML = '<p class="text-danger">An error occurred while loading notifications.</p>';
            });
    }

    // Fetch notifications when the modal is shown
    document.getElementById('notificationModal').addEventListener('show.bs.modal', fetchNotifications);
});

</script>






<div class="notification-dropdown-container">
    <button class="btn-notification" id="bannerNotifBtn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
    </button>
    <div class="notif-dropdown-menu" id="bannerNotifMenu">
        <div class="notif-dropdown-arrow"></div>
        <div class="notif-dropdown-header">
            <div class="notif-header-icon">
                <i class="fa-regular fa-bell"></i>
            </div>
            <div class="notif-header-text">
                <div class="notif-title">Notifications</div>
                <div class="notif-subtitle">You have 0 new notifications</div>
            </div>
        </div>
        <div class="notif-dropdown-body">
            No notifications
        </div>
        <div class="notif-dropdown-footer">
            <a href="{{ route('notifications') }}" class="notif-view-all">View all notifications <i class="fa-solid fa-chevron-right"></i></a>
            <div class="notif-pagination">
                <button class="notif-page-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="notif-page-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>

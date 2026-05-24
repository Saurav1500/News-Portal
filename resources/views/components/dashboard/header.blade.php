<header class="dashboard-header">
    <div class="header-left">
        <div class="header-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="खोज्नुहोस्..." id="headerSearch">
        </div>
    </div>
    <div class="header-right">
        <div class="header-date">
            <i class="far fa-calendar-alt"></i>
            <span id="currentDate"></span>
        </div>
        <div class="header-notifications">
            <i class="far fa-bell"></i>
            <span class="notification-dot"></span>
        </div>
        <div class="header-user">
            <div class="user-avatar-sm">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
    document.getElementById('currentDate').textContent = now.toLocaleDateString('ne-NP', options);
});
</script>

<style>
.dashboard-header {
    height: 72px;
    background: #ffffff;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px;
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-left {
    display: flex;
    align-items: center;
    flex: 1;
}

.header-search {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 10px;
    padding: 0 16px;
    border: 2px solid transparent;
    transition: all 0.2s;
    max-width: 400px;
    width: 100%;
}

.header-search:focus-within {
    border-color: #CD2737;
    background: white;
}

.header-search i {
    color: #6c757d;
    margin-right: 10px;
}

.header-search input {
    border: none;
    background: transparent;
    padding: 10px 0;
    font-size: 14px;
    font-family: 'Noto Sans Devanagari', sans-serif;
    outline: none;
    width: 100%;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 24px;
}

.header-date {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #6c757d;
    white-space: nowrap;
}

.header-notifications {
    position: relative;
    font-size: 20px;
    color: #6c757d;
    cursor: pointer;
}

.notification-dot {
    position: absolute;
    top: -2px;
    right: -4px;
    width: 8px;
    height: 8px;
    background: #CD2737;
    border-radius: 50%;
}

.header-user .user-avatar-sm {
    width: 40px;
    height: 40px;
    background: #CD2737;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 0 16px;
    }
    .header-date {
        display: none;
    }
    .header-search {
        max-width: 200px;
    }
}
</style>

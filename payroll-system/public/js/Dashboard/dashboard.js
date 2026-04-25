/**
 * Dashboard & Navigation Logic
 * VIA Architects Associates Payroll System
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Lucide Icons
    try {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    } catch (e) {
        console.error('Lucide failed to initialize:', e);
    }

    // 2. Sidebar Toggle Logic=============================================================================================
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    let isSidebarCollapsed = false;

    if (sidebar && sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            isSidebarCollapsed = !isSidebarCollapsed;
            if (isSidebarCollapsed) {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                sidebarTexts.forEach(text => text.style.display = 'none');
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                sidebarTexts.forEach(text => text.style.display = 'block');
            }
        });
    }
    //=======================================================================================================================

    // Profile Dropdown - Katung naay logout ug profile settings=============================================================
    const profileBtn = document.getElementById('profile-btn');
    const profileDropdown = document.getElementById('profile-dropdown');
    let isDropdownOpen = false;

    if (profileBtn && profileDropdown) {
        const closeDropdown = () => {
            profileDropdown.classList.remove('show');
            isDropdownOpen = false;
        };

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            isDropdownOpen = !isDropdownOpen;
            if (isDropdownOpen) {
                profileDropdown.classList.add('show');
            } else {
                closeDropdown();
            }
        });

        // Click again dropdown cosed
        window.addEventListener('click', () => {
            if (isDropdownOpen) closeDropdown();
        });
    }
    //========================================================================================================================
});

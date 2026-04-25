@extends('layouts.master')

@section('title', 'Account Settings - VIA Architects Associates')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="content-header" style="margin-bottom: 2rem;">
        <div>
            <h2 class="header-title">Account Settings</h2>
            <p class="header-subtitle">
                <span class="subtitle-dot"></span>
                Personalize your account and manage your security.
            </p>
        </div>
    </div>

    <!-- Professional Profile Banner -->
    <div class="settings-banner-card">
        <div class="banner-content">
            <div class="banner-avatar-section">
                <div class="profile-avatar-gradient h-24 w-24">
                    <div class="profile-avatar-inner" style="border-radius: 1.25rem;">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=3b82f6&color=ffffff" alt="User" class="h-full w-full object-cover">
                    </div>
                </div>
                <div class="banner-text">
                    <div class="flex-items-center gap-2">
                        <h3 class="text-2xl font-bold text-main">Ralph Administrator</h3>
                        <span class="badge-teal text-[10px] px-2 py-0.5 rounded-full uppercase tracking-tighter">Verified Account</span>
                    </div>
                    <p class="text-slate-400 text-sm mt-1">Administrator since October 2023</p>
                </div>
            </div>
            <div class="banner-actions">
                <button class="btn-secondary">
                    <i data-lucide="camera" class="h-4 w-4"></i>
                    Update Photo
                </button>
            </div>
        </div>

        <!-- Settings Navigation Tabs -->
        <div class="settings-tabs">
            <button class="tab-btn active" onclick="switchTab('general')">
                <i data-lucide="user" class="h-4 w-4"></i>
                General Info
            </button>
            <button class="tab-btn" onclick="switchTab('security')">
                <i data-lucide="shield-check" class="h-4 w-4"></i>
                Security
            </button>
            <button class="tab-btn" onclick="switchTab('notifications')">
                <i data-lucide="bell" class="h-4 w-4"></i>
                Notifications
            </button>
        </div>
    </div>

    <div class="settings-content">
        <!-- General Tab Content -->
        <div id="general-tab" class="tab-pane active">
            <div class="form-grid-settings">
                <div class="form-card">
                    <div class="form-section-header">
                        <h3>Personal Details</h3>
                    </div>
                    <form class="form-group-stack">
                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-input" value="Ralph">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-input" value="Administrator">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-input" value="ralph@via-architects.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-input" value="VIA-ADM-001" disabled>
                        </div>
                        <div class="form-actions-inline">
                            <button type="submit" class="btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="form-card">
                    <div class="form-section-header">
                        <h3>About Me</h3>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Biography</label>
                        <textarea class="form-textarea" placeholder="Write a short bio...">Head of Payroll and Human Resources at VIA Architects Associates.</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Tab Content -->
        <div id="security-tab" class="tab-pane">
            <div class="max-w-2xl">
                <div class="form-card">
                    <div class="form-section-header">
                        <h3>Update Password</h3>
                    </div>
                    <form class="form-group-stack">
                        <div class="form-group">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div class="form-actions-inline">
                            <button type="submit" class="btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function switchTab(tabId) {
        // Remove active class from all tabs and panes
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

        // Add active class to selected tab and pane
        event.currentTarget.classList.add('active');
        document.getElementById(tabId + '-tab').classList.add('active');
    }
</script>
@endsection

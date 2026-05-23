@extends('layouts.dashboard')

@section('dashboard_title', 'My Profile')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 16px;
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: bold;
        color: #0d6efd;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        border-radius: 8px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
    
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 1.5rem;
    }
</style>
@endpush

@section('dashboard_content')
<!-- Profile Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <div class="position-relative d-inline-block">
                        <div class="profile-avatar mx-auto" id="avatarDisplay">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <label for="avatarUpload" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 cursor-pointer" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                            <i class="bi bi-camera text-primary"></i>
                        </label>
                        <input type="file" id="avatarUpload" accept="image/*" style="display: none;" onchange="previewAvatar(event)">
                    </div>
                </div>
                <div class="col-md-10">
                    <h3 class="fw-bold mb-1">{{ auth()->user()->name ?? 'User Name' }}</h3>
                    <p class="mb-2 opacity-75">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                        <i class="bi bi-shield-check me-1"></i>{{ auth()->user()->roles->first()->name ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div>
                    <small class="text-muted">Member Since</small>
                    <h5 class="fw-bold mb-0">{{ auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'Jan 2024' }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <small class="text-muted">Account Status</small>
                    <h5 class="fw-bold mb-0">Active</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-info bg-opacity-10 text-info me-3">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <small class="text-muted">2FA Status</small>
                    <h5 class="fw-bold mb-0" id="twoFactorStatus">{{ auth()->user()->two_factor_enabled ?? false ? 'Enabled' : 'Disabled' }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <small class="text-muted">Last Login</small>
                    <h5 class="fw-bold mb-0">Today</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Settings -->
<div class="row">
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person me-2"></i>Personal Information
                    </h5>
                    <button class="btn btn-primary btn-sm" onclick="openEditProfileModal()">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <p class="mb-0 text-dark">{{ auth()->user()->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <p class="mb-0 text-dark">{{ auth()->user()->email ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <p class="mb-0 text-dark">+255 000 000 000</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <p class="mb-0 text-dark">{{ auth()->user()->roles->first()->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-shield-lock me-2"></i>Security Settings
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <p class="mb-0 text-muted">••••••••••••</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Changed</label>
                        <p class="mb-0 text-dark">30 days ago</p>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-outline-primary btn-sm me-2" onclick="openChangePasswordModal()">
                        <i class="bi bi-key me-1"></i>Change Password
                    </button>
                    <button class="btn btn-outline-info btn-sm" onclick="toggle2FA()">
                        <i class="bi bi-shield-lock me-1"></i>Toggle 2FA
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-lightning me-2"></i>Quick Actions
                </h5>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary text-start" onclick="downloadMyData()">
                        <i class="bi bi-download me-2"></i>Download My Data
                    </button>
                    <button class="btn btn-outline-primary text-start" onclick="viewActivityLog()">
                        <i class="bi bi-shield-check me-2"></i>View Activity Log
                    </button>
                    <button class="btn btn-outline-primary text-start" onclick="notificationSettings()">
                        <i class="bi bi-gear me-2"></i>Notification Settings
                    </button>
                    <button class="btn btn-outline-danger text-start" onclick="deleteAccount()">
                        <i class="bi bi-trash me-2"></i>Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editProfileModalLabel">
                    <i class="bi bi-pencil me-2"></i>Edit Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="editName" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="editEmail" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhone" placeholder="+255 000 000 000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveProfile()">
                    <i class="bi bi-check-lg me-2"></i>Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="changePasswordModalLabel">
                    <i class="bi bi-key me-2"></i>Change Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password *</label>
                        <input type="password" class="form-control" id="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password *</label>
                        <input type="password" class="form-control" id="newPassword" required minlength="8">
                        <small class="text-muted">Password must be at least 8 characters</small>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password *</label>
                        <input type="password" class="form-control" id="confirmPassword" required minlength="8">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="changePassword()">
                    <i class="bi bi-check-lg me-2"></i>Update Password
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let selectedAvatarFile = null;

function previewAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        selectedAvatarFile = file;
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatarDisplay = document.getElementById('avatarDisplay');
            avatarDisplay.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
        }
        reader.readAsDataURL(file);
        
        // Show save option
        Swal.fire({
            icon: 'success',
            title: 'Image Selected',
            text: 'Click "Save Avatar" to upload your new profile picture',
            showCancelButton: true,
            confirmButtonText: 'Save Avatar',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                uploadAvatar();
            } else {
                // Reset avatar
                resetAvatar();
            }
        });
    }
}

function uploadAvatar() {
    if (!selectedAvatarFile) {
        Swal.fire({
            icon: 'error',
            title: 'No Image Selected',
            text: 'Please select an image to upload',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    const formData = new FormData();
    formData.append('avatar', selectedAvatarFile);

    Swal.fire({
        title: 'Uploading...',
        text: 'Please wait while we upload your avatar',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/profile/avatar', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Avatar Updated!',
                text: 'Your profile picture has been updated successfully',
                confirmButtonColor: '#0d6efd'
            });
            selectedAvatarFile = null;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
            resetAvatar();
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while uploading avatar',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
        resetAvatar();
    });
}

function resetAvatar() {
    selectedAvatarFile = null;
    document.getElementById('avatarUpload').value = '';
    const avatarDisplay = document.getElementById('avatarDisplay');
    avatarDisplay.innerHTML = `{{ substr(auth()->user()->name ?? 'U', 0, 1) }}`;
}

function toggle2FA() {
    Swal.fire({
        title: 'Toggle 2FA',
        text: 'Are you sure you want to toggle Two-Factor Authentication?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Toggle',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Updating...',
                text: 'Please wait while we update your 2FA status',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('/profile/2fa', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const statusElement = document.getElementById('twoFactorStatus');
                    statusElement.textContent = data.data.two_factor_enabled ? 'Enabled' : 'Disabled';
                    
                    Swal.fire({
                        icon: 'success',
                        title: '2FA Updated!',
                        text: data.message,
                        confirmButtonColor: '#0d6efd'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#dc3545'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating 2FA status',
                    confirmButtonColor: '#dc3545'
                });
                console.error('Error:', error);
            });
        }
    });
}

function openEditProfileModal() {
    const modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
    modal.show();
}

function openChangePasswordModal() {
    const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
    modal.show();
}

function saveProfile() {
    const name = document.getElementById('editName').value;
    const email = document.getElementById('editEmail').value;
    const phone = document.getElementById('editPhone').value;

    if (!name || !email) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill in all required fields',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    Swal.fire({
        title: 'Saving...',
        text: 'Please wait while we save your profile',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('phone', phone);

    fetch('/profile', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
            modal.hide();

            // Update page
            location.reload();

            Swal.fire({
                icon: 'success',
                title: 'Profile Updated!',
                text: 'Your profile has been updated successfully',
                confirmButtonColor: '#0d6efd'
            });
        } else {
            let errorMessage = data.message;
            if (data.errors) {
                const errorList = Object.values(data.errors).flat().join('<br>');
                errorMessage = data.message + '<br><br>' + errorList;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: errorMessage,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating profile',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}

function changePassword() {
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (!currentPassword || !newPassword || !confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill in all fields',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    if (newPassword !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'New password and confirmation do not match',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    if (newPassword.length < 8) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Password must be at least 8 characters',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    Swal.fire({
        title: 'Updating Password...',
        text: 'Please wait while we update your password',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    const formData = new FormData();
    formData.append('current_password', currentPassword);
    formData.append('new_password', newPassword);
    formData.append('new_password_confirmation', confirmPassword);

    fetch('/profile/password', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'));
            modal.hide();

            // Reset form
            document.getElementById('changePasswordForm').reset();

            Swal.fire({
                icon: 'success',
                title: 'Password Updated!',
                text: 'Your password has been updated successfully',
                confirmButtonColor: '#0d6efd'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating password',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
}
</script>
@endpush
@endsection

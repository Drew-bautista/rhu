<style>
    /* Modern Dark Blue Gradient Sidebar Styles */
    .sidenav {
        background: linear-gradient(180deg, #0d1421 0%, #1a2332 50%, #1e2a3a 100%);
        box-shadow: 4px 0 20px rgba(13, 20, 33, 0.6);
        overflow-y: auto;
        overflow-x: hidden;
        backdrop-filter: blur(10px);
    }

    .sidenav::-webkit-scrollbar {
        width: 6px;
    }

    .sidenav::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidenav::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #2d4a6b, #3d5a7b);
        border-radius: 3px;
    }

    /* Header Styling */
    .sidenav h3 {
        background: linear-gradient(90deg, #4a6fa5, #5a7fb5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-top: 10px;
        padding-right: 40px;
        padding-left: 10px;
        text-shadow: 0 2px 4px rgba(74, 111, 165, 0.3);
    }

    .sidenav hr {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, #4a6fa5, transparent);
        opacity: 0.6;
    }

    /* Avatar Styling */
    .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid transparent;
        background: linear-gradient(45deg, #2d4a6b, #4a6fa5) border-box;
        padding: 3px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 20px rgba(45, 74, 107, 0.5);
    }

    /* User Info */
    .sidenav .text-light span {
        color: #f0f0f0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Dropdown Buttons Styling */
    .dropdownSmsprofile {
        margin: 8px 0;
    }

    .dropdown-btn {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 12px 16px;
        color: #f0f0f0 !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        text-decoration: none !important;
        font-size: 14px;
        font-weight: 500;
    }

    .dropdown-btn:hover {
        background: linear-gradient(135deg, rgba(45, 74, 107, 0.4), rgba(74, 111, 165, 0.3));
        border-color: #2d4a6b;
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(45, 74, 107, 0.4);
        color: #ffffff !important;
    }

    .dropdown-btn i {
        margin-right: 12px;
        font-size: 18px;
        color: #5a7fb5;
        transition: color 0.3s ease;
    }

    .dropdown-btn:hover i {
        color: #7a9fd5;
    }

    /* Dropdown Container */
    .dropdown-container {
        background: rgba(13, 20, 33, 0.3);
        border-radius: 0 0 10px 10px;
        margin-top: -5px;
        padding: 5px 0;
        border-left: 3px solid #2d4a6b;
        margin-left: 10px;
        display: none;
    }

    .dropdown-container.show {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-container .dropdown-btn {
        background: transparent;
        border: none;
        border-radius: 5px;
        padding: 10px 16px;
        margin: 2px 8px;
        font-size: 13px;
    }

    .dropdown-container .dropdown-btn:hover {
        background: linear-gradient(90deg, rgba(45, 74, 107, 0.3), transparent);
        transform: translateX(8px);
    }

    /* Close Button */
    .close-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: linear-gradient(135deg, #2d4a6b, #4a6fa5);
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(45, 74, 107, 0.4);
    }

    .close-btn:hover {
        transform: rotate(90deg);
        box-shadow: 0 3px 10px rgba(45, 74, 107, 0.6);
    }

    .close-btn i {
        color: white;
        font-size: 14px;
    }

    /* Active State */
    .dropdown-btn.active {
        background: linear-gradient(135deg, rgba(45, 74, 107, 0.4), rgba(74, 111, 165, 0.3));
        border-color: #2d4a6b;
        box-shadow: 0 4px 15px rgba(45, 74, 107, 0.4);
    }

    /* Container Adjustments */
    .sidenav .container {
        padding: 0 15px;
    }

    /* Smooth Scrollbar */
    .sidenav {
        scrollbar-width: thin;
        scrollbar-color: #2d4a6b rgba(255, 255, 255, 0.05);
    }

    /* Responsive adjustments */
    @media (max-height: 700px) {
        .dropdown-btn {
            padding: 10px 14px;
            font-size: 13px;
        }
        
        .avatar {
            width: 60px;
            height: 60px;
        }
    }
</style>

@php
    use Carbon\Carbon;
    $isExpired = Carbon::now()->gt('2025-10-31');
@endphp

<div class="sidenav" id="sidenav">
    <!-- Header for Clinic Department -->
    <button class="close-btn me-1" id="toggleButton">
        <span class="material-symbols-outlined">
            <i class="fas fa-times fa-xs"></i>
        </span>
    </button>
    <h3 class="text-center">Rural Health Unit Gabaldon</h3>
    <div class="d-flex justify-content-center">
        <hr class="text-white w-100">
    </div>
    <br>


    <!-- Role and Modules Based on User Type -->
    @php
        $role = auth()->user()->role;
    @endphp
    <!-- User Profile Info -->
    <div class="d-flex flex-column align-items-center w-100 text-light">
        @if ($role === 'nurse' || $role === 'doctor' || $role === 'medtech')
            <img src="{{ asset('img/avatar.jpeg') }}" alt="avatar" class="avatar">
        @elseif($role === 'teacher' || $role === 'student')
            <img src="{{ asset('img/profile.webp') }}" alt="avatar" class="avatar">
        @elseif($role === 'staff')
            <img src="{{ asset('img/avatar.jpeg') }}" alt="avatar" class="avatar">
        @endif
        <br>
        <span><b>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</b></span>
        {{-- <span class="user-mail">{{ Auth::user()->email }}</span> --}}


    </div>
    <div class="d-flex justify-content-center">
        <hr class="text-white w-100">
    </div>

    <div class="container">
        @if ($role === 'doctor')
            {{-- Doctor Menu - Based on Image 1 --}}
            <div class="mt-3">
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('doctor.index') }}" style="text-decoration: none;">
                        <i class='bx bx-grid-alt'></i> Dashboard
                    </a>
                </div>
                
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('admin.appointments.index') }}">
                        <i class='bx bx-calendar'></i> Monthly Appointments
                    </a>
                </div>
                
                {{-- Infirmary Dropdown --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-plus-medical'></i> Infirmary <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('admin.infirmary.index') }}">
                            <i class='bx bx-heart'></i> Health Assessment
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.dental-record.index') }}">
                            <i class='bx bx-tooth'></i> Dental Assessment
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.animal-bite.index') }}">
                            <i class='bx bxs-dog'></i> Animal Bite
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.tbdots.index') }}">
                            <i class='bx bx-plus-medical'></i> TB-DOTS
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.vaccines.index') }}">
                            <i class='bx bx-health'></i> Vaccines
                        </a>
                    </div>
                </div>

                {{-- Maternal & Child Health Dropdown --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-child'></i> Maternal & Child Health <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('admin.prenatal-record.index') }}">
                            <i class='bx bx-female'></i> Prenatal Record
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.newborn_screenings.index') }}">
                            <i class='bx bxs-baby-carriage'></i> Newborn Screening
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.family-planning.index') }}">
                            <i class='bx bx-heart-circle'></i> Family Planning
                        </a>
                    </div>
                </div>
                
                {{-- Laboratory Dropdown --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-test-tube'></i> Laboratory <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('admin.cbc-results.index') }}">
                            <i class='bx bx-vial'></i> CBC
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.urinalysis-results.index') }}">
                            <i class='bx bx-test-tube'></i> Urinalysis
                        </a>
                    </div>
                </div>
            </div>
        @elseif ($role === 'staff')
            {{-- Staff Menu - Based on Image 2 --}}
            <div class="mt-3">
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('staff.index') }}" style="text-decoration: none;">
                        <i class='bx bx-grid-alt'></i> Dashboard
                    </a>
                </div>

                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('staff.appointments.index') }}">
                        <i class='bx bx-calendar'></i> Monthly Appointments
                    </a>
                </div>
                
                {{-- Inventory Management --}}
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('staff.inventory.index') }}" style="text-decoration: none;">
                        <i class='bx bx-package'></i> Inventory Management
                    </a>
                </div>
                
                {{-- Report Generation --}}
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('staff.reports.index') }}" style="text-decoration: none;">
                        <i class='bx bx-file'></i> Report Generation
                    </a>
                </div>
                
                {{-- Services Offered Dropdown --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-user'></i> Services Offered <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('staff.infirmary.index') }}">
                            <i class='bx bx-heart'></i> Health Assessment
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.dental-record.index') }}">
                            <i class='bx bxs-tooth'></i> Dental Assessment
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.animal-bite.index') }}">
                            <i class='bx bxs-dog'></i> Animal Bite
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.tbdots.index') }}">
                            <i class='bx bx-plus-circle'></i> TB-DOTS
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.vaccines.index') }}">
                            <i class='bx bx-health'></i> Vaccines
                        </a>
                    </div>
                </div>

                {{-- Maternal & Child Health Dropdown --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-child'></i> Maternal & Child Health <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('staff.prenatal-record.index') }}">
                            <i class='bx bx-female'></i> Prenatal Record
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.newborn_screenings.index') }}">
                            <i class='bx bxs-baby-carriage'></i> Newborn Screening
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.family-planning.index') }}">
                            <i class='bx bx-heart-circle'></i> Family Planning
                        </a>
                    </div>
                </div>
                
                {{-- Laboratory --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-test-tube'></i> Laboratory <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('staff.cbc-results.index') }}">
                            <i class='bx bx-vial'></i> CBC
                        </a>
                        <a class="dropdown-btn" href="{{ route('staff.urinalysis-results.index') }}">
                            <i class='bx bx-test-tube'></i> Urinalysis
                        </a>
                    </div>
                </div>
            </div>

            {{-- NURSE --}}
        @elseif($role === 'nurse')
            <div class="mt-3">
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('nurse.index') }}" style="text-decoration: none;"><i
                            class='bx bx-grid-alt'></i> Dashboard</a>
                </div>

                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-home-smile'></i> Clinic <i class="fa fa-caret-down"
                            style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">

                        <a class="dropdown-btn" href="{{ route('nurse.patient.index') }}">Student Management</a>
                        <a class="dropdown-btn" href="#">Health Record</a>
                        <a class="dropdown-btn" href="{{ route('nurse.treatment.index') }}">Treatment Management</a>
                    </div>
                </div>

                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-user'></i> Medical<i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="#" style="text-decoration: none;"><span>Medical
                                input</span></a>

                    </div>
                </div>
            </div>
        @elseif($role === 'medtech')
            <div class="mt-3">
                {{-- Laboratory - Only section for Medtech --}}
                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-test-tube'></i> Laboratory <i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('admin.cbc-results.index') }}">
                            <i class='bx bx-vial'></i> CBC
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.urinalysis-results.index') }}">
                            <i class='bx bx-droplet'></i> Urinalysis
                        </a>
                        <a class="dropdown-btn" href="{{ route('admin.newborn_screenings.index') }}">
                            <i class='bx bxs-baby-carriage'></i> Newborn Screening
                        </a>
                    </div>
                </div>
            </div>
        @elseif($role === 'head')
            <div class="mt-3">
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('head.index') }}" style="text-decoration: none;"><i
                            class='bx bx-grid-alt'></i> Dashboard</a>
                </div>

                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('head.confidential-result.index') }}"
                        style="text-decoration: none;"><span>Confidential Result</span></a>
                </div>
            </div>
        @elseif($role === 'teacher' || $role === 'student')
            <div class="mt-3">
                <div class="dropdownSmsprofile">
                    <a class="dropdown-btn" href="{{ route('patient.index') }}" style="text-decoration: none;"><i
                            class='bx bx-grid-alt'></i> Dashboard</a>
                </div>

                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-home-smile'></i> Clinic <i class="fa fa-caret-down"
                            style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('patient.info') }}"
                            style="text-decoration: none;"><span>Student
                                Info</span></a>
                        <a class="dropdown-btn" href="{{ route('patient.health-record') }}"
                            style="text-decoration: none;"><span>My Health Record</span></a>
                        <a class="dropdown-btn" href="{{ route('patient.treatment') }}"
                            style="text-decoration: none;"><span>Treatment</span></a>
                    </div>
                </div>

                <div class="dropdownSmsprofile">
                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                        <i class='bx bx-user'></i> Medical<i class="fa fa-caret-down" style="float: right;"></i>
                    </button>
                    <div class="dropdown-container">
                        <a class="dropdown-btn" href="{{ route('patient.medical-result') }}"
                            style="text-decoration: none;"><span>Medical result</span></a>

                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<script>
    // Enhanced dropdown functionality
    function toggleDropdown(button) {
        const container = button.nextElementSibling;
        const icon = button.querySelector('.fa-caret-down');
        
        // Close all other dropdowns
        document.querySelectorAll('.dropdown-container').forEach(el => {
            if (el !== container) {
                el.classList.remove('show');
                el.style.display = 'none';
                const otherIcon = el.previousElementSibling.querySelector('.fa-caret-down');
                if (otherIcon) {
                    otherIcon.style.transform = 'rotate(0deg)';
                }
            }
        });
        
        // Toggle current dropdown
        if (container.style.display === 'block') {
            container.style.display = 'none';
            container.classList.remove('show');
            if (icon) {
                icon.style.transform = 'rotate(0deg)';
            }
            button.classList.remove('active');
        } else {
            container.style.display = 'block';
            container.classList.add('show');
            if (icon) {
                icon.style.transform = 'rotate(180deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
            button.classList.add('active');
        }
    }

    // Add active state to current page
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const links = document.querySelectorAll('.dropdown-btn');
        
        links.forEach(link => {
            if (link.href && link.href.includes(currentPath)) {
                link.classList.add('active');
                // If it's inside a dropdown, open the parent dropdown
                const parentContainer = link.closest('.dropdown-container');
                if (parentContainer) {
                    parentContainer.style.display = 'block';
                    parentContainer.classList.add('show');
                    const parentButton = parentContainer.previousElementSibling;
                    if (parentButton) {
                        parentButton.classList.add('active');
                        const icon = parentButton.querySelector('.fa-caret-down');
                        if (icon) {
                            icon.style.transform = 'rotate(180deg)';
                        }
                    }
                }
            }
        });
    });
</script>

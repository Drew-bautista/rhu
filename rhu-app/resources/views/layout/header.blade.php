<div class="main" id="mainContent" style="display: flex; flex-direction: column; ">
    <div style=" justify-content: space-between; align-items: center;">
        <button class="btn" id="toggleButton1">&nbsp; ☰ &nbsp;</button>

        <div style="display: flex; align-items: center; float:right">
            @php
                $role = auth()->user()->role;
            @endphp

            {{-- @if ($role === 'nurse' || $role === 'doctor')      
                <a class="text-sm" href="#" style="margin-right: 15px;">Submissions</a>
            @elseif($role === 'teacher' || $role === 'student')
                <!-- <a href="#" style="margin-right: 15px;">Create Form</a> -->
            @endif --}}
            <button type="button" class="btn-logout" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
    </div>
    <hr>




    @include('auth.logoutConfirmationModal')
    <style>
        .btn-logout {
            background: none;
            border: none;
            color: #f8595b;
            cursor: pointer;
            padding: 7px 0;
            font-size: 18px;
        }
    </style>

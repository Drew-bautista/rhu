<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>RHU Gabaldon</title>
    <link rel="icon" type="image/png" href="{{ asset('img/medic_logo.png') }}">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" type="text/css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=close" />
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }

        .sidenav {
            height: 100%;
            width: 275px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #007bff;
            padding-top: 20px;
            transition: transform 0.3s ease;
            overflow-y: auto;
            /* Add scroll if content overflows */
            z-index: 1;
        }

        .sidenav.hidden {
            transform: translateX(-100%);
        }

        .sidenav a {
            padding: 10px;
            text-decoration: none;
            font-size: 1rem;
            color: white;
            display: block;
            border-radius: 4px;
            margin-bottom: 5px;
        }



        .main {
            margin-left: 265px;
            padding: 20px;
            transition: margin-left 0.3s ease;
            flex-grow: 1;
            /* Allow main content to fill space */
        }

        @media (max-width: 565px) {
            .main {
                margin-left: 0;
            }

            .sidenav {
                transform: translateX(-100%);
            }

            .sidenav.hidden {
                transform: translateX(0%);
            }

            #toggleButton {
                display: block;
            }
        }


        .main.shift {
            margin-left: 10px;
        }

        .box {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-bottom: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        hr {
            margin: 20px 0;
        }

        #toggleButton1 {
            background-color: #495057;
            border: none;
            color: white;
            margin-right: 15px;
            position: absolute;
            left: 1.8em;
        }

        #toggleButton1:hover {
            background-color: #6c757d;
        }

        .avatar-container {
            margin-bottom: 15px;
            text-align: center;
            /* Center align avatar */
        }

        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .username {
            font-weight: bold;
            margin: 10px 0 0;
            color: white;
        }

        .email {
            color: rgb(218, 213, 213);
            margin: 0;
        }

        .nav-links {
            list-style-type: none;
            padding: 0;
        }

        .nav-links li {
            margin: 10px 0;
        }

        .nav-links a i {
            margin-right: 10px;
        }

        .dropdown-container {
            background-color: #122f4bdd;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }

        .role {
            color: white;
            display: block;
            text-align: left;
            padding: 10px 20px;
            font-size: 20px;
        }

        .dropdown-a {
            border-radius: 4px;
        }

        .dropdown-a:hover {
            background-color: #405870;
            color: white;
        }

        .dropdownSmsprofile {
            margin-bottom: 15px;
            background-color: #122f4bdd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-btn {
            width: 100%;
            text-align: left;
            padding: 10px;
            cursor: pointer;
            font-size: 1rem;
            background-color: #122f4bdd;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .dropdown-btn:hover {
            background-color: #405870;
        }

        span {
            font-size: 16px;
        }

        .close-btn {
            font-size: 26px;
            font-weight: bold;
            color: ;
            cursor: pointer;
            position: absolute;
            top: 4px;
            right: 6px;
            background: none;
            border: none;
            color: #fff;
            margin-top: .3em;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .close-btn:hover {
            color: #ff0000;
        }

        .close-btn:active {
            transform: scale(0.9);
        }
        
        /* Watermark Styles */
        .watermark-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9998;
            overflow: hidden;
        }
        
        .watermark-text {
            position: absolute;
            color: rgba(255, 0, 0, 0.08);
            font-size: 20px;
            font-weight: bold;
            transform: rotate(-45deg);
            user-select: none;
            font-family: Arial, sans-serif;
            letter-spacing: 2px;
        }
        
        .watermark-corner {
            position: fixed;
            color: rgba(255, 0, 0, 0.15);
            font-size: 11px;
            font-weight: 600;
            user-select: none;
            z-index: 9997;
            font-family: monospace;
            text-shadow: 0 0 2px rgba(255, 0, 0, 0.1);
        }
        
        .watermark-corner.top-left {
            top: 10px;
            left: 10px;
        }
        
        .watermark-corner.top-right {
            top: 10px;
            right: 10px;
        }
        
        .watermark-corner.bottom-left {
            bottom: 10px;
            left: 10px;
        }
        
        .watermark-corner.bottom-right {
            bottom: 10px;
            right: 10px;
        }
        
        .floating-watermark {
            position: fixed;
            color: rgba(255, 0, 0, 0.06);
            font-size: 14px;
            font-weight: bold;
            animation: float-watermark 20s infinite linear;
            pointer-events: none;
            z-index: 9996;
            user-select: none;
        }
        
        @keyframes float-watermark {
            0% {
                transform: translateX(-100px) translateY(100vh) rotate(-45deg);
            }
            100% {
                transform: translateX(calc(100vw + 100px)) translateY(-100px) rotate(-45deg);
            }
        }
        
        @media print {
            .watermark-print {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(-45deg);
                color: rgba(255, 0, 0, 0.1);
                font-size: 72px;
                font-weight: bold;
                z-index: 9999;
            }
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
        use App\Services\SystemHealthService;
        
        $daysRemaining = 999; // Default safe value
        
        try {
            // Check system expiration
            $expirationDate = Carbon::parse('2025-10-31 23:59:59');
            $now = Carbon::now();
            $daysRemaining = $now->diffInDays($expirationDate, false);
            
            // Perform system check
            SystemHealthService::verifySystemIntegrity();
        } catch (\Exception $e) {
            // System has expired or error occurred
            $daysRemaining = -1;
        }
    @endphp
    
    {{-- System Warning Messages --}}
    @if($daysRemaining <= 7 && $daysRemaining > 0)
        <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
             style="z-index: 9999; max-width: 600px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);" role="alert">
            <strong>⚠️ System Notice:</strong> System maintenance required in {{ $daysRemaining }} days. Please contact your administrator.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif($daysRemaining <= 0)
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
             style="z-index: 9999; max-width: 600px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);" role="alert">
            <strong>❌ Critical Error:</strong> System license has expired. Contact administrator immediately.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('system_alert'))
        <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
             style="z-index: 9999; max-width: 600px;" role="alert">
            {{ session('system_alert') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    {{-- Current Demo Watermarks - Always visible --}}
    {{-- Clear Corner Watermarks --}}
    <div class="watermark-corner top-right" style="color: rgba(255, 0, 0, 0.25); font-size: 13px; font-weight: bold; text-shadow: 0 0 2px rgba(255,255,255,0.5);">NOT PAID</div>
    <div class="watermark-corner bottom-left" style="color: rgba(255, 0, 0, 0.25); font-size: 13px; font-weight: bold; text-shadow: 0 0 2px rgba(255,255,255,0.5);">TRIAL</div>
    <div class="watermark-corner top-left" style="color: rgba(255, 0, 0, 0.2); font-size: 12px; font-weight: bold;">DEMO</div>
    <div class="watermark-corner bottom-right" style="color: rgba(255, 0, 0, 0.2); font-size: 12px; font-weight: bold;">UNPAID</div>
    
    {{-- Clear Grid Watermarks --}}
    <div class="watermark-container">
        @for($i = 0; $i < 5; $i++)
            @for($j = 0; $j < 4; $j++)
                <span class="watermark-text" style="top: {{ $j * 200 + 120 }}px; left: {{ $i * 280 + 150 }}px; color: rgba(255, 0, 0, 0.08); font-size: 18px; font-weight: bold; text-shadow: 0 0 1px rgba(255,255,255,0.3);">NOT PAID</span>
            @endfor
        @endfor
    </div>
    
    {{-- Watermarks - Show MORE after expiration --}}
    @if($daysRemaining <= 0 || Carbon::now()->gt('2025-10-31'))
        {{-- Additional Heavy Watermarks After Expiration --}}
        <div class="watermark-container">
            @for($i = 0; $i < 8; $i++)
                @for($j = 0; $j < 6; $j++)
                    <span class="watermark-text" style="top: {{ $j * 150 + 50 }}px; left: {{ $i * 200 + 50 }}px;">NOT PAID</span>
                @endfor
            @endfor
        </div>
        
        {{-- Heavy Corner Watermarks --}}
        <div class="watermark-corner top-left" style="color: rgba(255, 0, 0, 0.25); font-size: 14px;">EXPIRED</div>
        <div class="watermark-corner top-right" style="color: rgba(255, 0, 0, 0.25); font-size: 14px;">NOT PAID</div>
        <div class="watermark-corner bottom-left" style="color: rgba(255, 0, 0, 0.25); font-size: 14px;">UNPAID</div>
        <div class="watermark-corner bottom-right" style="color: rgba(255, 0, 0, 0.25); font-size: 14px;">EXPIRED</div>
        
        {{-- Floating Watermarks --}}
        <div class="floating-watermark" style="top: 20%;">NOT PAID</div>
        <div class="floating-watermark" style="top: 40%; animation-delay: 5s;">UNPAID</div>
        <div class="floating-watermark" style="top: 60%; animation-delay: 10s;">NOT PAID</div>
        <div class="floating-watermark" style="top: 80%; animation-delay: 15s;">UNPAID</div>
        
        {{-- Print Watermark --}}
        <div class="watermark-print d-none">SYSTEM EXPIRED</div>
    @endif

    @include('layout.sidebar')

    @include('layout.header')

    @yield('content')

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Watermark System -->
    <script src="{{ asset('js/watermark.js') }}"></script>
    @include('flash_message')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // SideNav
        const toggleButton = document.getElementById('toggleButton');
        const toggleButton1 = document.getElementById('toggleButton1');
        const sidenav = document.getElementById('sidenav');
        const mainContent = document.getElementById('mainContent');

        toggleButton.addEventListener('click', () => {
            sidenav.classList.toggle('hidden');
            mainContent.classList.toggle('shift');
        });

        toggleButton1.addEventListener('click', () => {
            sidenav.classList.toggle('hidden');
            mainContent.classList.toggle('shift');
        });

        // Dropdown
        function toggleDropdown(button) {
            button.classList.toggle("active");
            var dropdownContent = button.nextElementSibling;
            dropdownContent.style.display = (dropdownContent.style.display === "block") ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-container");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        };
    </script>
</body>

</html>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admdashboard.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- PAGE HEADER -->
    @include('partials._adminpageheader')
    <x-alert />

    <div class="ctnmain">
        <!-- USER NAME CONTAINER -->
        <div class="row d-flex align-items-center text-success fw-bold h2">
            <div class="col-auto">Welcome,</div>
            <div class="col-auto">{{ $worker->name }}</div>
        </div>
        <div class="groupB">
            <span class="groupB1">
                <span class="label">Total Users</span>
                <span class="data" id="outusers">{{ $totalusers }}</span>
            </span>
            <a class="groupB1" href="{{ route('users-scholar') }}">
                <span class="label">Total Scholars</span>
                <span class="data" id="outscholars">{{ $totalscholar }}</span>
            </a>
            <a class="groupB1" href="{{ route('users-staff') }}">
                <span class="label">Total Staff</span>
                <span class="data" id="outstaff">{{ $totalstaff }}</span>
            </a>
            <a class="groupB1" href="{{ route('users-applicant') }}">
                <span class="label">Total Applicants</span>
                <span class="data" id="outapplicants">{{ $totalapplicant }}</span>
            </a>
        </div>
    </div>

    <script src="{{ asset('js/headercontrol.js') }}"></script>
</body>

</html>

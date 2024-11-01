<!DOCTYPE html>

<html lang="en">

<head>
    <title>Scholars Overview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scholars.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <!-- PAGE HEADER -->
    @include('partials._pageheader')

    <div class="ctnmain">
        <span class="pagetitle">Scholars Overview</span>
        <div class="groupA">
            <div class="groupA1">
                <span id="lbltotalscholars" class="label">Total of Scholars</span>
                <span id="totalscholars" class="data">{{ $totalscholars }}</span>
            </div>
            <div class="groupA1">
                <span id="lbltotalscholars" class="label">Total of New Scholars</span>
                <span id="totalnewscholars" class="data">{{ $totalnewscholars }}</span>
            </div>
            <div class="groupA1">
                <span id="lbltotalscholars" class="label">Scholars per Area</span>
                <canvas id="scholarsperarea" height="250px"></canvas>
            </div>
            {{-- <div class="groupA1">
                <span id="lbltotalscholars" class="label">Scholars Admitted per Area</span>
                <span id="outtotalscholars" class="data">0</span>
            </div> --}}
            {{-- <div class="groupA1">
                <span id="lbltotalscholars" class="label">Scholars per School</span>
                <span id="outtotalscholars" class="data">0</span>
            </div> --}}
            <div class="groupA1">
                <span id="lbltotalscholars" class="label">Scholars per School Level</span>
                <canvas id="scholarsperschoolevel" height="250px"></canvas>
            </div>
        </div>
        <div class="divider"></div>
        <span class="pagetitle">List of Scholars</span>
        <span class="lblinstruction">Select which list to view:</span>
        <div class="groupB">
            <a href="{{ route('scholars-college') }}" class="groupB1">
                College
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="{{ route('scholars-highschool') }}" class="groupB1">
                High School
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="{{ route('scholars-elementary') }}" class="groupB1">
                Elementary
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <script src="{{ asset('js/headercontrol.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Convert the PHP array to a JavaScript object for scholars per area
            const scholarsperarea = @json($scholarsperarea);

            // Prepare data for the chart
            const areaLabels = Object.keys(scholarsperarea); // Areas
            const areaData = Object.values(scholarsperarea); // Count per area

            // Add 0 to the end of the data array
            areaData.push(0);

            new Chart("scholarsperarea", {
                type: "bar",
                data: {
                    labels: areaLabels,
                    datasets: [{
                        backgroundColor: ['#1a5319', '#599f58', '#9de19c', '#a5d6a7', '#4caf50'],
                        data: areaData
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true // Ensure the y-axis starts from 0
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Convert the PHP array to a JavaScript object for levels
            const scholarsperlevel = @json($scholarsperlevel);

            // Prepare data for the chart
            const levelLabels = Object.keys(scholarsperlevel); // Education levels
            const levelData = Object.values(scholarsperlevel); // Count per level

            // Add 0 to the end of the data array
            levelData.push(0);

            new Chart("scholarsperschoolevel", {
                type: "bar",
                data: {
                    labels: levelLabels,
                    datasets: [{
                        backgroundColor: "#1a5319",
                        data: levelData
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true // Ensure the y-axis starts from 0
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>User | Applicants</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/table.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admstaff.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- PAGE HEADER -->
    @include('partials._adminpageheader')
    <x-alert />
    <div class="ctnmain">
        <span class="text-success fw-bold h2">Manage Applicant Accounts</span>
        <div class="groupA">
            <form action="#" class="searchbar">
                <input type="search" placeholder="Search" id="insearch" required>
                <button type="submit" id="btnsearch">
                    <i class="fas fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <div style="min-height: 50vh" class="ctntable table-responsive">
            <table class="table table-bordered" id="tblpenalty">
                <thead>
                    <tr>
                        <th class="text-center align-middle">#</th>
                        <th class="text-center align-middle">Case Code</th>
                        <th class="text-center align-middle">Email</th>
                        <th class="text-center align-middle">Status</th>
                        <th class="text-center align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $index => $applicant)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-center align-middle">{{ $applicant->casecode }}</td>
                            <td class="text-center align-middle">{{ $applicant->email }}</td>
                            <td class="text-center align-middle">{{ $applicant->accountstatus }}</td>
                            <td class="text-center align-middle">
                                <!-- Activate/Deactivate buttons -->
                                @if ($applicant->accountstatus == 'Inactive')
                                    <form method="POST" action="{{ route('applicant.activate', $applicant->apid) }}"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Activate</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('applicant.deactivate', $applicant->apid) }}"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Deactivate</button>
                                    </form>
                                @endif
                                <!-- View button -->
                                <a href="{{ route('applicant.view', $applicant->apid) }}"
                                    class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="d-flex justify-content-center mt-3">
            {{ $applicants->links('pagination::bootstrap-4') }}
        </div> --}}
    </div>

    <script src="{{ asset('js/headercontrol.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Request</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/special.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partial.css') }}">
</head>

<body>
    <!-- Include Sidebar -->
    @include('partials._sidebar')

    <!-- Include Navbar -->
    @include('partials._navbar')
    <x-alert />

    <div class="ctn-main">
        <a href="{{ route('scspecial') }}" class="goback">&lt Go back</a>

        <div class="request-view">
            <div class="row">
                @php
                    $statusClasses = [
                        'Pending' => 'bg-warning',
                        'Accepted' => 'bg-success',
                        'Completed' => 'bg-success',
                        'Rejected' => 'bg-danger',
                    ];

                    $statusClass = $statusClasses[$data['requestStatus']] ?? 'bg-secondary text-white';
                @endphp
                <div class="col-auto" style="margin-left: auto">
                    <span class="h5 card px-4 py-2 {{ $statusClass }} text-white fw-bold">
                        {{ $data['requestStatus'] }}</span>
                </div>
            </div>

            <div class="card bg-light p-5 rounded border border-success">
                <div class="row mb-2">
                    <span class="col-12 py-2 h4 fw-bold header">{{ $form->formname }}</span>
                </div>
                {{-- REQUESTOR INFO --}}
                <div class="row mb-3">
                    <div class="row fw-bold h5 subheader">Requestor Info:</div>
                    <div class="row">
                        <div class="col-md-4 label">Name</div>
                        <div class="col-md-8 data">{{ $scholar->basicInfo->scFirstname }}
                            {{ $scholar->basicInfo->scLastname }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 label">Area</div>
                        <div class="col-md-8 data">{{ $scholar->scholarshipinfo->area }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 label">Year Level</div>
                        <div class="col-md-8 data">{{ $scholar->education->scYearGrade }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 label">Course/Strand/Section</div>
                        <div class="col-md-8 data">{{ $scholar->education->scCourseStrandSec }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 label">School</div>
                        <div class="col-md-8 data">{{ $scholar->education->scSchoolName }}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="row fw-bold h5 subheader">Request Detail:</div>
                    <div class="row">
                        <div class="col-md-4 label">Request Type</div>
                        <div class="col-md-8 data">{{ $data['requestType'] }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 label">Date of Request</div>
                        <div class="col-md-8 data">{{ \Carbon\Carbon::parse($data['requestDate'])->format('F j, Y') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 label">Date of Release</div>
                        <div class="col-md-8 data">
                            {{ $data['releaseDate'] ? \Carbon\Carbon::parse($data['releaseDate'])->format('F j, Y') : 'Not Set Yet' }}
                        </div>
                    </div>
                    @foreach ($fields as $field)
                        <div class="row align-items-center">
                            <div class="col-md-4 label">{{ $field->fieldname }}</div>
                            <div class="col-md-8 data">
                                @if ($field->fieldtype == 'file')
                                    @php
                                        $filePath = $data[$field->fieldname];
                                        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                        $modalId = 'fileModal-' . $field->fieldname; // Unique modal ID for each file
                                    @endphp

                                    <!-- Button to trigger the modal -->
                                    @if ($fileExtension == 'zip')
                                        The data is in a ZIP file. Please <a href="{{ url('storage/' . $filePath) }}"
                                            download class="link link-success">download it here</a>.
                                    @else
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#{{ $field->id }}">
                                            View File
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ $field->id }}" tabindex="-1"
                                        aria-labelledby="{{ $field->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title" id="{{ $field->id }}Label">
                                                        {{ $field->fieldname }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($fileExtension == 'pdf')
                                                        <iframe src="{{ asset('storage/' . $filePath) }}#zoom=100"
                                                            width="100%" height="500px">
                                                            Your browser does not support iframes. Please download the
                                                            PDF file
                                                            <a href="{{ url('storage/' . $filePath) }}" download
                                                                class="link link-success">here</a>.
                                                        </iframe>
                                                    @elseif ($fileExtension != 'pdf' || $fileExtension != 'zip')
                                                        <img src="{{ asset('storage/' . $filePath) }}" width="100%"
                                                            height="auto" alt="{{ $field->fieldname }}">
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{ $data[$field->fieldname] }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mb-3">
                    <div class="row fw-bold h5 subheader">Required Documents:</div>
                    @foreach ($files as $file)
                        <div class="row">
                            <div class="col-12 label text-center">{{ $file->filename }}</div>
                        </div>
                        <div class="row">
                            <iframe src="{{ asset('storage/' . $data[$file->filename]) }}#zoom=100" width="100%"
                                height="700px">
                                Your browser does not support iframes. Please download the PDF file
                                <a href="{{ url('storage/' . $data[$file->filename]) }}" class="link link-success"
                                    download>here</a>.
                            </iframe>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/scholar.js') }}"></script>
</body>

</html>

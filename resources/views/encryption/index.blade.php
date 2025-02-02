@extends('layouts.private')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session()->has('success') && session()->get('success'))
            <div id="success_container" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('err') && session()->get('err'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('err') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="row mb-3">
                <h1 class="col-lg-6 text-gray-800">Bill of Lading</h1>
                <div class="col-lg-6 text-right">
                    <a href="/report/encryption/create" class="btn btn-primary btn-icon">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Enkripsi Data Laporan</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Data Terenkripsi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File Name</th>
                                <th>Ukuran Data Laporan</th>
                                <th>Ukuran Data Laporan Terenkripsi</th>
                                <th>Waktu Enkripsi</th>
                                <th>Uploaded Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $report)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <a href="{{ route('download.file', $report->id) }}">
                                            {{ explode('.', $report->filename)[0] }}
                                        </a>
                                    </td>
                                    <th>{{ $report->original_size }}</th>
                                    <th>{{ $report->encrypt_size }}</th>
                                    <th>{{ $report->encryption_time }} Detik</th>
                                    <td>{{ $report->created_at }}</td>
                                    <td>
                                        <div class="row pl-4">
                                            <a class="btn btn-primary btn-circle"
                                                href="{{ route('download.file', $report->id) }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            &nbsp; &nbsp;
                                            <a class="btn btn-danger btn-circle" data-toggle="modal"
                                                data-bs-target="#smallButton"
                                                data-attr="/report/encryption/delete/{{ $report->id }}"
                                                data-target="#smallModal" id="smallButton">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
    </div>
    <!-- /.container-fluid -->
    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript_content')
    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            console.log('ini bro', href);
            $.ajax({
                url: href,
                beforeSend: function() {
                    // $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    // $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    // $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>

    <script>
        // display a modal (small modal)
        $(document).on('click', '#cancelButton', function(event) {
            event.preventDefault();
            $('#smallModal').modal("hide");
            $('#smallBody').html(result).hide();
        });

        setTimeout(function() {
            document.getElementById('success_container').style.display = 'none';
        }, 3000);
    </script>
@endsection

@extends('layouts.private')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row mb-3">
                <h1 class="col-lg-6 text-gray-800">List Data Laporan</h1>
                <div class="col-lg-6 text-right">
                    <a href="/report/add" class="btn btn-primary btn-icon">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data Kriteria</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bill of Landing</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File Name</th>
                                <th>Uploaded Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="">BOFL232771882367889.pdf</a></td>
                                <td>23 Januari 2024</td>
                                <td>
                                    <a class="btn btn-danger btn-circle" data-toggle="modal" data-bs-target="#smallButton"
                                        data-attr="*" data-target="#smallModal" id="smallButton">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="">BOFL232771842341233.pdf</a></td>
                                <td>23 Mei 2024</td>
                                <td>
                                    <a class="btn btn-danger btn-circle" data-toggle="modal" data-bs-target="#smallButton"
                                        data-attr="*" data-target="#smallModal" id="smallButton">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
    </div>
    <!-- /.container-fluid -->
@endsection

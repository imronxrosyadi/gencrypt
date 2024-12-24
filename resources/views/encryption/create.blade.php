@extends('layouts/private')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-6 mb-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Bill of Landing</h6>
                </div>
                <div class="card-body">
                    <main class="form-master">
                        <form action="/report/encryption" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form">
                                <label for="file" class="form-label">Upload File Report</label>
                                <input class="form-control" type="file" id="file" name="file"
                                    value="{{ old('file') }}" required>
                                <label for="file" class="form-label mt-3">Kata Sandi</label>
                                <input class="form-control" type="text" id="key" name="key"
                                    value="{{ old('key') }}" required>
                            </div>
                            <div class="col text-right">
                                <a href="/report/encryption" class="w-30 btn btn-md btn-danger mt-3">Batal</a>
                                <button class="w-30 btn btn-md btn-primary mt-3" type="submit">Simpan</button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection

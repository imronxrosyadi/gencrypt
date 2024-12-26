@extends('layouts/private')

@section('container')
    <div class="row justify-content-center">
        @if (session()->has('err') && session()->get('err'))
            <div id="err_container" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('err') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="col-lg-6 mb-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Download File</h6>
                </div>
                <div class="card-body">
                    <main class="form-master">
                        <form action="/report/decryption" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form">
                                <label for="file" class="form-label">Download File Report</label>
                                <input class="form-control" type="file" id="file" name="file"
                                    value="{{ old('file') }}" required>
                                <label for="file" class="form-label mt-3">Kata Sandi</label>
                                <input class="form-control" type="text" id="key" name="key"
                                    value="{{ old('key') }}" required>
                            </div>
                            <div class="col text-right">
                                <a href="/report/decryption" class="w-30 btn btn-md btn-danger mt-3">Batal</a>
                                <button class="w-30 btn btn-md btn-primary mt-3" type="submit">Simpan</button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript_content')
    <script>
        setTimeout(function() {
            document.getElementById('err_container').style.display = 'none';
        }, 3000);
    </script>
@endsection

@extends('layouts/private')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-6 mb-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Bill of Lading</h6>
                </div>
                <div class="card-body">
                    <main class="form-master">
                        <form action="/report/encryption" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form">
                                {{-- <div class="input-group"> --}}
                                <label for="file" class="form-label">Upload File Report</label>
                                <input class="form-control" type="file" id="file" name="file"
                                    value="{{ old('file') }}" required>
                                {{-- </div> --}}
                                <label for="file" class="form-label mt-3">Kata Sandi</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="key" name="key"
                                        value="{{ old('key') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
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

@section('javascript_content')
    <script>
        function password_show_hide() {
            var x = document.getElementById("key");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endsection

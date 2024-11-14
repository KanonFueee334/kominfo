@extends('layout.app')

@section('title', 'Ubah Password')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                
                <div class="card-content">
                    <div class="card-body">

                        <!-- Display success message -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Display error message -->
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form class="form form-horizontal" method="post" action="{{ route('set.password.save') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Password Lama</label>
                                    </div>

                                    <div class="col-md-10 form-group">
                                        <input type="password" id="old-password" class="form-control"
                                        name="old-password" placeholder="Password Lama">
                                        @error('old-password')
                                        <div style="color: red;">* {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label>Password Baru</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <input type="password" id="new-password-1" class="form-control"
                                        name="password" placeholder="Password Baru">
                                        @error('password')
                                        <div style="color: red;">* {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label>Konfirmasi Password Baru</label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <input type="password" id="new-password-2" class="form-control"
                                        name="password_confirmation" placeholder="Konfirmasi Password Baru">
                                        @error('password_confirmation')
                                        <div style="color: red;">* {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit"
                                        class="btn btn-primary me-1 mb-1">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Partner</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ url('/admin/partners') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Partner</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo URL</label>
                    <input type="text" name="logo_url" class="form-control" required>
                    @error('logo_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/admin/partners" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
@extends('layouts.layouts.admin.app')

@section('content')
<div class="container-fluid">
    <h2>Edit Pelanggan</h2>

    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $pelanggan->first_name) }}" required>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $pelanggan->last_name) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $pelanggan->birthday) }}">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label>Gender</label>
                <select name="gender" class="form-select">
                    <option value="">-- Pilih Gender --</option>
                    <option value="Male" {{ old('gender', $pelanggan->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $pelanggan->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $pelanggan->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $pelanggan->phone) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
@endsection
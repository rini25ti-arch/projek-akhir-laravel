@extends('layouts.layouts.admin.app')

@section('content')
<div class="container-fluid">
    <h2>Data Pelanggan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

        <form method="GET" action="{{ route('pelanggan.index') }}">
            <div class="row">
                <div class="col-md-3">
    <select name="gender" onchange="this.form.submit()" class="form-select">
        <option value="">All Genders</option>
        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div></div>

                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" id="exampleInputIconRight" value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                        <button type="submit" class="input-group-text" id="basic-addon2">
                            <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-secondary" id="clear-search">Clear</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $item)
                <tr>
                    <td>{{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->birthday }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Data masih kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pelanggan->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
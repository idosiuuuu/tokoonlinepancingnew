@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
{{ $sub }}

<form action="{{ route('backend.user.store') }}" method="post" enctype="multipart/form-data">
    @csrf


    <label>Hak Ases</label>
    <select name="role" class="form-control">
        <option value="" {{ old('role') == '' ? 'selected' : '' }}> - Pilih Hak Akses
            -
        </option>
        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}> Super Admin</option>
        <option value="0" {{ old('role') == '0' ? 'selected' : '' }}> Admin
        </option>
    </select>
    <p></p>

    <label>Nama</label>
    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control " placeholder="Masukkan Nama">
    <p></p>

    <label>Email</label>
    <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Masukkan Email">
    <p></p>

    <label>HP</label>
    <input type="text" name="hp" value="{{ old('hp') }}" class="form-control" placeholder="Masukkan HP">
    <p></p>

    <label>Password</label>
    <input type="password" name="password" value="{{ old('password') }}" class="form-control"
        placeholder="Masukkan Password">
    <p></p>

    <div <label>Password</label>
        <input type="password" name="password_confirmation" value="{{ old('password') }}" class="form-control"
            placeholder="Masukkan Password">
        <p></p>

        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.user.index') }}">
            <button type="button" class="btn btn-secondary">Kembali</button>
        </a>
</form>



<!-- contentAkhir -->
@endsection
@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.kategori.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title"> {{ $sub }} </h4>
                            <div class="form-group">
                                <label for="inputName" class="control-label">Nama Kategori</label>
                                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                                    class="form-control @error('nama_kategori') is-invalid @enderror" id="inputName"
                                    placeholder="Kategori" required>
                                @error('nama_kategori')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                            <a href="{{ route('backend.kategori.index') }}">
                                <button type="submit" class="btn button-close waves-effect waves-light">Kembali</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!-- contentAkhir -->

@endsection

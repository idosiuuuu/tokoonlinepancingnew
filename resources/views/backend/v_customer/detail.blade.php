@extends('backend.v_layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> {{ $sub }} </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    {{-- view image --}}
                                    @if ($row->foto)
                                        <img src="{{ asset('storage/img-customer/' . $row->foto) }}" class="foto-preview"
                                            width="100%">
                                        <p></p>
                                    @else
                                        <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="foto-preview"
                                            width="100%">
                                        <p></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama', $row->nama ?? '') }}"
                                        class="form-control @error('nama') is invalid @enderror" placeholder="Masukkan Nama"
                                        disabled>
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email', $row->email ?? '') }}"
                                        class="form-control @error('nama') is invalid @enderror"
                                        placeholder="Masukkan Email" disabled>
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hp</label>
                                    <input type="text" name="hp" value="{{ old('hp', $row->hp ?? '') }}"
                                        class="form-control @error('nama') is invalid @enderror" placeholder="-" disabled>
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" value="{{ old('alamat', $row->alamat ?? '') }}"
                                        class="form-control @error('nama') is invalid @enderror" placeholder="-" disabled>
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" name="pos" value="{{ old('pos', $row->pos ?? '') }}"
                                        class="form-control @error('nama') is invalid @enderror" placeholder="-" disabled>
                                    @error('nama')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="border-top">
                    <a href="{{ route('backend.customer.index') }}">
                        <button type="button" class="btn btn-primary">Kembali</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

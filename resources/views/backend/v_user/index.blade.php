@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $sub }} <br><br>
                        <a href="{{ route('backend.user.create') }}">
                            <button type="button" class="btn btn-outline-primary"><i class="fas fa-plus"></i>Tambah</button>
                        </a>
                    </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table-striped table-bordered table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $row->nama }} </td>
                                        <td> {{ $row->email }} </td>
                                        <td>
                                            @if ($row->role == 2)
                                                <span class="badge badge-warning"></i>
                                                    Customer</span>
                                            @elseif ($row->role == 1)
                                                <span class="badge badge-success"></i>
                                                    Super Admin</span>
                                            @elseif($row->role == 0)
                                                <span class="badge badge-primary"></i>
                                                    Admin</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success"></i>
                                                    Aktif</span>
                                            @elseif($row->status == 0)
                                                <span class="badge badge-secondary"></i>
                                                    NonAktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.user.edit', $row->id) }}">
                                                <button type="button" class="btn btn-cyan btn-sm">
                                                    <i class="far fa-edit"></i>Ubah</button>
                                            </a>
                                            <form method="POST" action="{{ route('backend.user.destroy', $row->id) }}"
                                                style="display:inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm show_confirm"
                                                    data-konf-delete="{{ $row->nama }}" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection

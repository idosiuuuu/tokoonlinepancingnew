@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pesanan <br><br>
                        {{-- Tambah button dihapus karena pesanan tidak ditambah manual --}}
                    </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table-striped table-bordered table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Order</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Pelanggan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->created_at->format('d M Y H:i') }}</td>
                                        <td>Rp. {{ number_format($row->total_harga + $row->biaya_ongkir, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($row->status == 'pending')
                                                <span class="badge badge-primary">Proses</span>
                                            @else
                                                <span class="badge badge-warning" style="color: white;">
                                                    {{ ucfirst($row->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $row->customer->user->email }}</td>
                                        <td>
                                            <a href="{{ route('pesanan.detail', $row->id) }}" title="Detail Order">
                                                <button type="button" class="btn btn-info btn-sm"><i
                                                        class="far fa-eye"></i> Detail</button>
                                            </a>
                                            <a href="{{ route('pesanan.invoice', $row->id) }}" title="Cetak Invoice"
                                                target="_blank">
                                                <button type="button" class="btn btn-secondary btn-sm"><i
                                                        class="fas fa-print"></i> Cetak</button>
                                            </a>
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

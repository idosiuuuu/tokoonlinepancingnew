@extends('backend.v_layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $sub }}</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>Detail Pesanan #{{ $orders->id }}</h5>
                        <p><strong>Tanggal:</strong> {{ $orders->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <form action="{{ route('pesanan.update', $orders->id) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Pelanggan</h5>
                                <p>
                                    Nama: {{ $orders->customer->user->nama }}<br>
                                    Email: {{ $orders->customer->user->email }}<br>
                                    HP: {{ $orders->customer->user->hp }}
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h5>Ongkos Kirim</h5>
                                <p>
                                    Kurir: {{ $orders->kurir }}<br>
                                    Layanan: {{ $orders->layanan_ongkir }}<br>
                                    Estimasi: {{ $orders->estimasi_ongkir }} Hari<br>
                                    Berat: {{ $orders->total_berat }} Gram
                                </p>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <h5>Produk</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2">Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalHarga = 0;
                                        $totalBerat = 0;
                                    @endphp
                                    @foreach ($orders->orderItems as $item)
                                        @php
                                            $total = $item->harga * $item->quantity;
                                            $totalHarga += $total;
                                            $totalBerat += $item->produk->berat * $item->quantity;
                                        @endphp
                                        <tr>
                                            <td class="text-center" width="100">
                                                <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}"
                                                    alt="" width="60">
                                            </td>
                                            <td>
                                                <strong>{{ $item->produk->nama_produk }}</strong> <br>
                                                <small>#{{ $item->produk->kategori->nama_kategori }}</small>
                                                <ul class="mb-0">
                                                    <li>Berat: {{ $item->produk->berat }} Gram</li>
                                                    <li>Stok: {{ $item->produk->stok }} Gram</li>
                                                </ul>
                                            </td>
                                            <td class="text-center">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>Subtotal</td>
                                        <td class="text-end">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>Ongkos Kirim</td>
                                        <td class="text-end">Rp. {{ number_format($orders->biaya_ongkir, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th>Total Bayar</th>
                                        <th class="text-end text-success">Rp.
                                            {{ number_format($totalHarga + $orders->biaya_ongkir, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>No. Resi</label>
                                    <input type="text" name="noresi" value="{{ old('noresi', $orders->noresi) }}"
                                        class="form-control @error('noresi') is-invalid @enderror"
                                        placeholder="Masukkan Nomor Resi">
                                    @error('noresi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="">- Pilih Status Pesanan -</option>
                                        <option value="Paid"
                                            {{ old('status', $orders->status) == 'Paid' ? 'selected' : '' }}>Proses
                                        </option>
                                        <option value="Kirim"
                                            {{ old('status', $orders->status) == 'Kirim' ? 'selected' : '' }}>Kirim
                                        </option>
                                        <option value="Selesai"
                                            {{ old('status', $orders->status) == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="ckeditor">{{ old('alamat', $orders->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Kode Pos</label>
                                    <input type="text" name="pos" value="{{ old('pos', $orders->pos) }}"
                                        class="form-control @error('pos') is-invalid @enderror"
                                        placeholder="Masukkan Kode Pos">
                                    @error('pos')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pesanan.proses') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

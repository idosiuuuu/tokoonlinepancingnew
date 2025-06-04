<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc;
    }
</style>
<table>
    <!-- <tr>
        <td colspan="2" align="center"><img src="{{ asset('image/kop_surat.jpg') }}" width="50%"></td>
    </tr> -->
    <tr>
        <td align="center">
            <img src="#" width="50%">
        </td>
    </tr>
    <tr>
        <td align="left">
            <h2>Detail Pesanan #{{ $orders->id }}</h2>
            <strong>Tanggal:</strong> {{ $orders->created_at->format('d M Y H:i') }}
        </td>
    </tr>
</table>
<p></p>

<table>
    <tr>
        <td align="left" style="border: hidden;">
            <h5>Pelanggan</h5>
            <address>
                Nama: {{ $orders->customer->user->nama }}<br>
                Email: {{ $orders->customer->user->email }}<br>
                Hp: {{ $orders->customer->user->hp }}<br>
                Alamat: <br>{!! $orders->alamat !!} <br>
                Kode Pos: {{ $orders->pos }}
            </address>
        </td>
        <td align="right" style="border: hidden;">
            <h5>Ongkos Kirim</h5>
            <address>
                @if ($orders->noresi)
                    No.Resi: {{ $orders->noresi }} <br>
                @else
                    No. Resi &lt;&lt;dalam proses&gt;&gt; <br>
                @endif
                Kurir: {{ $orders->kurir }}<br>
                Layanan: {{ $orders->layanan_ongkir }}<br>
                Estimasi: {{ $orders->estimasi_ongkir }} Hari<br>
                Berat: {{ $orders->total_berat }} Gram<br>
            </address>
        </td>
    </tr>
</table>
<p></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Quantity</th>
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
                $totalHarga += $item->harga * $item->quantity;
                $totalBerat += $item->produk->berat * $item->quantity;
            @endphp
            <tr>
                <td> {{ $loop->iteration }}</td>
                <td class="details">
                    <a>{{ $item->produk->nama_produk }} #{{ $item->produk->kategori->nama_kategori }}</a>
                    <ul>
                        <li><span>Berat: {{ $item->produk->berat }} Gram</span></li>
                        <li><span>Stok: {{ $item->produk->stok }} Gram</span></li>
                    </ul>
                </td>
                <td class="price text-center">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="qty text-center">
                    <a> {{ $item->quantity }} </a>
                </td>
                <td class="total text-center">Rp. {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</td>

            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="empty" colspan="3"></th>
            <td>Subtotal</td>
            <td colspan="2">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="empty" colspan="3"></th>
            <td>Ongkos Kirim</td>
            <td colspan="2">
                Rp. {{ number_format($orders->biaya_ongkir, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <th class="empty" colspan="3"></th>
            <td><b>Total Bayar</b></td>
            <td colspan="2" class="total"> <b>Rp.
                    {{ number_format($totalHarga + $orders->biaya_ongkir, 0, ',', '.') }}</b> </td>
        </tr>
    </tfoot>
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>

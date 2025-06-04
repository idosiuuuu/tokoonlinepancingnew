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

    img {
        width: 10%
    }

    .judul {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px
    }

    .text {
        width: 30%;
        text-align: start
    }

    @media print {

        .text {
            font-size: 15px;
            width: 50%
        }

        img {
            width: 15%
        }
    }
</style>
<table>
    <!-- <tr>
        <td colspan="2" align="center"><img src="{{ asset('image/kop_surat.jpg') }}" width="50%"></td>
    </tr> -->
    <tr>
        <td align="center" class="judul">
            <img src="{{ asset('image/logo.png') }}">
            <div class="text">
                <h1>DIKA FISHING</h1>
                <h3>Rancawiru, Kec. Pangkah, Kabupaten Tegal, Jawa Tengah 52471.</h3>
            </div>
        </td>
    </tr>
    <tr>
        <td align="left">
            Perihal : {{ $sub }} <br>
            Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
        </td>
    </tr>
</table>
<p></p>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID Order</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Pelanggan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $row->id }} </td>
                <td>{{ $row->created_at->format('d M Y H:i') }}</td>
                <td> Rp. {{ number_format($row->total_harga + $row->biaya_ongkir, 0, ',', '.') }}</td>
                <td>
                    @if ($row->status == 'Paid')
                        Proses
                    @else
                        {{ $row->status }}
                    @endif
                </td>

                <td> {{ $row->customer->user->email }} </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>

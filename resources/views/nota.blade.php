<!DOCTYPE html>
<html>

<head>
    <title>Transaksi Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style type="text/css">
    .center {
        max-width: 700px;
        margin: 0 auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid;
    }

    th {
        text-align: center;
    }

    .header {
        text-align: center;
        margin-bottom: 40px;
    }

    h1 {
        margin-bottom: 0;
    }

    p {
        margin-bottom: 0;
    }
    .isi {
        padding: 0 10px
    }

</style>

<body>
    <div class="center">
        <div class="header">
            <h1>TOKO ABCDE</h1>
            <p>#{{$barangs->id}}</p>
            <p>jl. blblablanbla | 082123456789</p>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
            @foreach ($barangs->barang as $barang)
                <tr class="isi">
                    <td style="text-align: center">{{$loop->index + 1}}</td>
                    <td>{{$barang->nama}}</td>
                    <td>{{$barang->jumlah}}</td>
                    <td>{{$barang->harga}}</td>
                    <td style="text-align: right">{{$barang->total}}</td>
                </tr>
            @endforeach
            <tr class="isi">
                <td colspan="4" style="text-align: right">Total</td>
                <td style="text-align: right">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($barangs->barang as $barang)
                        @php
                            $total += $barang->total;
                        @endphp
                    @endforeach
                    {{$total}}
                    
                </td>
            </tr>
        </table>
    </div>
    </div>

</body>

</html>

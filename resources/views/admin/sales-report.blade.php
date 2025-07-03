@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container">
    <h2>Laporan Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Produk</th>
                <th>Kuantitas</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salesData as $sale)
            <tr>
                <td>{{ $sale->transaction_id }}</td>
                <td>{{ $sale->transaction_date }}</td>
                <td>{{ $sale->name }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>Rp {{ number_format($sale->price, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada data penjualan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
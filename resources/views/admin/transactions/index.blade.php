@extends('layouts.admin')

@section('title', 'Data Transaksi - Admin Panel')

@section('content')
<div class="container">
    <h2>Data Transaksi</h2>
    
    @if(session('success'))
        <div class="alert-message success-message">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pengguna</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->user->username }}</td>
                <td>{{ $transaction->transaction_date->format('d/m/Y H:i') }}</td>
                <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                <td>{{ $transaction->status }}</td>
                <td>
                    <form action="{{ route('admin.transactions.delete', $transaction->transaction_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada transaksi yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
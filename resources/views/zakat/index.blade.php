@extends('layouts.app')

@section('title', 'Daftar Perhitungan Zakat')

@section('content')
    <h2>Daftar Perhitungan Zakat</h2>
    
    @if(count($zakats) > 0)
        <table>
            <thead>
                <tr>
                    <th>Nama/Keterangan</th>
                    <th>Tipe Zakat</th>
                    <th>Total Harta</th>
                    <th>Zakat (2.5%)</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($zakats as $id => $zakat)
                    <tr>
                        <td>{{ $zakat['name'] ?? 'Perhitungan #' . $id }}</td>
                        <td>
                            <span style="background: {{ $zakat['zakat_type'] === 'income' ? '#cfe2ff' : '#d1e7dd' }}; padding: 5px 10px; border-radius: 3px;">
                                {{ $zakat['zakat_type'] === 'income' ? 'Zakat Penghasilan' : 'Zakat Harta' }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($zakat['total_asset'], 0, ',', '.') }}</td>
                        <td style="font-weight: bold; color: #28a745;">Rp {{ number_format($zakat['zakat_amount'], 0, ',', '.') }}</td>
                        <td>{{ $zakat['created_at']->format('d M Y H:i') }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('zakat.show', $id) }}" class="btn-view">Lihat</a>
                                <a href="{{ route('zakat.edit', $id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('zakat.destroy', $id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <h3>📋 Belum ada perhitungan zakat</h3>
            <p>Mulai dengan membuat perhitungan zakat baru</p>
            <br>
            <a href="{{ route('zakat.create') }}" style="display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;">
                Hitung Zakat Sekarang
            </a>
        </div>
    @endif
@endsection

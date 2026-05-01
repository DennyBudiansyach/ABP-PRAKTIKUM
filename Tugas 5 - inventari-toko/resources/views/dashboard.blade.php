<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="color:#60a5fa;font-size:0.8rem;font-weight:600;margin-bottom:4px;">MANAJEMEN INVENTARI</p>
            <h1 style="color:white;font-size:1.5rem;font-weight:800;margin:0;">Sistem Inventari Toko Cokomi & Wowo</h1>
            <p style="color:#64748b;font-size:0.85rem;margin-top:4px;">Website pencatatan & pengelolaan stok produk toko.</p>
        </div>
        <div style="display:flex;gap:10px;">
            <a href="{{ route('products.index') }}" class="btn-primary" style="text-decoration:none;padding:10px 18px;">
                📋 Lihat Data Produk
            </a>
            <a href="{{ route('products.create') }}"
               style="text-decoration:none;padding:10px 18px;border:1px solid #2563eb;color:#60a5fa;border-radius:8px;font-size:0.85rem;font-weight:600;">
                ➕ Tambah Produk
            </a>
        </div>
    </x-slot>

    <div style="max-width:1280px;margin:0 auto;padding:32px 24px;">

        {{-- Stat Cards --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:32px;">
            <div class="stat-card">
                <div style="font-size:2rem;margin-bottom:8px;">📦</div>
                <div style="font-size:2.2rem;font-weight:800;color:white;">{{ $totalProduk }}</div>
                <div style="color:#64748b;font-size:0.85rem;margin-top:4px;">Total Jenis Produk</div>
            </div>
            <div class="stat-card">
                <div style="font-size:2rem;margin-bottom:8px;">🏭</div>
                <div style="font-size:2.2rem;font-weight:800;color:#34d399;">{{ number_format($totalStok) }}</div>
                <div style="color:#64748b;font-size:0.85rem;margin-top:4px;">Total Stok</div>
            </div>
            <div class="stat-card">
                <div style="font-size:2rem;margin-bottom:8px;">💰</div>
                <div style="font-size:1.5rem;font-weight:800;color:#fbbf24;">Rp {{ number_format($nilaiInventaris, 0, ',', '.') }}</div>
                <div style="color:#64748b;font-size:0.85rem;margin-top:4px;">Nilai Inventaris</div>
            </div>
        </div>

        {{-- Fitur Utama --}}
        <div style="margin-bottom:32px;">
            <h2 style="color:#e2e8f0;font-size:1rem;font-weight:700;margin-bottom:16px;">Fitur Utama</h2>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                <div class="card-dark" style="padding:24px;">
                    <div style="font-size:1.5rem;margin-bottom:12px;">➕</div>
                    <div style="font-weight:700;color:white;margin-bottom:6px;">Tambah Produk</div>
                    <div style="color:#64748b;font-size:0.82rem;margin-bottom:16px;">Daftarkan produk baru ke dalam sistem inventari toko.</div>
                    <a href="{{ route('products.create') }}" style="color:#60a5fa;font-size:0.82rem;font-weight:600;text-decoration:none;">Buka Form →</a>
                </div>
                <div class="card-dark" style="padding:24px;">
                    <div style="font-size:1.5rem;margin-bottom:12px;">📋</div>
                    <div style="font-weight:700;color:white;margin-bottom:6px;">Lihat Data Produk</div>
                    <div style="color:#64748b;font-size:0.82rem;margin-bottom:16px;">Tampilkan semua produk dalam tabel yang terstruktur.</div>
                    <a href="{{ route('products.index') }}" style="color:#60a5fa;font-size:0.82rem;font-weight:600;text-decoration:none;">Buka Tabel →</a>
                </div>
                <div class="card-dark" style="padding:24px;">
                    <div style="font-size:1.5rem;margin-bottom:12px;">✏️</div>
                    <div style="font-weight:700;color:white;margin-bottom:6px;">Edit & Hapus</div>
                    <div style="color:#64748b;font-size:0.82rem;margin-bottom:16px;">Kelola dan perbarui data produk yang sudah ada.</div>
                    <a href="{{ route('products.index') }}" style="color:#60a5fa;font-size:0.82rem;font-weight:600;text-decoration:none;">Kelola Data →</a>
                </div>
            </div>
        </div>

        {{-- Stok Rendah --}}
        <div class="card-dark" style="padding:24px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                <span style="font-size:1.3rem;">⚠️</span>
                <h3 style="color:#f87171;font-size:1rem;font-weight:700;margin:0;">Produk Stok Rendah (kurang dari 10)</h3>
            </div>
            @if($stokRendah->isEmpty())
                <div style="text-align:center;padding:32px;color:#64748b;">
                    <div style="font-size:2.5rem;margin-bottom:10px;">✅</div>
                    <p>Semua produk stoknya aman!</p>
                </div>
            @else
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr class="table-dark-head">
                            <th style="padding:12px 16px;text-align:left;">#</th>
                            <th style="padding:12px 16px;text-align:left;">Nama Produk</th>
                            <th style="padding:12px 16px;text-align:left;">Kategori</th>
                            <th style="padding:12px 16px;text-align:left;">Stok</th>
                            <th style="padding:12px 16px;text-align:left;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokRendah as $i => $product)
                        <tr class="table-row-dark">
                            <td style="padding:12px 16px;color:#64748b;">{{ $i+1 }}</td>
                            <td style="padding:12px 16px;font-weight:600;color:white;">{{ $product->name }}</td>
                            <td style="padding:12px 16px;"><span class="badge">{{ $product->category }}</span></td>
                            <td style="padding:12px 16px;"><span style="background:#3b1a1a;color:#f87171;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">{{ $product->stock }} {{ $product->unit }}</span></td>
                            <td style="padding:12px 16px;">
                                <a href="{{ route('products.edit', $product) }}" class="btn-edit" style="text-decoration:none;">✏️ Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div style="margin-top:16px;padding-top:16px;border-top:1px solid #1e2d40;">
                <a href="{{ route('products.index') }}" style="color:#60a5fa;font-size:0.85rem;font-weight:600;text-decoration:none;">→ Lihat semua produk</a>
            </div>
        </div>
    </div>
</x-app-layout>
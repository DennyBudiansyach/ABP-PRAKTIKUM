<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="color:white;font-size:1.4rem;font-weight:800;margin:0;">Data Produk</h1>
            <p style="color:#64748b;font-size:0.82rem;margin-top:2px;">Kelola semua produk inventari toko</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn-primary" style="text-decoration:none;padding:10px 18px;display:flex;align-items:center;gap:6px;">
            ➕ Tambah Produk
        </a>
    </x-slot>

    <div style="max-width:1280px;margin:0 auto;padding:32px 24px;">

        @if(session('success'))
        <div style="background:#0f2a1a;border:1px solid #16a34a;color:#4ade80;padding:12px 18px;border-radius:10px;margin-bottom:20px;font-size:0.88rem;">
            ✅ {{ session('success') }}
        </div>
        @endif

        <div class="card-dark" style="padding:24px;">
            {{-- Search & Show --}}
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="color:#64748b;font-size:0.85rem;">Tampilkan</span>
                    <span style="background:#1a2332;border:1px solid #1e2d40;color:#e2e8f0;padding:4px 12px;border-radius:6px;font-size:0.85rem;">10</span>
                    <span style="color:#64748b;font-size:0.85rem;">data</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="color:#64748b;font-size:0.85rem;">Cari:</span>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari produk..."
                           style="background:#1a2332;border:1px solid #1e2d40;color:#e2e8f0;padding:7px 14px;border-radius:8px;font-size:0.85rem;outline:none;width:200px;">
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;" id="productTable">
                    <thead>
                        <tr class="table-dark-head">
                            <th style="padding:12px 16px;text-align:left;">#</th>
                            <th style="padding:12px 16px;text-align:left;">Nama Produk</th>
                            <th style="padding:12px 16px;text-align:left;">Kategori</th>
                            <th style="padding:12px 16px;text-align:left;">Stok</th>
                            <th style="padding:12px 16px;text-align:left;">Satuan</th>
                            <th style="padding:12px 16px;text-align:left;">Harga</th>
                            <th style="padding:12px 16px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $i => $product)
                        <tr class="table-row-dark">
                            <td style="padding:12px 16px;color:#64748b;">{{ $products->firstItem() + $i }}</td>
                            <td style="padding:12px 16px;font-weight:600;color:white;">{{ $product->name }}</td>
                            <td style="padding:12px 16px;"><span class="badge">{{ $product->category }}</span></td>
                            <td style="padding:12px 16px;">
                                <span style="color:{{ $product->stock < 10 ? '#f87171' : '#34d399' }};font-weight:700;">
                                    {{ $product->stock }}
                                </span>
                                @if($product->stock < 10)
                                    <span style="color:#f87171;font-size:0.72rem;"> ⚠️</span>
                                @endif
                            </td>
                            <td style="padding:12px 16px;color:#94a3b8;">{{ $product->unit }}</td>
                            <td style="padding:12px 16px;color:#e2e8f0;font-weight:500;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td style="padding:12px 16px;text-align:center;">
                                <div style="display:flex;justify-content:center;gap:8px;">
                                    <a href="{{ route('products.edit', $product) }}" class="btn-edit" style="text-decoration:none;">✏️</a>
                                    <button onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')" class="btn-delete">🗑️</button>
                                </div>
                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:48px;color:#64748b;">
                                <div style="font-size:2.5rem;margin-bottom:10px;">📭</div>
                                Belum ada produk. Silakan tambahkan!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:20px;padding-top:16px;border-top:1px solid #1e2d40;">
                <span style="color:#64748b;font-size:0.82rem;">
                    Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} hasil
                </span>
                <div>{{ $products->links() }}</div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div id="deleteModal" style="display:none;position:fixed;inset:0;z-index:999;align-items:center;justify-content:center;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.7);" onclick="closeModal()"></div>
        <div style="position:relative;background:#111827;border:1px solid #1e2d40;border-radius:16px;padding:32px;max-width:380px;width:90%;z-index:10;text-align:center;">
            <div style="font-size:3rem;margin-bottom:12px;">🗑️</div>
            <h3 style="color:white;font-size:1.1rem;font-weight:700;margin-bottom:8px;">Konfirmasi Hapus</h3>
            <p style="color:#94a3b8;font-size:0.88rem;margin-bottom:6px;">Yakin ingin menghapus produk</p>
            <p style="color:#f87171;font-weight:700;margin-bottom:6px;" id="productName"></p>
            <p style="color:#64748b;font-size:0.78rem;margin-bottom:24px;">Data yang dihapus tidak bisa dikembalikan.</p>
            <div style="display:flex;gap:12px;">
                <button onclick="closeModal()"
                    style="flex:1;padding:10px;background:#1e2d40;color:#94a3b8;border:1px solid #2d3f55;border-radius:8px;cursor:pointer;font-weight:600;">
                    Batal
                </button>
                <button id="confirmBtn"
                    style="flex:1;padding:10px;background:#dc2626;color:white;border:none;border-radius:8px;cursor:pointer;font-weight:600;">
                    Ya, Hapus!
                </button>
            </div>
        </div>
    </div>

    <script>
        let targetFormId = null;
        function confirmDelete(id, name) {
            targetFormId = id;
            document.getElementById('productName').textContent = name;
            document.getElementById('deleteModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
        document.getElementById('confirmBtn').addEventListener('click', function() {
            if (targetFormId) document.getElementById('delete-form-' + targetFormId).submit();
        });
        function searchTable() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#productTable tbody tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
            });
        }
    </script>
</x-app-layout>
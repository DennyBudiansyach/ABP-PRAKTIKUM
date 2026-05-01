<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="color:white;font-size:1.4rem;font-weight:800;margin:0;">Tambah Produk Baru</h1>
            <p style="color:#64748b;font-size:0.82rem;margin-top:2px;">Daftarkan produk baru ke inventari toko</p>
        </div>
    </x-slot>

    <div style="max-width:600px;margin:40px auto;padding:0 24px;">
        <div class="card-dark" style="padding:36px;">
            <div style="text-align:center;margin-bottom:28px;">
                <div style="background:#1e3a5f;border-radius:12px;padding:14px;display:inline-block;font-size:1.8rem;">📦</div>
            </div>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div style="margin-bottom:18px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">🏷️ Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="contoh: Indomie Goreng"
                           class="input-dark @error('name') border-red-500 @enderror">
                    @error('name')<p style="color:#f87171;font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>

                <div style="margin-bottom:18px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">🗂️ Kategori *</label>
                    <select name="category" class="input-dark">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(['Makanan','Minuman','Kebersihan','Elektronik','Pakaian','Lainnya'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }} style="background:#1a2332;">{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category')<p style="color:#f87171;font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>

                <div style="margin-bottom:18px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">📝 Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi produk (opsional)" class="input-dark">{{ old('description') }}</textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;">
                    <div>
                        <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">📦 Stok *</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="input-dark">
                        @error('stock')<p style="color:#f87171;font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">📏 Satuan *</label>
                        <select name="unit" class="input-dark">
                            @foreach(['pcs','kg','liter','lusin','pack','box'] as $unit)
                                <option value="{{ $unit }}" {{ old('unit') == $unit ? 'selected' : '' }} style="background:#1a2332;">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:28px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">💰 Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', 0) }}" min="0" class="input-dark">
                    @error('price')<p style="color:#f87171;font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>

                <div style="display:flex;gap:12px;">
                    <button type="submit" class="btn-primary" style="flex:2;padding:12px;font-size:0.9rem;">
                        💾 Simpan Produk
                    </button>
                    <button type="reset"
                            style="flex:1;padding:12px;background:#1e2d40;color:#94a3b8;border:1px solid #2d3f55;border-radius:8px;cursor:pointer;font-weight:600;font-size:0.9rem;">
                        🔄 Reset
                    </button>
                </div>
            </form>
        </div>

        <div style="text-align:center;margin-top:16px;">
            <a href="{{ route('products.index') }}" style="color:#64748b;font-size:0.85rem;text-decoration:none;">← Kembali ke Daftar Produk</a>
        </div>
    </div>
</x-app-layout>
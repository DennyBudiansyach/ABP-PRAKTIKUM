<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="color:white;font-size:1.4rem;font-weight:800;margin:0;">Edit Produk</h1>
            <p style="color:#64748b;font-size:0.82rem;margin-top:2px;">{{ $product->name }}</p>
        </div>
    </x-slot>

    <div style="max-width:600px;margin:40px auto;padding:0 24px;">
        <div class="card-dark" style="padding:36px;">
            <div style="text-align:center;margin-bottom:28px;">
                <div style="background:#1e3a5f;border-radius:12px;padding:14px;display:inline-block;font-size:1.8rem;">✏️</div>
            </div>

            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom:18px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">🏷️ Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input-dark">
                    @error('name')<p style="color:#f87171;font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>

                <div style="margin-bottom:18px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">🗂️ Kategori *</label>
                    <select name="category" class="input-dark">
                        @foreach(['Makanan','Minuman','Kebersihan','Elektronik','Pakaian','Lainnya'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }} style="background:#1a2332;">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom:18px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">📝 Deskripsi</label>
                    <textarea name="description" rows="3" class="input-dark">{{ old('description', $product->description) }}</textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;">
                    <div>
                        <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">📦 Stok *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="input-dark">
                    </div>
                    <div>
                        <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">📏 Satuan *</label>
                        <select name="unit" class="input-dark">
                            @foreach(['pcs','kg','liter','lusin','pack','box'] as $unit)
                                <option value="{{ $unit }}" {{ old('unit', $product->unit) == $unit ? 'selected' : '' }} style="background:#1a2332;">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:28px;">
                    <label style="color:#94a3b8;font-size:0.82rem;font-weight:600;display:block;margin-bottom:6px;">💰 Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" class="input-dark">
                </div>

                <div style="display:flex;gap:12px;">
                    <button type="submit"
                            style="flex:2;padding:12px;background:#d97706;color:white;border:none;border-radius:8px;cursor:pointer;font-weight:700;font-size:0.9rem;">
                        🔄 Update Produk
                    </button>
                    <a href="{{ route('products.index') }}"
                       style="flex:1;padding:12px;background:#1e2d40;color:#94a3b8;border:1px solid #2d3f55;border-radius:8px;text-decoration:none;text-align:center;font-weight:600;font-size:0.9rem;">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <div style="text-align:center;margin-top:16px;">
            <a href="{{ route('products.index') }}" style="color:#64748b;font-size:0.85rem;text-decoration:none;">← Kembali ke Daftar Produk</a>
        </div>
    </div>
</x-app-layout>
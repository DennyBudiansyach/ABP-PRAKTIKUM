<nav class="nav-dark sticky top-0 z-50" style="padding: 12px 0;">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div style="background:#2563eb;border-radius:8px;padding:6px 10px;font-weight:800;color:white;font-size:0.95rem;">🏪</div>
            <span style="font-weight:700;color:white;font-size:1rem;">Toko Cokomi & Wowo</span>
        </a>

        {{-- Nav Links --}}
        <div style="display:flex;align-items:center;gap:6px;">
            <a href="{{ route('dashboard') }}"
               class="nav-link-dark {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               style="{{ request()->routeIs('dashboard') ? 'background:#1e2d40;color:white;' : '' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('products.index') }}"
               class="nav-link-dark {{ request()->routeIs('products.index') ? 'active' : '' }}"
               style="{{ request()->routeIs('products.index') ? 'background:#1e2d40;color:white;' : '' }}">
                📋 Data Produk
            </a>
            <a href="{{ route('products.create') }}"
               class="nav-link-dark {{ request()->routeIs('products.create') ? 'active' : '' }}"
               style="{{ request()->routeIs('products.create') ? 'background:#1e2d40;color:white;' : '' }}">
                ➕ Tambah Produk
            </a>
        </div>

        {{-- User Dropdown --}}
        <div style="position:relative;" x-data="{ open: false }">
            <button @click="open = !open"
                    style="display:flex;align-items:center;gap:8px;background:#1e2d40;border:1px solid #2d3f55;color:#e2e8f0;border-radius:8px;padding:7px 14px;cursor:pointer;font-size:0.88rem;font-weight:500;">
                👤 {{ Auth::user()->name }}
                <span style="font-size:0.7rem;">▼</span>
            </button>
            <div x-show="open" @click.outside="open = false"
                 style="position:absolute;right:0;top:110%;background:#111827;border:1px solid #1e2d40;border-radius:10px;min-width:160px;z-index:100;padding:6px;">
                <a href="{{ route('profile.edit') }}"
                   style="display:block;padding:8px 14px;color:#94a3b8;text-decoration:none;border-radius:6px;font-size:0.88rem;"
                   onmouseover="this.style.background='#1e2d40';this.style.color='white'"
                   onmouseout="this.style.background='transparent';this.style.color='#94a3b8'">
                    ⚙️ Profile
                </a>
                <hr style="border-color:#1e2d40;margin:4px 0;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            style="display:block;width:100%;padding:8px 14px;color:#f87171;background:transparent;border:none;cursor:pointer;text-align:left;border-radius:6px;font-size:0.88rem;"
                            onmouseover="this.style.background='#3b1a1a'"
                            onmouseout="this.style.background='transparent'">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
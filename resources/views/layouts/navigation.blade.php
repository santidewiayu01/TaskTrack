@php
    $totalNav = App\Models\Task::where("user_id", Auth::id())->count();
    $belumNav = App\Models\Task::where("user_id", Auth::id())->where("status","belum")->count();
    $selesaiNav = App\Models\Task::where("user_id", Auth::id())->where("status","selesai")->count();
    $terlambatNav = App\Models\Task::where("user_id", Auth::id())->where("status","belum")->where("deadline","<",now()->toDateString())->count();
    $favoritNav = App\Models\Task::where("user_id", Auth::id())->where("favorite", true)->count();
@endphp
<aside style="width:260px;min-height:100vh;background:var(--surface);border-right:1px solid var(--border);display:flex;flex-direction:column;padding:28px 20px;position:fixed;top:0;left:0;bottom:0;z-index:100;gap:8px;">
    <div style="font-family:'Syne',sans-serif;font-size:22px;font-weight:800;letter-spacing:-0.5px;color:#fff;display:flex;align-items:center;gap:10px;padding:0 8px 28px;border-bottom:1px solid var(--border);margin-bottom:12px;">
        <div style="width:36px;height:36px;background:var(--accent);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;">✦</div>
        <span style="text-shadow: 0 2px 6px rgba(0,0,0,0.18);">Task<span style="color:var(--accent);text-shadow: 0 2px 6px rgba(0,0,0,0.18);">Track</span></span>
    </div>
    <div style="font-size:10px;font-weight:600;letter-spacing:1.5px;color:var(--muted);text-transform:uppercase;padding:12px 8px 6px;">Menu</div>

    <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:12px;padding:11px 12px;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:all 0.2s;text-decoration:none; {{ request()->routeIs('dashboard') ? 'background:rgba(108,99,255,0.15);color:#fff;border:1px solid rgba(108,99,255,0.25);' : 'color:var(--muted);' }}">
        <span style="font-size:16px;width:20px;text-align:center;">⊞</span> Dashboard
    </a>
    <a href="{{ route('tasks.index') }}" style="display:flex;justify-content:space-between;align-items:center;padding:11px 12px;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:all 0.2s;text-decoration:none; {{ request()->routeIs('tasks.index') && !request('status') ? 'background:rgba(108,99,255,0.15);color:#fff;border:1px solid rgba(108,99,255,0.25);' : 'color:var(--muted);' }}">
        <span style="display:flex;align-items:center;gap:12px;"><span style="font-size:16px;width:20px;text-align:center;">✓</span> Semua Tugas</span>
        <span style="background:var(--accent);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $totalNav }}</span>
    </a>
    <a href="{{ route('tasks.index',['status'=>'belum']) }}" style="display:flex;justify-content:space-between;align-items:center;padding:11px 12px;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:all 0.2s;text-decoration:none; {{ request()->routeIs('tasks.index') && request('status')==='belum' ? 'background:rgba(108,99,255,0.15);color:#fff;border:1px solid rgba(108,99,255,0.25);' : 'color:var(--muted);' }}">
        <span style="display:flex;align-items:center;gap:12px;"><span style="font-size:16px;width:20px;text-align:center;">◷</span> Belum Selesai</span>
        <span style="background:var(--accent);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $belumNav }}</span>
    </a>
    <a href="{{ route('tasks.index',['status'=>'favorit']) }}" style="display:flex;justify-content:space-between;align-items:center;padding:11px 12px;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:all 0.2s;text-decoration:none; {{ request()->routeIs('tasks.index') && request('status')==='favorit' ? 'background:rgba(108,99,255,0.15);color:#fff;border:1px solid rgba(108,99,255,0.25);' : 'color:var(--muted);' }}">
        <span style="display:flex;align-items:center;gap:12px;"><span style="font-size:16px;width:20px;text-align:center;">❤</span> Favorit</span>
        <span style="background:var(--accent);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $favoritNav }}</span>
    </a>
    <a href="{{ route('tasks.index',['status'=>'selesai']) }}" style="display:flex;justify-content:space-between;align-items:center;padding:11px 12px;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:all 0.2s;text-decoration:none; {{ request()->routeIs('tasks.index') && request('status')==='selesai' ? 'background:rgba(108,99,255,0.15);color:#fff;border:1px solid rgba(108,99,255,0.25);' : 'color:var(--muted);' }}">
        <span style="display:flex;align-items:center;gap:12px;"><span style="font-size:16px;width:20px;text-align:center;">◉</span> Selesai</span>
        <span style="background:var(--accent3);color:#000;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $selesaiNav }}</span>
    </a>
    <a href="{{ route('tasks.index',['status'=>'terlambat']) }}" style="display:flex;justify-content:space-between;align-items:center;padding:11px 12px;border-radius:10px;cursor:pointer;font-size:14px;font-weight:500;transition:all 0.2s;text-decoration:none; {{ request()->routeIs('tasks.index') && request('status')==='terlambat' ? 'background:rgba(108,99,255,0.15);color:#fff;border:1px solid rgba(108,99,255,0.25);' : 'color:var(--muted);' }}">
        <span style="display:flex;align-items:center;gap:12px;"><span style="font-size:16px;width:20px;text-align:center;">⚠</span> Terlambat</span>
        <span style="background:var(--accent2);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;">{{ $terlambatNav }}</span>
    </a>

    

    <div style="margin-top:auto;border-top:1px solid var(--border);padding-top:16px;position:relative;" x-data="{ userMenuOpen: false }">
        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:10px;cursor:pointer;transition:background 0.2s;text-decoration:none;color:inherit;">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar" style="width:36px;height:36px;border-radius:50%;object-fit:cover;flex-shrink:0;" />
            @else
                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;color:#fff;flex-shrink:0;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
            @endif
            <div style="flex:1;min-width:0;">
                <div style="font-size:13px;font-weight:600;color:var(--text);">{{ Auth::user()->name }}</div>
                <div style="font-size:11px;color:var(--muted);">{{ Auth::user()->email }}</div>
            </div>
        </a>
        <button @click="userMenuOpen = !userMenuOpen" style="position:absolute;right:12px;top:10px;background:none;border:none;color:var(--muted);font-size:16px;cursor:pointer;padding:4px;transition:color 0.2s;" @mouseover="userMenuOpen = true">⋯</button>

        <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" style="position:absolute;bottom:58px;right:12px;background:var(--surface2);border:1px solid var(--border);border-radius:8px;min-width:160px;overflow:hidden;z-index:1000;padding:4px;box-shadow:0 4px 30px rgba(0,0,0,0.3);">
            <form method="POST" action="{{ route('logout') }}" style="width:100%;">
                @csrf
                <button type="submit" style="width:100%;background:none;border:none;color:var(--text);padding:10px 14px;text-align:left;font-size:13px;font-weight:500;cursor:pointer;transition:background 0.2s;display:flex;align-items:center;gap:10px;font-family:'DM Sans',sans-serif;" onmouseover="this.style.background='rgba(108,99,255,0.15)'" onmouseout="this.style.background='none'">
                    <span style="font-size:14px;">→</span>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>

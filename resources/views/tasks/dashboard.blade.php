<x-app-layout>
<div x-data="{ editTaskId: null, current: {}, searchQuery: '', theme: 'dark' }" x-init="theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');" style="max-width:1400px;">
<!-- Header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:36px;animation:fadeUp 0.5s ease both;">
    <div>
        <h1 style="font-size:28px;font-weight:800;letter-spacing:-0.5px;">Dashboard 👋</h1>
        <p style="color:var(--muted);font-size:14px;margin-top:4px;">Selamat datang kembali, {{ Auth::user()->name }}! Kamu punya {{ $belum }} tugas yang belum selesai.</p>
    </div>
    <div style="display:flex;gap:10px;align-items:center;">
        <button type="button" @click="theme = theme === 'light' ? 'dark' : 'light'; window.toggleTheme();" x-text="theme === 'dark' ? '☀️' : '🌙'" class="theme-toggle-btn" aria-label="Toggle tema"></button>
        <div style="position:relative;">
            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:14px;">⌕</span>
            <input type="text" x-model="searchQuery" placeholder="Cari tugas..." style="width:220px;padding:8px 14px 8px 36px;background:var(--surface2);border:1px solid var(--border);border-radius:10px;color:var(--text);font-size:13px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color 0.2s,width 0.3s;" />
        </div>
        <a href="{{ route('tasks.create') }}" style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:10px;font-size:13px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all 0.2s;border:none;background:var(--accent);color:#fff;box-shadow:0 4px 20px rgba(108,99,255,0.35);text-decoration:none;">＋ Tambah Tugas</a>
    </div>
</div>

<!-- Stats Grid -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:32px;">
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:22px;position:relative;overflow:hidden;transition:transform 0.2s,border-color 0.2s;animation:fadeUp 0.5s ease both;">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;border-radius:16px 16px 0 0;background:linear-gradient(90deg,var(--accent),#a78bfa);"></div>
        <div style="position:absolute;top:18px;right:18px;font-size:24px;opacity:0.2;">✦</div>
        <div style="font-size:12px;font-weight:500;color:var(--muted);letter-spacing:0.5px;margin-bottom:12px;">TOTAL TUGAS</div>
        <div style="font-family:'Syne',sans-serif;font-size:36px;font-weight:800;line-height:1;margin-bottom:8px;color:#a78bfa;">{{ $total }}</div>
        <div style="font-size:12px;color:var(--muted);display:flex;align-items:center;gap:4px;"><span style="color:var(--accent3);">↑ {{ $newThisWeek }}</span> tugas baru minggu ini</div>
    </div>

    <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:22px;position:relative;overflow:hidden;transition:transform 0.2s,border-color 0.2s;animation:fadeUp 0.5s ease both;animation-delay:0.1s;">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;border-radius:16px 16px 0 0;background:linear-gradient(90deg,var(--accent3),#06d6a0);"></div>
        <div style="position:absolute;top:18px;right:18px;font-size:24px;opacity:0.2;">✓</div>
        <div style="font-size:12px;font-weight:500;color:var(--muted);letter-spacing:0.5px;margin-bottom:12px;">SELESAI</div>
        <div style="font-family:'Syne',sans-serif;font-size:36px;font-weight:800;line-height:1;margin-bottom:8px;color:var(--accent3);">{{ $selesai }}</div>
        <div style="height:4px;background:var(--surface2);border-radius:99px;overflow:hidden;margin-top:10px;"><div style="height:100%;border-radius:99px;transition:width 1s ease;width:{{ $total > 0 ? round(($selesai/$total)*100) : 0 }}%;background:var(--accent3);"></div></div>
        <div style="font-size:12px;color:var(--muted);margin-top:6px;">{{ $total > 0 ? round(($selesai/$total)*100) : 0 }}% dari total tugas</div>
    </div>

    <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:22px;position:relative;overflow:hidden;transition:transform 0.2s,border-color 0.2s;animation:fadeUp 0.5s ease both;animation-delay:0.15s;">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;border-radius:16px 16px 0 0;background:linear-gradient(90deg,var(--accent2),#f9a8d4);"></div>
        <div style="position:absolute;top:18px;right:18px;font-size:24px;opacity:0.2;">◷</div>
        <div style="font-size:12px;font-weight:500;color:var(--muted);letter-spacing:0.5px;margin-bottom:12px;">BELUM SELESAI</div>
        <div style="font-family:'Syne',sans-serif;font-size:36px;font-weight:800;line-height:1;margin-bottom:8px;color:var(--accent2);">{{ $belum }}</div>
        <div style="height:4px;background:var(--surface2);border-radius:99px;overflow:hidden;margin-top:10px;"><div style="height:100%;border-radius:99px;transition:width 1s ease;width:{{ $total > 0 ? round(($belum/$total)*100) : 0 }}%;background:var(--accent2);"></div></div>
        <div style="font-size:12px;color:var(--muted);margin-top:6px;">{{ $total > 0 ? round(($belum/$total)*100) : 0 }}% dari total tugas</div>
    </div>

    <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:22px;position:relative;overflow:hidden;transition:transform 0.2s,border-color 0.2s;animation:fadeUp 0.5s ease both;animation-delay:0.2s;">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;border-radius:16px 16px 0 0;background:linear-gradient(90deg,#fbbf24,#f59e0b);"></div>
        <div style="position:absolute;top:18px;right:18px;font-size:24px;opacity:0.2;">⚠</div>
        <div style="font-size:12px;font-weight:500;color:var(--muted);letter-spacing:0.5px;margin-bottom:12px;">TERLAMBAT</div>
        <div style="font-family:'Syne',sans-serif;font-size:36px;font-weight:800;line-height:1;margin-bottom:8px;color:#fbbf24;">{{ $terlambat }}</div>
        <div style="font-size:12px;color:var(--muted);display:flex;align-items:center;gap:4px;"><span style="color:var(--accent2);">⚠ Segera diselesaikan!</span></div>
    </div>
</div>

<!-- Content Grid -->
<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;">
    <!-- Task List Card -->
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;overflow:hidden;animation:fadeUp 0.5s ease both;animation-delay:0.25s;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid var(--border);">
            <div style="font-family:'Syne',sans-serif;font-size:15px;font-weight:700;">Daftar Tugas</div>
            <div style="display:flex;gap:8px;align-items:center;">
                <span style="font-size:12px;color:var(--muted);">Urut:</span>
                <select style="background:var(--surface2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:5px 10px;font-size:12px;font-family:'DM Sans',sans-serif;">
                    <option>Deadline</option>
                    <option>Status</option>
                    <option>Terbaru</option>
                </select>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div style="display:flex;gap:6px;padding:0 24px 16px;padding-top:16px;border-bottom:1px solid var(--border);">
            <a href="{{ route('tasks.index') }}" style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;transition:all 0.2s;text-decoration:none;{{ request('status') ? '' : 'background:rgba(108,99,255,0.15);border-color:rgba(108,99,255,0.3);color:#a78bfa;border:1px solid rgba(108,99,255,0.3);' }}">Semua ({{ $total }})</a>
            <a href="{{ route('tasks.index',['status'=>'belum']) }}" style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;transition:all 0.2s;text-decoration:none;{{ request('status') === 'belum' ? 'background:rgba(108,99,255,0.15);border-color:rgba(108,99,255,0.3);color:#a78bfa;border:1px solid rgba(108,99,255,0.3);' : '' }}">Belum ({{ $belum }})</a>
            <a href="{{ route('tasks.index',['status'=>'favorit']) }}" style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;transition:all 0.2s;text-decoration:none;{{ request('status') === 'favorit' ? 'background:rgba(108,99,255,0.15);border-color:rgba(108,99,255,0.3);color:#a78bfa;border:1px solid rgba(108,99,255,0.3);' : '' }}">Favorit ({{ $favoriteCount }})</a>
            <a href="{{ route('tasks.index',['status'=>'selesai']) }}" style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;transition:all 0.2s;text-decoration:none;{{ request('status') === 'selesai' ? 'background:rgba(108,99,255,0.15);border-color:rgba(108,99,255,0.3);color:#a78bfa;border:1px solid rgba(108,99,255,0.3);' : '' }}">Selesai ({{ $selesai }})</a>
            <a href="{{ route('tasks.index',['status'=>'terlambat']) }}" style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;transition:all 0.2s;text-decoration:none;{{ request('status') === 'terlambat' ? 'background:rgba(108,99,255,0.15);border-color:rgba(108,99,255,0.3);color:#a78bfa;border:1px solid rgba(108,99,255,0.3);' : '' }}">Terlambat ({{ $terlambat }})</a>
        </div>

        <!-- Task Items -->
        <div style="padding:8px 16px;">
            @forelse($tasks as $task)
                <div
                    x-show="!searchQuery || '{{ strtolower($task->judul) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($task->deskripsi) }}'.includes(searchQuery.toLowerCase())"

                    @click='
                        editTaskId = {{ $task->id }};
                        current = {!! json_encode([
                            'id' => $task->id,
                            'judul' => $task->judul,
                            'deskripsi' => $task->deskripsi,
                            'deadline' => $task->deadline->format('d M Y'),
                            'rawDeadline' => $task->deadline->toDateString(),
                            'status' => $task->status,
                        ]) !!};
                        $nextTick(() => {
                            if ($refs.statusForm) $refs.statusForm.action = "/tasks/" + editTaskId;
                            if ($refs.deleteForm) $refs.deleteForm.action = "/tasks/" + editTaskId;
                        });
                    '
                    style="display:flex;align-items:flex-start;gap:14px;padding:16px 8px;border-bottom:1px solid var(--border);cursor:pointer;border-radius:10px;transition:all 0.15s;position:relative;{{ $task->status === 'selesai' ? 'opacity:0.7;' : '' }}"
                    onmouseover="this.style.background='rgba(108,99,255,0.08)'"
                    onmouseout="this.style.background='transparent'"
                >
                    <div style="width:20px;height:20px;border-radius:6px;border:2px solid {{ $task->status === 'selesai' ? 'var(--accent3)' : 'rgba(108,99,255,0.4)' }};flex-shrink:0;margin-top:2px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;background:{{ $task->status === 'selesai' ? 'var(--accent3)' : 'transparent' }};color:{{ $task->status === 'selesai' ? '#000' : 'transparent' }};font-size:11px;">{{ $task->status === 'selesai' ? '✓' : '' }}</div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:14px;font-weight:500;color:{{ $task->status === 'selesai' ? 'var(--muted)' : 'var(--text)' }};margin-bottom:4px;text-decoration:{{ $task->status === 'selesai' ? 'line-through' : 'none' }};">{{ $task->judul }}</div>
                        <div style="display:flex;align-items:center;gap:10px;font-size:12px;color:var(--muted);">
                            @php
                                $isLate = $task->status === 'belum' && $task->deadline->lt(now());
                            @endphp
                            <span style="padding:2px 8px;border-radius:6px;font-size:11px;font-weight:600;letter-spacing:0.3px;background:{{ $task->status === 'selesai' ? 'rgba(67,233,123,0.12)' : ($isLate ? 'rgba(255,101,132,0.12)' : 'rgba(108,99,255,0.12)') }};color:{{ $task->status === 'selesai' ? 'var(--accent3)' : ($isLate ? 'var(--accent2)' : '#a78bfa') }};">{{ $isLate ? 'Terlambat' : ucfirst($task->status) }}</span>
                            <span style="font-size:11px;">📅</span>
                            <span>{{ $task->deadline->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <form method="POST" action="{{ route('tasks.toggleFavorite', $task) }}" onsubmit="event.stopPropagation();" onclick="event.stopPropagation();">
                            @csrf
                            @method('PATCH')
                            <button type="submit" style="background:transparent;border:none;color:{{ $task->favorite ? '#ff6b81' : 'var(--muted)' }};font-size:18px;cursor:pointer;padding:0;line-height:1;transition:color 0.2s;" onmouseover="this.style.color='#ff6b81'" onmouseout="this.style.color='{{ $task->favorite ? '#ff6b81' : 'var(--muted)' }}'">
                                {!! $task->favorite ? '♥' : '♡' !!}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="padding:48px 24px;text-align:center;color:var(--muted);">Tidak ada tugas.</div>
            @endforelse
        </div>
    </div>

    <!-- Right Panel -->
    <div style="display:flex;flex-direction:column;gap:16px;">
        <!-- Progress Card -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:20px;animation:fadeUp 0.5s ease both;animation-delay:0.3s;">
            <div style="font-family:'Syne',sans-serif;font-size:13px;font-weight:700;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;">
                Progress Keseluruhan
                <span style="font-size:11px;color:var(--accent);font-weight:600;font-family:'DM Sans';">{{ $total > 0 ? round(($selesai/$total)*100) : 0 }}%</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:center;gap:24px;padding:20px 0;">
                <!-- SVG Pie Chart -->
                <svg width="120" height="120" style="flex-shrink:0;">
                    <!-- Background circle -->
                    <circle cx="60" cy="60" r="50" fill="none" stroke="var(--surface2)" stroke-width="12"/>
                    <!-- Progress arc -->
                    @php
                        $percentage = $total > 0 ? ($selesai/$total)*100 : 0;
                        $circumference = 2 * pi() * 50;
                        $dashoffset = $circumference - ($percentage / 100) * $circumference;
                    @endphp
                    <circle cx="60" cy="60" r="50" fill="none" stroke="var(--accent3)" stroke-width="12"
                            stroke-dasharray="{{ $circumference }}"
                            stroke-dashoffset="{{ $dashoffset }}"
                            stroke-linecap="round"
                            transform="rotate(-90 60 60)"
                            style="transition: stroke-dashoffset 0.5s ease;"/>
                    <!-- Center text -->
                    <text x="60" y="55" text-anchor="middle" font-size="24" font-weight="800" fill="var(--accent)" font-family="'Syne',sans-serif">
                        {{ $total > 0 ? round(($selesai/$total)*100) : 0 }}%
                    </text>
                    <text x="60" y="75" text-anchor="middle" font-size="10" fill="var(--muted)" font-family="'DM Sans',sans-serif">
                        Selesai
                    </text>
                </svg>

                <!-- Stats -->
                <div style="flex:1;display:flex;flex-direction:column;gap:12px;font-size:13px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:12px;height:12px;border-radius:3px;background:var(--accent3);"></div>
                        <span style="color:var(--text);">Selesai</span>
                        <span style="color:var(--muted);margin-left:auto;">{{ $selesai }}/{{ $total }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:12px;height:12px;border-radius:3px;background:var(--accent2);"></div>
                        <span style="color:var(--text);">Belum Selesai</span>
                        <span style="color:var(--muted);margin-left:auto;">{{ $belum }}/{{ $total }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deadline Card -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:20px;animation:fadeUp 0.5s ease both;animation-delay:0.35s;">
            <div style="font-family:'Syne',sans-serif;font-size:13px;font-weight:700;margin-bottom:16px;">Deadline Terdekat</div>
            <div style="font-size:13px;color:var(--muted);">
                @php
                    $upcomingTasks = $tasks->where('status','belum')->sortBy('deadline')->take(3);
                @endphp
                @forelse($upcomingTasks as $task)
                    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--border);">
                        <div style="width:42px;height:42px;border-radius:10px;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;font-family:'Syne',sans-serif;background:var(--surface2);border:1px solid var(--border);">
                            <div style="font-size:16px;font-weight:800;line-height:1;">{{ $task->deadline->format('d') }}</div>
                            <div style="font-size:10px;font-weight:600;color:var(--muted);text-transform:uppercase;">{{ $task->deadline->format('M') }}</div>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $task->judul }}</div>
                            <div style="font-size:11px;color:var(--muted);">{{ $task->deadline->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:20px 0;color:var(--muted);">Tidak ada deadline.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<template x-teleport="body">
    <div x-show="editTaskId" x-cloak @click.self="editTaskId = null" @keydown.escape="editTaskId = null" style="position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;z-index:99999;padding:16px;overflow-y:auto;">
        <div @click.stop style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:32px;max-width:500px;width:100%;max-height:90vh;overflow-y:auto;animation:slideUp 0.3s ease;margin:auto;">
            <!-- Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
            <h2 style="font-size:20px;font-weight:800;color:#fff;font-family:'Syne',sans-serif;">Edit Tugas</h2>
            <button type="button" @click="editTaskId = null" style="background:none;border:none;color:var(--muted);font-size:24px;cursor:pointer;padding:4px 8px;line-height:1;">✕</button>
        </div>

            <!-- Task Title -->
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Judul Tugas</label>
                <div style="font-size:18px;font-weight:600;color:#000;padding:12px;background:#fff;border-radius:8px;border:1px solid var(--border);" x-text="current.judul"></div>
            </div>

            <!-- Task Description -->
            <div style="margin-bottom:20px;" x-show="current.deskripsi">
                <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Deskripsi</label>
                <div style="font-size:14px;color:#000;padding:12px;background:#fff;border-radius:8px;border:1px solid var(--border);line-height:1.6;" x-text="current.deskripsi"></div>
            </div>

            <!-- Deadline -->
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">📅 Deadline</label>
                <div style="font-size:14px;color:#000;padding:12px;background:#fff;border-radius:8px;border:1px solid var(--border);" x-text="current.deadline"></div>
            </div>

            <!-- Status Update Form -->
            <form x-ref="statusForm" method="POST" action="" style="margin-bottom:20px;" @click.stop>
                @csrf
                @method('PUT')

                 <!-- we only update status here; other fields are not required anymore -->
                 <!-- (they were previously sent as hidden inputs to satisfy validation)
                     validation rules have since been relaxed so they are unnecessary
                     and have been removed to avoid cluttering the request payload -->

                <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Status</label>
                <select x-model="current.status" name="status" style="width:100%;background:var(--surface2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:10px 12px;font-size:14px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;margin-bottom:12px;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                    <option value="belum" style="background:var(--surface);">📝 Belum Selesai</option>
                    <option value="selesai" style="background:var(--surface);">✓ Selesai</option>
                </select>

                <button type="submit" :disabled="!editTaskId" style="width:100%;background:var(--accent);color:#fff;border:none;border-radius:8px;padding:12px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#5b55e8'" onmouseout="this.style.background='var(--accent)'">
                    💾 Simpan Status
                </button>
            </form>

            <!-- Delete Button -->
            <form x-ref="deleteForm" method="POST" action="" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');" @click.stop>
                @csrf
                @method('DELETE')
                <button type="submit" style="width:100%;background:rgba(255,101,132,0.15);color:#ff6584;border:1px solid rgba(255,101,132,0.3);border-radius:8px;padding:12px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,101,132,0.25)'" onmouseout="this.style.background='rgba(255,101,132,0.15)'">
                    🗑️ Hapus Tugas
                </button>
            </form>
        </div>
    </div>
</template>

<style>

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
</style>
</div>
</x-app-layout>

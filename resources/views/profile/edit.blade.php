<x-app-layout>
    <div style="max-width:900px;">
        <!-- Header -->
        <div style="margin-bottom:32px;animation:fadeUp 0.5s ease;">
            <h1 style="font-size:32px;font-weight:800;color:#fff;margin-bottom:8px;font-family:'Syne',sans-serif;">Pengaturan Akun</h1>
            <p style="font-size:14px;color:var(--muted);">Kelola informasi profil dan preferensi keamanan Anda</p>
        </div>

        <!-- Content Grid -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <!-- Left Column -->
            <div>
                <!-- Profile Photo Section -->
                <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:24px;margin-bottom:24px;animation:fadeUp 0.5s ease 0.1s both;">
                    <h3 style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:16px;font-family:'Syne',sans-serif;">Foto Profil</h3>

                    @php
    $avatarUrl = '';
    if (Auth::user()->avatar && preg_match('/^avatars\//', Auth::user()->avatar)) {
        // ensure forward slashes for JS literal
        $avatarUrl = str_replace('\\', '/', asset('storage/' . Auth::user()->avatar));
    }
@endphp
<div x-data='{"fileName":"","preview":@json($avatarUrl)}' style="display:flex;flex-direction:column;align-items:center;text-align:center;gap:16px;">
                        <div x-show="!preview" style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-size:40px;font-weight:700;color:#fff;font-family:'Syne',sans-serif;">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                        <img x-show="preview" :src="preview" alt="avatar" style="width:100px;height:100px;border-radius:50%;object-fit:cover;" />

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="width:100%;" @submit="if(fileName=='') { event.preventDefault(); }">
                            @csrf
                            @method('PATCH')

                            <!-- include hidden name/email so validation passes when only uploading avatar -->
                            <input type="hidden" name="name" value="{{ old('name', $user->name) }}">
                            <input type="hidden" name="email" value="{{ old('email', $user->email) }}">

                            <div style="margin-bottom:8px;">
                                <label for="avatar" style="display:block;cursor:pointer;background:rgba(108,99,255,0.15);border:2px dashed rgba(108,99,255,0.3);border-radius:10px;padding:16px;transition:all 0.2s;text-align:center;font-size:13px;color:var(--text);font-weight:500;">
                                    <span x-text="fileName ? fileName : '📤 Tambahkan Foto'">📤 Tambahkan Foto</span>
                                </label>
                                <input type="file" id="avatar" name="avatar" accept="image/*" style="display:none;" @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        fileName = file.name;
                                        const reader = new FileReader();
                                        reader.onload = e => preview = e.target.result;
                                        reader.readAsDataURL(file);
                                    }
                                ">
                            </div>

                            <p style="font-size:11px;color:var(--muted);margin-bottom:12px;">Max 2MB, JPG, PNG</p>

                            <button type="submit" style="width:100%;background:var(--accent);color:#fff;border:none;border-radius:8px;padding:10px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#5b55e8'" onmouseout="this.style.background='var(--accent)'">
                                Simpan Foto
                            </button>
                        </form>                        @if (session('status') === 'profile-updated')
                            <div style="margin-top:12px;background:rgba(67,233,123,0.15);border:1px solid rgba(67,233,123,0.3);color:var(--accent3);padding:10px 12px;border-radius:8px;font-size:12px;text-align:center;font-weight:500;">
                                ✓ Foto berhasil disimpan
                            </div>
                        @endif                    </div>
                </div>

                <!-- Account Information Form -->
                <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:24px;animation:fadeUp 0.5s ease 0.2s both;">
                    <h3 style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:20px;font-family:'Syne',sans-serif;">Informasi Akun</h3>

                    <form method="POST" action="{{ route('profile.update') }}" style="display:flex;flex-direction:column;gap:16px;">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="name" style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" style="width:100%;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 12px;color:var(--text);font-size:13px;transition:all 0.2s;font-family:'DM Sans',sans-serif;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                            @if($errors->has('name'))<div style="color:#ff6584;font-size:11px;margin-top:4px;">{{ $errors->first('name') }}</div>@endif
                        </div>

                        <div>
                            <label for="email" style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" style="width:100%;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 12px;color:var(--text);font-size:13px;transition:all 0.2s;font-family:'DM Sans',sans-serif;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                            @if($errors->has('email'))<div style="color:#ff6584;font-size:11px;margin-top:4px;">{{ $errors->first('email') }}</div>@endif
                        </div>

                        <button type="submit" style="width:100%;background:var(--accent);color:#fff;border:none;border-radius:8px;padding:12px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;margin-top:8px;" onmouseover="this.style.background='#5b55e8'" onmouseout="this.style.background='var(--accent)'">
                            💾 Simpan Perubahan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <div style="background:rgba(67,233,123,0.15);border:1px solid rgba(67,233,123,0.3);color:var(--accent3);padding:10px 12px;border-radius:8px;font-size:12px;text-align:center;font-weight:500;">
                                ✓ Profil berhasil diperbarui
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Change Password Form -->
                @php
                    $updatePasswordForm = file_get_contents(resource_path('views/profile/partials/update-password-form.blade.php'));
                @endphp
                <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:24px;margin-bottom:24px;animation:fadeUp 0.5s ease 0.3s both;">
                    <h3 style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:20px;font-family:'Syne',sans-serif;">Ubah Kata Sandi</h3>

                    <form method="POST" action="{{ route('password.update') }}" style="display:flex;flex-direction:column;gap:16px;">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="current_password" style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Kata Sandi Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password" style="width:100%;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 12px;color:var(--text);font-size:13px;transition:all 0.2s;font-family:'DM Sans',sans-serif;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                            @if($errors->updatePassword->has('current_password'))<div style="color:#ff6584;font-size:11px;margin-top:4px;">{{ $errors->updatePassword->first('current_password') }}</div>@endif
                        </div>

                        <div>
                            <label for="password" style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Kata Sandi Baru</label>
                            <input type="password" id="password" name="password" autocomplete="new-password" style="width:100%;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 12px;color:var(--text);font-size:13px;transition:all 0.2s;font-family:'DM Sans',sans-serif;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                            @if($errors->updatePassword->has('password'))<div style="color:#ff6584;font-size:11px;margin-top:4px;">{{ $errors->updatePassword->first('password') }}</div>@endif
                        </div>

                        <div>
                            <label for="password_confirmation" style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" style="width:100%;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 12px;color:var(--text);font-size:13px;transition:all 0.2s;font-family:'DM Sans',sans-serif;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                            @if($errors->updatePassword->has('password_confirmation'))<div style="color:#ff6584;font-size:11px;margin-top:4px;">{{ $errors->updatePassword->first('password_confirmation') }}</div>@endif
                        </div>

                        <button type="submit" style="width:100%;background:var(--accent);color:#fff;border:none;border-radius:8px;padding:12px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;margin-top:8px;" onmouseover="this.style.background='#5b55e8'" onmouseout="this.style.background='var(--accent)'">
                            🔒 Perbarui Kata Sandi
                        </button>

                        @if (session('status') === 'password-updated')
                            <div style="background:rgba(67,233,123,0.15);border:1px solid rgba(67,233,123,0.3);color:var(--accent3);padding:10px 12px;border-radius:8px;font-size:12px;text-align:center;font-weight:500;">
                                ✓ Kata sandi berhasil diperbarui
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Delete Account Form -->
                <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:24px;animation:fadeUp 0.5s ease 0.4s both;" x-data="{ showDelete: false }">
                    <h3 style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:20px;font-family:'Syne',sans-serif;">Hapus Akun</h3>

                    <p style="font-size:12px;color:var(--muted);margin-bottom:16px;line-height:1.6;">
                        Menghapus akun Anda akan menghapus semua data secara permanen. Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <button @click="showDelete = !showDelete" type="button" style="width:100%;background:rgba(255,101,132,0.15);color:#ff6584;border:1px solid rgba(255,101,132,0.3);border-radius:8px;padding:10px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;">
                        ⚠️ Hapus Akun
                    </button>

                    <div x-show="showDelete" style="margin-top:16px;padding:16px;background:rgba(255,101,132,0.08);border:1px solid rgba(255,101,132,0.25);border-radius:8px;">
                        <p style="font-size:11px;color:#ff6584;margin-bottom:12px;font-weight:500;">
                            Masukkan password Anda untuk mengkonfirmasi penghapusan akun.
                        </p>

                        <form method="POST" action="{{ route('profile.destroy') }}" style="display:flex;flex-direction:column;gap:12px;">
                            @csrf
                            @method('DELETE')

                            <input type="password" name="password" placeholder="Kata Sandi" style="width:100%;background:var(--surface2);border:1px solid rgba(255,101,132,0.3);border-radius:8px;padding:10px 12px;color:var(--text);font-size:13px;transition:all 0.2s;font-family:'DM Sans',sans-serif;" onfocus="this.style.borderColor='rgba(255,101,132,0.6)'" onblur="this.style.borderColor='rgba(255,101,132,0.3)'">
                            @if($errors->userDeletion->has('password'))<div style="color:#ff6584;font-size:11px;">{{ $errors->userDeletion->first('password') }}</div>@endif

                            <div style="display:flex;gap:8px;">
                                <button type="submit" style="flex:1;background:#ff6584;color:#fff;border:none;border-radius:8px;padding:10px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#ff4567'" onmouseout="this.style.background='#ff6584'">
                                    Hapus Selamanya
                                </button>
                                <button type="button" @click="showDelete = false" style="flex:1;background:var(--surface2);color:var(--text);border:1px solid var(--border);border-radius:8px;padding:10px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </div>
</x-app-layout>

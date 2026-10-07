<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config("app.name", "TaskTrack") }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(["resources/css/app.css", "resources/js/app.js"])
        <style>
            :root {
                --bg: #0a0a0f;
                --surface: #111118;
                --surface2: #16161f;
                --border: rgba(255,255,255,0.07);
                --accent: #6c63ff;
                --accent2: #ff6584;
                --accent3: #43e97b;
                --text: #e8e8f0;
                --muted: #6b6b80;
            }
            * { margin: 0; padding: 0; box-sizing: border-box; }
            [x-cloak] { display: none !important; }
            html { scroll-behavior: smooth; }
            body {
                font-family: "DM Sans", sans-serif;
                background: var(--bg);
                color: var(--text);
                min-height: 100vh;
            }
            .light-theme {
                --bg: #f8fafc;
                --surface: #ffffff;
                --surface2: #f4f6fb;
                --border: rgba(15, 23, 42, 0.12);
                --accent: #4f46e5;
                --accent2: #f97316;
                --accent3: #16a34a;
                --text: #0f172a;
                --muted: #475569;
            }
            .theme-toggle-btn {
                width: 42px;
                height: 42px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 14px;
                border: 1px solid var(--border);
                background: var(--surface2);
                color: var(--text);
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .theme-toggle-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            }
            h1, h2, h3, h4 { font-family: "Syne", sans-serif; }
        </style>
    </head>
    <body>
        <div style="position: fixed; width: 400px; height: 400px; background: rgba(108,99,255,0.12); border-radius: 50%; filter: blur(80px); top: -100px; right: 100px; pointer-events: none; z-index: 0;"></div>
        <div style="position: fixed; width: 300px; height: 300px; background: rgba(67,233,123,0.07); border-radius: 50%; filter: blur(80px); bottom: 100px; right: 300px; pointer-events: none; z-index: 0;"></div>
        <div style="display: flex; min-height: 100vh; position: relative; z-index: 1;">
            @include("layouts.navigation")
            <main style="margin-left: 260px; flex: 1; padding: 32px 36px; position: relative; z-index: 1;">
                {{ $slot }}
            </main>
        </div>
        <script>
            (function() {
                const storedTheme = window.localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = storedTheme || (prefersDark ? 'dark' : 'light');

                function applyTheme(value) {
                    if (value === 'light') {
                        document.documentElement.classList.add('light-theme');
                    } else {
                        document.documentElement.classList.remove('light-theme');
                    }
                    window.localStorage.setItem('theme', value);
                }

                window.toggleTheme = function() {
                    const next = document.documentElement.classList.contains('light-theme') ? 'dark' : 'light';
                    applyTheme(next);
                    return next;
                };

                applyTheme(theme);
            })();
        </script>
    </body>
</html>

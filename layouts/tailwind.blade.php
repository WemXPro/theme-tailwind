<script src="{{ theme()::assets('js/tailwind.min.js?plugins=forms,typography,aspect-ratio') }}"></script>
<script src="{{ theme()::assets('js/flowbite.min.js') }}"></script>

@php
    $allowToggleMode = settings('theme::allow_toggle_mode', 1);
    $defaultMode = settings('theme::default_mode', 'dark');
@endphp

<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    primary: getColors(),
                    gray: @settings('theme::default::theme', '{
                        "50": "#F9FAFB", "100": "#F3F4F6", "200": "#E5E7EB",
                        "300": "#D1D5DB", "400": "#9CA3AF", "500": "#6B7280",
                        "600": "#4B5563", "700": "#374151", "800": "#1F2937",
                        "900": "#111827"
                    }')
                }
            },
            fontFamily: {
                body: ["Inter", "ui-sans-serif", "system-ui", "-apple-system",
                    "Segoe UI", "Roboto", "Helvetica Neue", "Arial",
                    "Noto Sans", "sans-serif", "Apple Color Emoji",
                    "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"],
                sans: ["Inter", "ui-sans-serif", "system-ui", "-apple-system",
                    "Segoe UI", "Roboto", "Helvetica Neue", "Arial",
                    "Noto Sans", "sans-serif", "Apple Color Emoji",
                    "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"]
            }
        }
    };

    if('{{ $allowToggleMode }}' === '0') {
        const currentTheme = '{{ $defaultMode }}';
        if (currentTheme) {
            document.documentElement.classList.add(currentTheme);
        }
    } else {
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    }

    function setColor(color) {
        localStorage.setItem('color', color);
        location.reload();
    }

    function getActiveColor() {
        const activeColor = localStorage.getItem('color');
        return activeColor ? activeColor : "@settings('theme::default::theme-color', 'indigo')";
    }

    function getColors() {
        const color = getActiveColor();
        const colorMap = {
            rose: {"50": "#fff1f2", "100": "#ffe4e6", "200": "#fecdd3", "300": "#fda4af", "400": "#fb7185", "500": "#f43f5e", "600": "#e11d48", "700": "#be123c", "800": "#9f1239", "900": "#881337"},
            pink: {"50": "#fdf2f8", "100": "#fce7f3", "200": "#fbcfe8", "300": "#f9a8d4", "400": "#f472b6", "500": "#ec4899", "600": "#db2777", "700": "#be185d", "800": "#9d174d", "900": "#831843"},
            fuchsia: {"50": "#fdf4ff", "100": "#fae8ff", "200": "#f5d0fe", "300": "#f0abfc", "400": "#e879f9", "500": "#d946ef", "600": "#c026d3", "700": "#a21caf", "800": "#86198f", "900": "#701a75"},
            purple: {"50": "#faf5ff", "100": "#f3e8ff", "200": "#e9d5ff", "300": "#d8b4fe", "400": "#c084fc", "500": "#a855f7", "600": "#9333ea", "700": "#7e22ce", "800": "#6b21a8", "900": "#581c87"},
            violet: {"50": "#f5f3ff", "100": "#ede9fe", "200": "#ddd6fe", "300": "#c4b5fd", "400": "#a78bfa", "500": "#8b5cf6", "600": "#7c3aed", "700": "#6d28d9", "800": "#5b21b6", "900": "#4c1d95"},
            indigo: {"50": "#eef2ff", "100": "#e0e7ff", "200": "#c7d2fe", "300": "#a5b4fc", "400": "#818cf8", "500": "#6366f1", "600": "#4f46e5", "700": "#4338ca", "800": "#3730a3", "900": "#312e81"},
            blue: {"50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a"},
            sky: {"50": "#f0f9ff", "100": "#e0f2fe", "200": "#bae6fd", "300": "#7dd3fc", "400": "#38bdf8", "500": "#0ea5e9", "600": "#0284c7", "700": "#0369a1", "800": "#075985", "900": "#0c4a6e"},
            cyan: {"50": "#ecfeff", "100": "#cffafe", "200": "#a5f3fc", "300": "#67e8f9", "400": "#22d3ee", "500": "#06b6d4", "600": "#0891b2", "700": "#0e7490", "800": "#155e75", "900": "#164e63"},
            teal: {"50": "#f0fdfa", "100": "#ccfbf1", "200": "#99f6e4", "300": "#5eead4", "400": "#2dd4bf", "500": "#14b8a6", "600": "#0d9488", "700": "#0f766e", "800": "#115e59", "900": "#134e4a"},
            emerald: {"50": "#ecfdf5", "100": "#d1fae5", "200": "#a7f3d0", "300": "#6ee7b7", "400": "#34d399", "500": "#10b981", "600": "#059669", "700": "#047857", "800": "#065f46", "900": "#064e3b"},
            green: {"50": "#f0fdf4", "100": "#dcfce7", "200": "#bbf7d0", "300": "#86efac", "400": "#4ade80", "500": "#22c55e", "600": "#16a34a", "700": "#15803d", "800": "#166534", "900": "#14532d"},
            lime: {"50": "#f7fee7", "100": "#ecfccb", "200": "#d9f99d", "300": "#bef264", "400": "#a3e635", "500": "#84cc16", "600": "#65a30d", "700": "#4d7c0f", "800": "#3f6212", "900": "#365314"},
            yellow: {"50": "#fefce8", "100": "#fef9c3", "200": "#fef08a", "300": "#fde047", "400": "#facc15", "500": "#eab308", "600": "#ca8a04", "700": "#a16207", "800": "#854d0e", "900": "#713f12"},
            amber: {"50": "#fffbeb", "100": "#fef3c7", "200": "#fde68a", "300": "#fcd34d", "400": "#fbbf24", "500": "#f59e0b", "600": "#d97706", "700": "#b45309", "800": "#92400e", "900": "#78350f"},
            orange: {"50": "#fff7ed", "100": "#ffedd5", "200": "#fed7aa", "300": "#fdba74", "400": "#fb923c", "500": "#f97316", "600": "#ea580c", "700": "#c2410c", "800": "#9a3412", "900": "#7c2d12"},
            red: {"50": "#fef2f2", "100": "#fee2e2", "200": "#fecaca", "300": "#fca5a5", "400": "#f87171", "500": "#ef4444", "600": "#dc2626", "700": "#b91c1c", "800": "#991b1b", "900": "#7f1d1d"},
            stone: {"50": "#f7f7f7", "100": "#e1e1e1", "200": "#cfcfcf", "300": "#b1b1b1", "400": "#757575", "500": "#4a4a4a", "600": "#333333", "700": "#252525", "800": "#161616", "900": "#0d0d0d"},
            neutral: {"50": "#f9fafb", "100": "#f4f5f7", "200": "#e5e7eb", "300": "#d2d6dc", "400": "#9fa6b2", "500": "#6b7280", "600": "#4b5563", "700": "#374151", "800": "#252f3f", "900": "#161e2e"},
            zinc: {"50": "#f9fafb", "100": "#f4f5f7", "200": "#e5e7eb", "300": "#d2d6dc", "400": "#9fa6b2", "500": "#6b7280", "600": "#4b5563", "700": "#374151", "800": "#252f3f", "900": "#161e2e"},
            gray: {"50": "#f9fafb", "100": "#f4f5f7", "200": "#e5e7eb", "300": "#d2d6dc", "400": "#9fa6b2", "500": "#6b7280", "600": "#4b5563", "700": "#374151", "800": "#252f3f", "900": "#161e2e"},
            slate: {"50": "#f8fafc", "100": "#f1f5f9", "200": "#e2e8f0", "300": "#cbd5e1", "400": "#94a3b8", "500": "#64748b", "600": "#475569", "700": "#334155", "800": "#1e293b", "900": "#0f172a"}
        };
        return colorMap[color] || {};
    }
</script>

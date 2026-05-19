@props([
    'judul' => 'Statistik',
    'nilai' => 0,
    'ikon' => 'bi-info-circle',
    'warna' => '#007bff'
])

<div class="hero-stat" style="border-top: 4px solid {{ $warna }}; padding: 20px; background: rgba(255,255,255,0.1); border-radius: 12px; backdrop-filter: blur(5px);">
    <div style="font-size: 24px; margin-bottom: 10px; color: {{ $warna }}">
        <i class="bi {{ $ikon }}"></i>
    </div>
    <span class="hero-stat-num" style="display: block; font-size: 2.5rem; font-weight: 800; line-height: 1;">
        {{ $nilai }}
    </span>
    <span class="hero-stat-label" style="text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; opacity: 0.9;">
        {{ $judul }}
    </span>
</div>
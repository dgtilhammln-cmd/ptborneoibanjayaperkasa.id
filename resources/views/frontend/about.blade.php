@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'About Us', 'url' => url('/about')]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@if(isset($page))
@include('partials.schema', ['schemaType' => 'aboutpage', 'page' => $page])
@endif

<style>
/* =============================================
   ABOUT PAGE - PREMIUM REDESIGN
   PT. Borneo Iban Jaya Perkasa
   ============================================= */

:root {
    --primary: #1a3fa8;
    --primary-dark: #0f2870;
    --primary-light: #2a5ce8;
    --accent: #f5a623;
    --accent-dark: #d4891a;
    --white: #ffffff;
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --shadow-sm: 0 2px 8px rgba(26,63,168,0.08);
    --shadow-md: 0 8px 32px rgba(26,63,168,0.12);
    --shadow-lg: 0 20px 60px rgba(26,63,168,0.18);
    --shadow-xl: 0 32px 80px rgba(26,63,168,0.24);
    --radius-sm: 8px;
    --radius-md: 16px;
    --radius-lg: 24px;
    --radius-xl: 32px;
    --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ---- GLOBAL ABOUT PAGE ---- */
.about-page-wrap * { box-sizing: border-box; }

/* breadcrumb — using original theme styles */

/* =============================================
   ABOUT SECTION - PREMIUM
   ============================================= */
.about-main {
    background: var(--gray-50);
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}
.about-main::before {
    content: '';
    position: absolute;
    top: -200px;
    right: -200px;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(26,63,168,0.04) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

/* Left Visual Block */
.about-visual-wrap {
    position: relative;
}
.about-image-main {
    position: relative;
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}
.about-image-main img {
    width: 100%;
    height: 440px;
    object-fit: cover;
    display: block;
    transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
}
.about-image-main:hover img { transform: scale(1.04); }
.about-image-main .img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(10,26,80,0.6) 100%);
}
.about-image-badge {
    position: absolute;
    top: 24px;
    left: 24px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(12px);
    border-radius: var(--radius-md);
    padding: 16px 20px;
    box-shadow: var(--shadow-md);
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 180px;
}
.about-image-badge .badge-icon {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, var(--accent), var(--accent-dark));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.about-image-badge .badge-text strong {
    display: block;
    font-size: 26px;
    font-weight: 800;
    color: var(--primary-dark);
    line-height: 1;
}
.about-image-badge .badge-text span {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gray-600);
}
.about-image-secondary {
    position: absolute;
    bottom: -24px;
    right: -20px;
    width: 220px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    border: 4px solid #fff;
}
.about-image-secondary img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    display: block;
}
.about-image-secondary .sec-label {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 10px 14px;
    text-align: center;
}
.about-image-secondary .sec-label span {
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.about-image-secondary .sec-label .stars { color: var(--accent); font-size: 11px; margin-top: 2px; display: block; }

/* Counter Grid */
.about-counter-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 50px;
}
.counter-card {
    background: #fff;
    border-radius: var(--radius-md);
    padding: 24px 20px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.counter-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    transform: scaleX(0);
    transition: var(--transition);
    transform-origin: left;
}
.counter-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.counter-card:hover::before { transform: scaleX(1); }
.counter-card .num {
    font-size: 38px;
    font-weight: 800;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 8px;
}
.counter-card .num span { font-size: 24px; }
.counter-card p { font-size: 13px; color: var(--gray-600); font-weight: 500; line-height: 1.5; margin: 0; }

/* Right Content */
.about-content-wrap { padding-left: 20px; }
.section-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(26,63,168,0.07);
    border: 1px solid rgba(26,63,168,0.15);
    color: var(--primary);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 8px 18px;
    border-radius: 50px;
    margin-bottom: 24px;
}
.section-label::before {
    content: '';
    width: 6px; height: 6px;
    background: var(--primary);
    border-radius: 50%;
}
.about-heading {
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.15;
    letter-spacing: -1px;
    margin-bottom: 20px;
}
.about-heading .text-highlight {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.about-description {
    font-size: 16px;
    color: var(--gray-600);
    line-height: 1.8;
    margin-bottom: 32px;
}
.about-features-list {
    list-style: none;
    padding: 0; margin: 0 0 36px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.about-features-list li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-700);
}
.about-features-list li .check {
    width: 22px; height: 22px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    color: #fff;
    font-size: 11px;
}
.btn-primary-about {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    padding: 16px 32px;
    border-radius: 50px;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: 0 8px 24px rgba(26,63,168,0.35);
    letter-spacing: 0.3px;
}
.btn-primary-about:hover {
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(26,63,168,0.45);
    color: #fff;
    text-decoration: none;
}
.btn-primary-about .btn-icon {
    width: 28px; height: 28px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px;
    transition: var(--transition);
}
.btn-primary-about:hover .btn-icon { background: rgba(255,255,255,0.3); transform: translateX(3px); }

/* =============================================
   STATS / FACT SECTION
   ============================================= */
.about-stats {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 60%, var(--primary-light) 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}
.about-stats::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath fill-rule='evenodd' d='M11 0l5 20H6l5-20zm42 31a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM0 72h40v4H0v-4zm0-8h31v4H0v-4zm20-16h20v4H20v-4zM0 56h40v4H0v-4zm63-25a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM53 41a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-30 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-28-8a5 5 0 0 0-10 0h10zm10 0a5 5 0 0 1-10 0h10zM56 5a5 5 0 0 0-10 0h10zm10 0a5 5 0 0 1-10 0h10zm-3 46a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM21 0l5 20H16l5-20zm43 64v-4h-4v4h-4v4h4v4h4v-4h4v-4h-4zm5-49a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/%3E%3C/g%3E%3C/svg%3E");
}
.stats-inner { position: relative; z-index: 2; }
.stats-label {
    text-align: center;
    margin-bottom: 50px;
}
.stats-label .pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.9);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 8px 20px;
    border-radius: 50px;
}
.stats-label .pill span { width: 6px; height: 6px; background: var(--accent); border-radius: 50%; }
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2px;
}
.stat-item {
    text-align: center;
    padding: 36px 24px;
    position: relative;
    background: rgba(255,255,255,0.04);
    border-radius: var(--radius-md);
    transition: var(--transition);
}
.stat-item:hover { background: rgba(255,255,255,0.09); transform: translateY(-4px); }
.stat-item .stat-num {
    font-size: clamp(42px, 5vw, 64px);
    font-weight: 900;
    color: #fff;
    line-height: 1;
    margin-bottom: 8px;
    letter-spacing: -2px;
}
.stat-item .stat-num sup { font-size: 0.45em; vertical-align: super; font-weight: 700; }
.stat-item .stat-symbol {
    font-size: 0.5em;
    color: var(--accent);
    font-weight: 900;
    vertical-align: baseline;
}
.stat-item p {
    color: rgba(255,255,255,0.7);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin: 0;
}
.stat-divider {
    width: 1px;
    background: rgba(255,255,255,0.1);
    margin: auto;
}

/* =============================================
   WHY CHOOSE US
   ============================================= */
.about-choose {
    background: var(--gray-50);
    padding: 100px 0 80px;
    position: relative;
}
.choose-left-content { padding-right: 20px; }
.choose-image-wrap {
    position: relative;
    margin-top: 32px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}
.choose-image-wrap img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
}
.choose-image-wrap .img-tag {
    position: absolute;
    bottom: 20px; left: 20px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(12px);
    border-radius: 12px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: var(--shadow-sm);
}
.choose-image-wrap .img-tag .tag-icon {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 16px;
}
.choose-image-wrap .img-tag strong { font-size: 13px; font-weight: 700; color: var(--gray-900); }
.choose-image-wrap .img-tag span { font-size: 11px; color: var(--gray-600); }

/* Choose Right */
.choose-right { padding-left: 20px; }
.choose-header { border-bottom: 2px solid var(--gray-200); padding-bottom: 32px; margin-bottom: 32px; }
.choose-heading {
    font-size: clamp(24px, 2.5vw, 34px);
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.2;
    letter-spacing: -0.8px;
    margin-bottom: 16px;
}
.choose-desc { font-size: 15px; color: var(--gray-600); line-height: 1.75; margin: 0; }

/* Feature Items */
.features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.feature-item {
    background: #fff;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 24px 20px;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.feature-item::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    transform: scaleX(0);
    transform-origin: left;
    transition: var(--transition);
}
.feature-item:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); border-color: rgba(26,63,168,0.2); }
.feature-item:hover::after { transform: scaleX(1); }
.feature-icon {
    width: 48px; height: 48px;
    background: linear-gradient(135deg, rgba(26,63,168,0.08), rgba(26,63,168,0.12));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 14px;
    transition: var(--transition);
}
.feature-item:hover .feature-icon {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
}
.feature-icon img { width: 26px; height: 26px; object-fit: contain; filter: none; }
.feature-item:hover .feature-icon img { filter: brightness(0) invert(1); }
.feature-title { font-size: 14px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px; }
.feature-desc { font-size: 13px; color: var(--gray-600); line-height: 1.65; margin: 0; }

/* =============================================
   HOW WE WORK
   ============================================= */
.about-work {
    background: var(--white);
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}
.about-work::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--gray-200), transparent);
}
.work-header { text-align: center; margin-bottom: 60px; }
.main-heading {
    font-size: clamp(28px, 3vw, 40px);
    font-weight: 800;
    color: var(--gray-900);
    letter-spacing: -1px;
    line-height: 1.2;
}
.sub-para { font-size: 16px; color: var(--gray-600); margin-top: 16px; max-width: 600px; margin-inline: auto; }

.work-steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
.step-card {
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 40px 32px;
    position: relative;
    transition: var(--transition);
    overflow: hidden;
}
.step-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
}
.step-card:hover { background: #fff; box-shadow: var(--shadow-lg); transform: translateY(-6px); border-color: transparent; }
.step-number-badge {
    width: 54px; height: 54px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    font-weight: 900;
    color: #fff;
    margin-bottom: 24px;
    letter-spacing: -1px;
    box-shadow: 0 6px 20px rgba(26,63,168,0.3);
}
.step-connector {
    position: absolute;
    top: 54px; right: -18px;
    z-index: 10;
    display: flex; align-items: center; justify-content: center;
}
.step-connector svg { fill: var(--gray-300); width: 36px; height: 36px; }
.step-title { font-size: 18px; font-weight: 700; color: var(--gray-900); margin-bottom: 12px; }
.step-desc { font-size: 14px; color: var(--gray-600); line-height: 1.7; margin: 0; }

/* =============================================
   VISION MISSION VALUES
   ============================================= */
.about-values {
    background: var(--gray-50);
    padding: 100px 0 80px;
}
.values-left { padding-right: 16px; }
.values-heading {
    font-size: clamp(28px, 3vw, 38px);
    font-weight: 800;
    color: var(--gray-900);
    letter-spacing: -1px;
    line-height: 1.2;
    margin-bottom: 20px;
}
.values-desc { font-size: 15px; color: var(--gray-600); line-height: 1.8; margin-bottom: 36px; }

.value-highlight-card {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: var(--radius-lg);
    padding: 32px;
    margin-bottom: 0;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.value-highlight-card::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 150px; height: 150px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
}
.value-highlight-card h4 {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 12px;
}
.value-highlight-card p { font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.75; margin: 0; }

.values-image-center {
    display: flex;
    align-items: center;
    justify-content: center;
}
.values-img-wrap {
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    width: 100%;
    max-width: 320px;
}
.values-img-wrap img {
    width: 100%;
    height: 480px;
    object-fit: cover;
    display: block;
}

.vm-cards { display: flex; flex-direction: column; gap: 20px; }
.vm-card {
    background: #fff;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 28px;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.vm-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, var(--primary), var(--primary-light));
}
.vm-card:hover { box-shadow: var(--shadow-md); transform: translateX(4px); border-color: rgba(26,63,168,0.15); }
.vm-card-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-size: 18px;
    margin-bottom: 14px;
}
.vm-card-title { font-size: 16px; font-weight: 700; color: var(--gray-900); margin-bottom: 10px; }
.vm-card-text { font-size: 13px; color: var(--gray-600); line-height: 1.75; margin: 0; }

/* =============================================
   TESTIMONIALS
   ============================================= */
.about-testimonials {
    background: var(--gray-900);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}
.about-testimonials::before {
    content: '';
    position: absolute;
    top: -100px; left: -100px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(26,63,168,0.3) 0%, transparent 60%);
    border-radius: 50%;
}
.about-testimonials::after {
    content: '';
    position: absolute;
    bottom: -80px; right: -80px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(245,166,35,0.15) 0%, transparent 60%);
    border-radius: 50%;
}
.test-inner { position: relative; z-index: 2; }
.test-header { text-align: center; margin-bottom: 60px; }
.test-header .pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.85);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 8px 20px;
    border-radius: 50px;
    margin-bottom: 20px;
}
.test-header h2 {
    font-size: clamp(28px, 3.5vw, 46px);
    font-weight: 800;
    color: #fff;
    letter-spacing: -1px;
    line-height: 1.2;
}
.test-header p { font-size: 15px; color: rgba(255,255,255,0.6); margin-top: 16px; max-width: 600px; margin-inline: auto; }

.test-card-new {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-lg);
    padding: 36px 32px;
    transition: var(--transition);
    height: 100%;
}
.test-card-new:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.18); transform: translateY(-4px); }
.test-stars { color: var(--accent); font-size: 13px; margin-bottom: 20px; }
.test-quote { color: rgba(255,255,255,0.85); font-size: 15px; line-height: 1.75; margin-bottom: 28px; font-style: italic; }
.test-author { display: flex; align-items: center; gap: 14px; }
.test-author-img {
    width: 52px; height: 52px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255,255,255,0.15);
}
.test-author-info strong { display: block; font-size: 14px; font-weight: 700; color: #fff; }
.test-author-info span { font-size: 12px; color: rgba(255,255,255,0.5); }

.test-nav-btns { display: flex; gap: 12px; justify-content: center; margin-top: 40px; }
.test-nav-btn {
    width: 50px; height: 50px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.75);
    cursor: pointer;
    transition: var(--transition);
    font-size: 14px;
}
.test-nav-btn:hover { background: var(--primary); border-color: var(--primary); color: #fff; }

/* =============================================
   TEAM SECTION
   ============================================= */
.about-team {
    background: var(--gray-50);
    padding: 100px 0 80px;
    overflow: hidden;
}
.team-header { text-align: center; margin-bottom: 60px; }
.team-card {
    background: #fff;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    transition: var(--transition);
}
.team-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-6px); border-color: transparent; }
.team-card-img {
    position: relative;
    overflow: hidden;
    height: 280px;
}
.team-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.4,0,0.2,1); }
.team-card:hover .team-card-img img { transform: scale(1.08); }
.team-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,26,80,0.85) 0%, transparent 50%);
    opacity: 0;
    transition: var(--transition);
    display: flex; align-items: flex-end; justify-content: center;
    padding-bottom: 20px;
}
.team-card:hover .team-card-overlay { opacity: 1; }
.team-social { display: flex; gap: 8px; }
.team-social a {
    width: 36px; height: 36px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-size: 13px;
    text-decoration: none;
    transition: var(--transition);
    backdrop-filter: blur(6px);
}
.team-social a:hover { background: var(--primary); border-color: var(--primary); }
.team-card-body { padding: 20px 24px 24px; text-align: center; }
.team-name { font-size: 17px; font-weight: 700; color: var(--gray-900); margin-bottom: 5px; }
.team-position {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--primary);
}

/* =============================================
   RESPONSIVE
   ============================================= */
@media (max-width: 991px) {
    .about-content-wrap { padding-left: 0; margin-top: 30px; }
    .choose-left-content { padding-right: 0; }
    .choose-right { padding-left: 0; margin-top: 40px; }
    .values-left { padding-right: 0; margin-bottom: 40px; }
    .work-steps { grid-template-columns: 1fr; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .features-grid { grid-template-columns: 1fr 1fr; }
    .about-image-secondary { display: none; }
}

@media (max-width: 767px) {
    .about-breadcrumb { padding: 80px 0 60px; }
    .about-main, .about-choose, .about-work, .about-values, .about-testimonials, .about-team { padding: 70px 0 50px; }
    .about-stats { padding: 60px 0; }
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .stat-item { padding: 24px 16px; }
    .about-counter-grid { grid-template-columns: 1fr 1fr; }
    .features-grid { grid-template-columns: 1fr; }
    .about-features-list { grid-template-columns: 1fr; }
    .values-img-wrap { max-width: 100%; }
    .values-img-wrap img { height: 300px; }
    .values-image-center { margin: 32px 0; }
    .team-card-img { height: 240px; }
}

@media (max-width: 480px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .about-counter-grid { grid-template-columns: 1fr 1fr; }
    .stat-item .stat-num { font-size: 36px; }
}

/* Scroll animation */
.fade-up {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-up.visible {
    opacity: 1;
    transform: translateY(0);
}
</style>
@endpush

@section('content')
<div class="about-page-wrap">

    {{-- ===================== BREADCRUMB (original) ===================== --}}
    @php
        $breadcrumb = isset($page) && $page ? $page->getSection('breadcrumb', ['title' => 'About Us', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg']) : ['title' => 'About Us', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg'];
    @endphp
    <section class="vl-breadcrumb-bg" style="background-image: url({{ asset($breadcrumb['background_image'] ?? 'assets/img/barfi/shape/breadcrumb-shape.svg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 mx-auto text-center mb-30">
                    <div class="vl-breadcrumb-content">
                        <h2 class="title pb-20">{{ $breadcrumb['title'] ?? 'About Us' }}</h2>
                        <ul>
                            <li><a href="{{ url("/") }}">Home </a></li>
                            <li><i class="fa-light fa-angle-right"></i></li>
                            <li><a class="active" href="{{ url("/about") }}">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== ABOUT SECTION ===================== --}}
    @php
        $aboutSection = isset($page) && $page ? $page->getSection('about_section', []) : [];
        $isAboutActive = ($aboutSection['is_active'] ?? true) !== false;
    @endphp
    @if($isAboutActive)
    <section id="about" class="about-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0 fade-up">
                    <div class="about-visual-wrap">
                        <div class="about-image-main">
                            <img src="{{ asset($aboutSection['image_1'] ?? 'assets/img/barfi/SnowRemovalTwo/about/vl-about2.1.png') }}" alt="PT. Borneo Iban Jaya Perkasa - Jasa Logam">
                            <div class="img-overlay"></div>
                            <div class="about-image-badge">
                                <div class="badge-icon">🏆</div>
                                <div class="badge-text">
                                    <strong>{{ $aboutSection['counter_1_number'] ?? '22+' }}</strong>
                                    <span>Tahun Pengalaman</span>
                                </div>
                            </div>
                        </div>
                        <div class="about-image-secondary">
                            <img src="{{ asset($aboutSection['image_2'] ?? 'assets/img/barfi/SnowRemovalTwo/about/vl-about2.2.png') }}" alt="Produk Logam Berkualitas">
                            <div class="sec-label">
                                <span>Barang Kualitas Bintang 5</span>
                                <span class="stars">★★★★★</span>
                            </div>
                        </div>
                        <div class="about-counter-grid mt-4">
                            <div class="counter-card">
                                <div class="num">{{ $aboutSection['counter_1_number'] ?? '22' }}<span>+</span></div>
                                <p>{{ $aboutSection['counter_1_text'] ?? 'Tahun Pengalaman melayani industri dan otomotif.' }}</p>
                            </div>
                            <div class="counter-card">
                                <div class="num">1K<span>+</span></div>
                                <p>{{ $aboutSection['counter_2_text'] ?? 'Proyek Selesai dengan kepuasan pelanggan tinggi.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 fade-up" style="transition-delay: 0.15s;">
                    <div class="about-content-wrap">
                        <div class="section-label">{{ $aboutSection['subtitle'] ?? 'Tentang Kami' }}</div>
                        <h2 class="about-heading">
                            {{ $aboutSection['heading'] ?? 'Solusi Terpercaya untuk Kebutuhan' }}
                            <span class="text-highlight"> Jasa Logam & Produksi Sparepart</span>
                        </h2>
                        <p class="about-description">{{ $aboutSection['description'] ?? 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi. Dengan pengalaman sejak 2003, kami melayani kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan.' }}</p>
                        <ul class="about-features-list">
                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Material Kualitas Terbaik</li>
                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Teknisi Berpengalaman</li>
                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Harga Langsung Pabrik</li>
                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Pengiriman Tepat Waktu</li>
                        </ul>
                        <a href="{{ url('/contact') }}" class="btn-primary-about">
                            Lihat Lebih Lanjut
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===================== STATS / FACTS ===================== --}}
    @php
        $factSection = isset($page) && $page ? $page->getSection('fact_section', ['subtitle' => 'Fakta Menarik', 'facts' => []]) : ['subtitle' => 'Fakta Menarik', 'facts' => []];
        $facts = $factSection['facts'] ?? [];
        $isFactActive = ($factSection['is_active'] ?? true) !== false;
    @endphp
    @if($isFactActive)
    <section class="about-stats">
        <div class="container stats-inner">
            <div class="stats-label">
                <div class="pill"><span></span>{{ $factSection['subtitle'] ?? 'Fakta Menarik' }}</div>
            </div>
            <div class="stats-grid">
                @if(count($facts) > 0)
                    @foreach($facts as $fact)
                    <div class="stat-item">
                        <div class="stat-num">{{ $fact['number'] ?? '1000' }}<span class="stat-symbol">{{ $fact['symbol'] ?? '+' }}</span></div>
                        <p>{{ $fact['text'] ?? 'Fakta' }}</p>
                    </div>
                    @endforeach
                @else
                <div class="stat-item fade-up">
                    <div class="stat-num">1000<span class="stat-symbol">+</span></div>
                    <p>Proyek Selesai</p>
                </div>
                <div class="stat-item fade-up" style="transition-delay:0.1s">
                    <div class="stat-num">500<span class="stat-symbol">+</span></div>
                    <p>Klien Puas</p>
                </div>
                <div class="stat-item fade-up" style="transition-delay:0.2s">
                    <div class="stat-num">98<span class="stat-symbol">%</span></div>
                    <p>Tingkat Kepuasan</p>
                </div>
                <div class="stat-item fade-up" style="transition-delay:0.3s">
                    <div class="stat-num">22<span class="stat-symbol">+</span></div>
                    <p>Tahun Pengalaman</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ===================== WHY CHOOSE US ===================== --}}
    @php
        $chooseSection = isset($page) && $page ? $page->getSection('choose_section', []) : [];
        $features = $chooseSection['features'] ?? [];
        $isChooseActive = ($chooseSection['is_active'] ?? true) !== false;
    @endphp
    @if($isChooseActive)
    <section class="about-choose">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 mb-4 mb-lg-0 fade-up">
                    <div class="choose-left-content">
                        <div class="section-label">{{ $chooseSection['subtitle'] ?? 'Mengapa Memilih Kami' }}</div>
                        <div class="choose-image-wrap mt-3">
                            <img src="{{ asset($chooseSection['image'] ?? 'assets/img/barfi/SnowRemovalOne/choose/vl-choose-thumb-inner1.1.png') }}" alt="PT. Borneo Iban Jaya Perkasa - Workshop">
                            <div class="img-tag">
                                <div class="tag-icon"><i class="fa-solid fa-shield-check"></i></div>
                                <div>
                                    <strong>Kualitas Terjamin</strong>
                                    <span style="display:block;font-size:11px;color:#64748b;">ISO Standar Produksi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 fade-up" style="transition-delay:0.15s">
                    <div class="choose-right">
                        <div class="choose-header">
                            <h2 class="choose-heading">{{ $chooseSection['heading'] ?? 'Komitmen Kami untuk Memberikan Solusi Terbaik dalam Jasa Logam dan Produksi Sparepart' }}</h2>
                            <p class="choose-desc">{{ $chooseSection['description'] ?? 'Dengan pengalaman lebih dari 22 tahun, PT. Borneo Iban Jaya Perkasa telah membangun reputasi sebagai mitra terpercaya dalam industri jasa logam dan produksi sparepart. Kami menggabungkan keahlian teknis, peralatan modern, dan komitmen terhadap kualitas.' }}</p>
                        </div>
                        <div class="features-grid">
                            @if(count($features) > 0)
                                @foreach($features as $feature)
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <img src="{{ asset($feature['icon'] ?? 'assets/img/barfi/icon/vl-chos-icon-ab-1.1.svg') }}" alt="{{ $feature['title'] ?? '' }}">
                                    </div>
                                    <h4 class="feature-title">{{ $feature['title'] ?? 'Feature' }}</h4>
                                    <p class="feature-desc">{{ $feature['description'] ?? '' }}</p>
                                </div>
                                @endforeach
                            @else
                            <div class="feature-item">
                                <div class="feature-icon"><img src="{{ asset('assets/img/barfi/icon/vl-chos-icon-ab-1.1.svg') }}" alt="Tenaga Ahli"></div>
                                <h4 class="feature-title">Tenaga Ahli Berpengalaman</h4>
                                <p class="feature-desc">Tim kami terdiri dari profesional terlatih dengan pengalaman bertahun-tahun dalam menangani berbagai kebutuhan jasa logam.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon"><img src="{{ asset('assets/img/barfi/icon/vl-chos-icon-ab-1.2.svg') }}" alt="Peralatan Modern"></div>
                                <h4 class="feature-title">Peralatan Modern & Teknologi Terkini</h4>
                                <p class="feature-desc">Kami menggunakan mesin dan peralatan modern dengan teknologi terkini untuk menghasilkan produk dengan presisi tinggi.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon"><img src="{{ asset('assets/img/barfi/icon/vl-chos-icon-ab-1.3.svg') }}" alt="Kepuasan Pelanggan"></div>
                                <h4 class="feature-title">Jaminan Kepuasan Pelanggan</h4>
                                <p class="feature-desc">Kami berkomitmen memberikan pelayanan terbaik dan memastikan setiap klien mendapatkan hasil yang memuaskan.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon"><img src="{{ asset('assets/img/barfi/icon/vl-chos-icon-ab-1.4.svg') }}" alt="Layanan Lengkap"></div>
                                <h4 class="feature-title">Layanan Lengkap & Terintegrasi</h4>
                                <p class="feature-desc">Dari jasa bubut, stamping, plong, moulding hingga produksi sparepart — solusi lengkap dalam satu tempat.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon"><img src="{{ asset('assets/img/barfi/icon/vl-chos-icon-ab-1.5.svg') }}" alt="Tepat Waktu"></div>
                                <h4 class="feature-title">Tepat Waktu & Dapat Diandalkan</h4>
                                <p class="feature-desc">Kami memahami pentingnya ketepatan waktu dalam industri. Setiap proyek diselesaikan sesuai jadwal yang disepakati.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon"><img src="{{ asset('assets/img/barfi/icon/vl-chos-icon-ab-1.6.svg') }}" alt="Berpengalaman"></div>
                                <h4 class="feature-title">Terpercaya Sejak 2003</h4>
                                <p class="feature-desc">Lebih dari 22 tahun melayani berbagai industri dengan integritas tinggi dan komitmen terhadap kepuasan pelanggan.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===================== HOW WE WORK ===================== --}}
    @php
        $workSection = isset($page) && $page ? $page->getSection('work_section', []) : [];
        $isWorkActive = isset($page) && $page ? $page->isSectionActive('work_section') : true;
        $steps = $workSection['steps'] ?? [];
    @endphp
    @if($isWorkActive)
    <section id="work" class="about-work">
        <div class="container">
            <div class="work-header fade-up">
                <div class="section-label" style="justify-content:center;">{{ $workSection['subtitle'] ?? 'Cara Kami Bekerja' }}</div>
                <h2 class="main-heading mt-3">{{ $workSection['heading'] ?? 'Proses Kerja yang Terstruktur dan Profesional' }}</h2>
            </div>
            <div class="work-steps">
                @if(is_array($steps) && count($steps) > 0)
                    @foreach($steps as $step)
                    <div class="step-card fade-up">
                        <div class="step-number-badge">{{ $step['number'] ?? '01' }}</div>
                        <h3 class="step-title">{{ $step['title'] ?? 'Step' }}</h3>
                        <p class="step-desc">{{ $step['description'] ?? '' }}</p>
                    </div>
                    @endforeach
                @else
                <div class="step-card fade-up">
                    <div class="step-number-badge">01</div>
                    <h3 class="step-title">Konsultasi & Permintaan Penawaran</h3>
                    <p class="step-desc">Hubungi kami melalui telepon, WhatsApp, atau email. Jelaskan kebutuhan proyek Anda dan kami akan memberikan konsultasi serta penawaran yang sesuai.</p>
                </div>
                <div class="step-card fade-up" style="transition-delay:0.1s">
                    <div class="step-number-badge">02</div>
                    <h3 class="step-title">Analisis & Perencanaan</h3>
                    <p class="step-desc">Tim kami akan menganalisis kebutuhan Anda secara detail, merencanakan proses produksi, dan menentukan spesifikasi yang tepat untuk hasil optimal.</p>
                </div>
                <div class="step-card fade-up" style="transition-delay:0.2s">
                    <div class="step-number-badge">03</div>
                    <h3 class="step-title">Produksi & Quality Control</h3>
                    <p class="step-desc">Proses produksi dilakukan dengan standar kualitas tinggi, dilengkapi quality control di setiap tahap untuk memastikan hasil sesuai spesifikasi yang diminta.</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ===================== VALUES ===================== --}}
    @php
        $valueSection = isset($page) && $page ? $page->getSection('value_section', []) : [];
        $isValueActive = isset($page) && $page ? $page->isSectionActive('value_section') : true;
    @endphp
    @if($isValueActive)
    <section class="about-values">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-5 mb-4 mb-lg-0 fade-up">
                    <div class="values-left">
                        <div class="section-label">{{ $valueSection['subtitle'] ?? 'Nilai-Nilai Kami' }}</div>
                        <h2 class="values-heading mt-3">{{ $valueSection['heading'] ?? 'Komitmen terhadap Kualitas, Ketepatan Waktu, dan Kepuasan Pelanggan' }}</h2>
                        <p class="values-desc">{{ $valueSection['description'] ?? 'Dengan peralatan modern, tim yang terlatih, dan komitmen terhadap keamanan serta keandalan, kami memberikan solusi jasa logam dan produksi sparepart yang efisien.' }}</p>
                        <div class="value-highlight-card">
                            <h4>Mengapa Kami Berbeda</h4>
                            <p>Setiap proyek ditangani dengan profesionalisme tinggi untuk memastikan hasil yang memuaskan dan sesuai dengan kebutuhan industri Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-2 d-none d-lg-flex values-image-center fade-up" style="transition-delay:0.1s">
                    <div class="values-img-wrap">
                        <img src="{{ asset($valueSection['image'] ?? 'assets/img/barfi/SnowRemovalOne/service/vl-value-thumb1.1.png') }}" alt="PT. Borneo Iban Jaya Perkasa - Nilai">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 fade-up" style="transition-delay:0.2s">
                    <div class="vm-cards">
                        <div class="vm-card">
                            <div class="vm-card-icon"><i class="fa-solid fa-bullseye"></i></div>
                            <h4 class="vm-card-title">{{ $valueSection['mission_title'] ?? 'Misi Kami' }}</h4>
                            <p class="vm-card-text">{{ $valueSection['mission_text'] ?? 'Menyediakan produk dan jasa berkualitas tinggi yang memenuhi kebutuhan pelanggan melalui program pemasaran terbaik. Mengembangkan karyawan berkompeten dengan menciptakan lingkungan kerja yang mendukung kepuasan pelanggan.' }}</p>
                        </div>
                        <div class="vm-card">
                            <div class="vm-card-icon"><i class="fa-solid fa-eye"></i></div>
                            <h4 class="vm-card-title">{{ $valueSection['vision_title'] ?? 'Visi Kami' }}</h4>
                            <p class="vm-card-text">{{ $valueSection['vision_text'] ?? 'Menjadi perusahaan industri dan jasa yang mampu bersaing dan berkembang dengan sehat, mengutamakan pelayanan, mutu, dan reputasi global. Kami berkomitmen untuk menjadi mitra terpercaya dalam industri jasa logam.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===================== TESTIMONIALS ===================== --}}
    @php
        use App\Models\HomeSection;
        $testimonialSection = isset($page) && $page ? $page->getSection('testimonial_section', []) : [];
        $isTestimonialActive = isset($page) && $page ? $page->isSectionActive('testimonial_section') : true;
    @endphp
    @if($isTestimonialActive)
    @php
        $testimonialsSection = HomeSection::getByKey('testimonials', false);
        $testimonialsItems = collect();
        if ($testimonialsSection && $testimonialsSection->is_active === true) {
            $testimonialsItems = $testimonialsSection->items;
        }
    @endphp
    @if($testimonialsItems->count() > 0)
    <section id="testimonial" class="about-testimonials">
        <div class="container test-inner">
            <div class="test-header fade-up">
                <div class="pill">SUARA KLIEN</div>
                <h2>{{ $testimonialsSection->heading ?? 'Klien Kami Puas dengan Hasil yang Kami Berikan' }}</h2>
                @if($testimonialsSection->description)
                <p>{{ $testimonialsSection->description }}</p>
                @endif
            </div>
            <div class="swiper vlTestActive6">
                <div class="swiper-wrapper">
                    @foreach($testimonialsItems as $item)
                    <div class="swiper-slide">
                        <div class="test-card-new">
                            <div class="test-stars">
                                @for ($i = 0; $i < ($item->extra_data['rating'] ?? 5); $i++)
                                <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <p class="test-quote">"{{ $item->description }}"</p>
                            <div class="test-author">
                                <img class="test-author-img" src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset($item->image) }}" alt="{{ $item->title }}">
                                <div class="test-author-info">
                                    <strong>{{ $item->title }}</strong>
                                    <span>{{ $item->extra_data['position'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="test-nav-btns">
                <div class="test-nav-btn vl-review-button-prev"><i class="fa-regular fa-angle-left"></i></div>
                <div class="test-nav-btn vl-review-button-next"><i class="fa-regular fa-angle-right"></i></div>
            </div>
        </div>
    </section>
    @endif
    @endif

    {{-- ===================== TEAM ===================== --}}
    @php
        $teamSection = isset($page) && $page ? $page->getSection('team_section', []) : [];
        $isTeamActive = isset($page) && $page ? $page->isSectionActive('team_section') : true;
    @endphp
    @if($isTeamActive)
    <section id="team" class="about-team">
        <div class="container">
            <div class="team-header fade-up">
                <div class="section-label" style="justify-content:center;">Tim Kami</div>
                <h2 class="main-heading mt-3">Tim Profesional yang Berpengalaman di Bidang Jasa Logam</h2>
            </div>
            <div class="row">
                @php
                    $teamMembers = [
                        ['name' => 'Ir. Budi Santoso', 'position' => 'Direktur Operasional', 'img' => 'assets/img/barfi/LawnCare/team/vl-team4.1.png'],
                        ['name' => 'Ahmad Rizki, ST', 'position' => 'Manager Produksi', 'img' => 'assets/img/barfi/LawnCare/team/vl-team4.2.png'],
                        ['name' => 'Siti Nurhaliza', 'position' => 'Quality Control Supervisor', 'img' => 'assets/img/barfi/LawnCare/team/vl-team4.3.png'],
                        ['name' => 'Dewi Lestari', 'position' => 'Customer Service Manager', 'img' => 'assets/img/barfi/LawnCare/team/vl-team4.4.png'],
                        ['name' => 'Rudi Hartono', 'position' => 'Teknisi Senior', 'img' => 'assets/img/barfi/LawnCare/team/vl-team4.2.png'],
                    ];
                @endphp
                @foreach($teamMembers as $i => $member)
                <div class="col-xl-{{ $i < 4 ? '3' : '4' }} col-md-6 mb-4 fade-up" style="transition-delay: {{ $i * 0.1 }}s">
                    <div class="team-card">
                        <div class="team-card-img">
                            <img src="{{ asset($member['img']) }}" alt="{{ $member['name'] }}">
                            <div class="team-card-overlay">
                                <div class="team-social">
                                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-card-body">
                            <h4 class="team-name">{{ $member['name'] }}</h4>
                            <p class="team-position">{{ $member['position'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('partials.cta')

    <!-- progress -->
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
    </div>

</div>

<script>
(function() {
    // Scroll-triggered fade-up animations
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.fade-up').forEach(function(el) {
        observer.observe(el);
    });

    // Counter odometer animation
    function animateCounter(el, target, suffix) {
        var start = 0;
        var duration = 2000;
        var startTime = null;
        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target) + suffix;
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    var statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var numEl = entry.target.querySelector('.stat-num');
                if (numEl && !numEl.dataset.animated) {
                    numEl.dataset.animated = '1';
                    var text = numEl.textContent.trim();
                    var symbol = numEl.querySelector('.stat-symbol');
                    var symbolText = symbol ? symbol.textContent : '';
                    var number = parseInt(text.replace(/[^0-9]/g, ''));
                    if (!isNaN(number)) {
                        animateCounter(numEl, number, '<span class="stat-symbol">' + symbolText + '</span>');
                        numEl.innerHTML = '0<span class="stat-symbol">' + symbolText + '</span>';
                        setTimeout(function() {
                            animateCounter({set: function(v) { numEl.innerHTML = v; }}, number, '');
                            var start = 0;
                            var dur = 2000;
                            var s = null;
                            requestAnimationFrame(function step(ts) {
                                if (!s) s = ts;
                                var p = Math.min((ts - s) / dur, 1);
                                var e = 1 - Math.pow(1 - p, 3);
                                numEl.innerHTML = Math.floor(e * number) + '<span class="stat-symbol">' + symbolText + '</span>';
                                if (p < 1) requestAnimationFrame(step);
                            });
                        }, 10);
                    }
                }
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.stat-item').forEach(function(el) {
        statsObserver.observe(el);
    });
})();
</script>
@endsection
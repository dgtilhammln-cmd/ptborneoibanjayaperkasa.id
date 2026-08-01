<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

    :root {
        --blue-deep: #0A1A6B;
        --blue-primary: #1636CC;
        --blue-mid: #0A23A0;
        --blue-dark: #071880;
        --accent-green: #4ADE80;
        --font-main: 'Plus Jakarta Sans', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: var(--font-main);
        background: #EEF2FF;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    /* --- LOADING OVERLAY --- */
    #auth-loader {
        position: fixed;
        inset: 0;
        background: rgba(6, 15, 80, 0.97);
        backdrop-filter: blur(12px);
        z-index: 9999;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: opacity 0.4s ease;
    }
    .loader-ring {
        width: 72px; height: 72px;
        border-radius: 50%;
        border: 2px solid rgba(22, 54, 204, 0.2);
        border-top: 2px solid var(--blue-primary);
        animation: spin 0.9s linear infinite;
    }
    .loader-logo {
        position: absolute;
        width: 28px;
        animation: pulse 1.6s ease-in-out infinite;
    }
    .loader-text {
        margin-top: 28px;
        font-size: 0.65rem;
        letter-spacing: 4px;
        color: var(--blue-primary);
        font-weight: 700;
        text-transform: uppercase;
    }
    @keyframes spin  { to { transform: rotate(360deg); } }
    @keyframes pulse { 0%,100%{opacity:.3;transform:scale(.9)} 50%{opacity:1;transform:scale(1.1)} }

    /* --- MAIN CARD --- */
    .login-wrapper {
        width: 100%;
        max-width: 880px;
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 40px 100px rgba(10, 26, 107, 0.18);
        display: flex;
        min-height: 560px;
    }

    /* --- LEFT PANEL --- */
    .panel-left {
        flex: 0 0 42%;
        background: linear-gradient(145deg, #1636CC 0%, #0A23A0 60%, #071880 100%);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 32px;
        overflow: hidden;
    }
    .panel-left::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 75% 15%, rgba(255,255,255,0.09) 0%, transparent 55%);
    }
    .panel-left::after {
        content: '';
        position: absolute;
        bottom: -80px; right: -80px;
        width: 280px; height: 280px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.06);
    }

    .brand-header {
        position: absolute;
        top: 28px; left: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 2;
    }
    .brand-logo-img {
        height: 36px;
        filter: brightness(0) invert(1);
    }

    /* Dot grid decoration */
    .dot-grid {
        position: absolute;
        top: 80px; right: 24px;
        display: grid;
        grid-template-columns: repeat(5, 6px);
        gap: 6px;
        opacity: 0.15;
    }
    .dot-grid span {
        width: 6px; height: 6px;
        background: #fff;
        border-radius: 50%;
        display: block;
    }

    /* Mini card widget */
    .mini-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 16px;
        padding: 16px 18px;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }
    .mini-card-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mc-label { color: rgba(255,255,255,0.5); font-size: 9px; text-transform: uppercase; letter-spacing: 1.5px; }
    .mc-value { color: #fff; font-size: 14px; font-weight: 700; margin-top: 3px; }
    .mc-badge {
        color: var(--accent-green);
        font-size: 12px;
        font-weight: 700;
        background: rgba(74, 222, 128, 0.1);
        padding: 3px 10px;
        border-radius: 20px;
    }

    .left-tag {
        display: inline-block;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.7);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }
    .left-headline {
        color: #fff;
        font-size: 26px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }
    .left-sub {
        color: rgba(255,255,255,0.5);
        font-size: 11px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* --- RIGHT PANEL --- */
    .panel-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 48px 44px;
    }
    .right-title {
        font-size: 26px;
        font-weight: 800;
        color: var(--blue-deep);
        margin-bottom: 4px;
    }
    .right-sub {
        color: #8899BB;
        font-size: 12px;
        margin-bottom: 32px;
    }

    /* Form */
    .form-label-lux {
        display: block;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #8899BB;
        margin-bottom: 8px;
    }
    .input-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #FAFBFF;
        border: 1.5px solid #E5EAF5;
        border-radius: 12px;
        padding: 0 14px;
        margin-bottom: 20px;
        transition: border-color 0.25s, background 0.25s, transform 0.2s;
    }
    .input-wrap:focus-within {
        border-color: var(--blue-primary);
        background: #ffffff;
        transform: translateY(-1px);
    }
    .input-wrap svg { opacity: 0.35; flex-shrink: 0; }
    .input-wrap input {
        border: none;
        background: transparent;
        padding: 14px 4px;
        font-size: 13px;
        color: var(--blue-deep);
        outline: none;
        width: 100%;
        font-family: var(--font-main);
    }
    .input-wrap input::placeholder { color: #BCC5DC; }

    /* Toggle password */
    .toggle-pw {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        opacity: 0.4;
        transition: opacity 0.2s;
        flex-shrink: 0;
    }
    .toggle-pw:hover { opacity: 0.8; }
    .toggle-pw:focus { outline: none; }

    /* Row keep + forgot */
    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }
    .keep-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #8899BB;
        cursor: pointer;
    }
    .keep-label input[type="checkbox"] {
        accent-color: var(--blue-primary);
        width: 15px;
        height: 15px;
        cursor: pointer;
    }
    .forgot-link {
        font-size: 12px;
        font-weight: 700;
        color: var(--blue-primary);
        text-decoration: none;
        transition: opacity 0.2s;
    }
    .forgot-link:hover { opacity: 0.7; }

    /* Submit */
    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-mid) 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 16px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        cursor: pointer;
        transition: opacity 0.25s, transform 0.25s, box-shadow 0.25s;
        font-family: var(--font-main);
    }
    .btn-login:hover {
        opacity: 0.92;
        transform: translateY(-2px);
        box-shadow: 0 16px 32px rgba(22, 54, 204, 0.3);
    }
    .btn-login:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .right-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 9px;
        color: #C5CFDF;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    /* Error styles */
    .error-msg {
        color: #E24B4A;
        font-size: 11px;
        margin-top: -14px;
        margin-bottom: 12px;
        display: block;
    }

    /* --- MOBILE RESPONSIVE --- */
    @media (max-width: 680px) {
        body { padding: 0; align-items: stretch; }
        .login-wrapper {
            flex-direction: column;
            border-radius: 0;
            min-height: 100vh;
            box-shadow: none;
        }
        .panel-left {
            flex: 0 0 auto;
            min-height: 200px;
            padding: 80px 24px 24px;
        }
        .brand-header { top: 20px; left: 20px; }
        .dot-grid { display: none; }
        .left-headline { font-size: 20px; }
        .panel-right { padding: 32px 24px 40px; }
    }

    @media (max-width: 400px) {
        .panel-right { padding: 24px 18px 32px; }
    }
</style>

<!-- LOADING OVERLAY -->
<div id="auth-loader">
    <div style="position:relative;display:flex;align-items:center;justify-content:center;">
        <div class="loader-ring"></div>
        <img src="{{ asset('assets/images/logoborneo.webp') }}" class="loader-logo" alt="Borneo">
    </div>
    <div class="loader-text">Verifying Credentials...</div>
</div>

<div class="login-wrapper">

    <!-- LEFT PANEL -->
    <div class="panel-left">
        <div class="brand-header">
            <img src="{{ asset('assets/images/logoborneo.webp') }}" alt="Borneo" class="brand-logo-img">
        </div>

        <!-- Dot grid decoration -->
        <div class="dot-grid">
            @for ($i = 0; $i < 25; $i++)
                <span></span>
            @endfor
        </div>


        <div class="left-headline">PT. Borneo<br>Iban Jaya Perkasa</div>
        <p class="left-sub">Admin Panel untuk mengelola aset digital Anda dengan aman dan efisien.</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="panel-right">
        <div class="right-title">Welcome Back</div>
        <div class="right-sub">Sign in to continue to your dashboard</div>

        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email -->
            <label class="form-label-lux">Access Identity</label>
            <div class="input-wrap">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z" stroke="#1636CC" stroke-width="1.5"/>
                    <path d="M22 6l-10 7L2 6" stroke="#1636CC" stroke-width="1.5"/>
                </svg>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email Address"
                    required
                    autofocus
                    autocomplete="email"
                >
            </div>
            @error('email')
                <span class="error-msg">{{ $message }}</span>
            @enderror

            <!-- Password -->
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                <label class="form-label-lux" style="margin-bottom:0;">Security Key</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot?</a>
                @endif
            </div>
            <div class="input-wrap" id="pw-wrap">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="11" width="18" height="11" rx="2" stroke="#1636CC" stroke-width="1.5"/>
                    <path d="M7 11V7a5 5 0 0110 0v4" stroke="#1636CC" stroke-width="1.5"/>
                </svg>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
                <button type="button" class="toggle-pw" id="togglePw" title="Show/hide password" aria-label="Toggle password visibility">
                    <!-- Eye icon -->
                    <svg id="eye-open" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#1636CC" stroke-width="1.5"/>
                        <circle cx="12" cy="12" r="3" stroke="#1636CC" stroke-width="1.5"/>
                    </svg>
                    <!-- Eye-off icon (hidden by default) -->
                    <svg id="eye-off" width="16" height="16" viewBox="0 0 24 24" fill="none" style="display:none;">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94" stroke="#1636CC" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19" stroke="#1636CC" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M1 1l22 22" stroke="#1636CC" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="error-msg">{{ $message }}</span>
            @enderror

            <!-- Remember me -->
            <div class="form-row">
                <label class="keep-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    Stay authorized on this device
                </label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login" id="submitBtn">
                Login
            </button>
        </form>

        <div class="right-footer">Encrypted End-to-End &copy; 2026</div>
    </div>

</div>

<script>
    // Toggle password visibility
    (function() {
        var btn   = document.getElementById('togglePw');
        var input = document.getElementById('password');
        var open  = document.getElementById('eye-open');
        var off   = document.getElementById('eye-off');

        btn.addEventListener('click', function() {
            var isHidden = input.type === 'password';
            input.type   = isHidden ? 'text' : 'password';
            open.style.display = isHidden ? 'none'  : 'block';
            off.style.display  = isHidden ? 'block' : 'none';
            btn.style.opacity  = isHidden ? '0.9'   : '0.4';
        });
    })();

    // Loading overlay on submit
    document.getElementById('loginForm').addEventListener('submit', function() {
        var loader = document.getElementById('auth-loader');
        var btn    = document.getElementById('submitBtn');

        loader.style.display  = 'flex';
        loader.style.opacity  = '0';
        loader.style.transition = 'opacity 0.4s ease';
        setTimeout(function() { loader.style.opacity = '1'; }, 10);

        btn.disabled   = true;
        btn.innerText  = 'Processing...';
    });
</script>
</x-guest-layout>
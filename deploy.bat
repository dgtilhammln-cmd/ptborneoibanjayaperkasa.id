@echo off
setlocal enabledelayedexpansion
chcp 65001 > nul

:: =====================================================
::  DEPLOY - PT Borneo Iban Jaya Perkasa
::  Hanya push file yang BERUBAH (bukan semua folder)
::  Lalu SSH ke Hostinger untuk git pull otomatis
:: =====================================================

set GIT_REPO=https://github.com/dgtilhammln-cmd/ptborneoibanjayaperkasa.id.git
set GIT_BRANCH=main
set SSH_HOST=u664715641@46.202.186.86
set SSH_PORT=65002
set REMOTE_DIR=/home/u664715641/domains/ptborneoibanjayaperkasa.id/public_html

echo.
echo  =====================================================
echo   DEPLOY - ptborneoibanjayaperkasa.id
echo  =====================================================
echo.

:: Commit message: dari argumen atau otomatis
set COMMIT_MSG=%~1
if "!COMMIT_MSG!"=="" (
    for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value 2^>nul') do set DT=%%I
    set COMMIT_MSG=Update: !DT:~0,4!-!DT:~4,2!-!DT:~6,2! !DT:~8,2!:!DT:~10,2!
)

:: ── Step 1: Tampilkan file yang berubah ──────────────
echo [1/4] File yang berubah:
echo -----------------------------------------------
git status --short
echo -----------------------------------------------
echo.

:: git add -u = HANYA file yang sudah ditrack dan berubah
:: (TIDAK termasuk file/folder baru yang belum pernah di-add)
git add -u
if errorlevel 1 ( echo [ERROR] git add -u gagal & pause & exit /b 1 )

:: Cek apakah ada yang di-stage
git diff --cached --quiet 2>nul
if not errorlevel 1 (
    echo [INFO] Tidak ada perubahan pada file yang sudah ditrack.
    echo        Langsung lanjut push + deploy server...
    goto :PUSH
)

:: ── Step 2: Commit ────────────────────────────────────
echo [2/4] Commit: "!COMMIT_MSG!"
echo       File yang masuk commit:
git diff --cached --name-only
echo.
git commit -m "!COMMIT_MSG!"
if errorlevel 1 ( echo [ERROR] commit gagal & pause & exit /b 1 )

:PUSH
:: ── Step 3: Push ke GitHub ───────────────────────────
echo [3/4] Push ke GitHub (%GIT_BRANCH%)...
git push origin %GIT_BRANCH%
if errorlevel 1 (
    echo [ERROR] git push gagal. Coba: git pull origin main --rebase
    pause & exit /b 1
)
echo       Push GitHub: OK

:: ── Step 4: SSH ke Hostinger ─────────────────────────
echo.
echo [4/4] SSH ke server Hostinger...
echo       Host: %SSH_HOST% - Port: %SSH_PORT%
echo       (masukkan password SSH jika diminta)
echo.

ssh -p %SSH_PORT% -o StrictHostKeyChecking=no -o ConnectTimeout=20 %SSH_HOST% "cd %REMOTE_DIR% && git remote set-url origin %GIT_REPO% && git pull origin %GIT_BRANCH% && php artisan config:cache && php artisan view:cache && php artisan route:cache && echo '' && echo '=== SERVER UPDATED OK ==='"

if errorlevel 1 (
    echo.
    echo [ERROR] SSH gagal atau error di server.
    echo.
    echo [TIP] Setup SSH key agar tidak perlu password setiap deploy:
    echo   1. ssh-keygen -t ed25519
    echo   2. type %%USERPROFILE%%\.ssh\id_ed25519.pub ^| ssh -p %SSH_PORT% %SSH_HOST% "mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys"
    echo.
    pause
    exit /b 1
)

echo.
echo  =====================================================
echo   DEPLOY BERHASIL!
echo   GitHub : %GIT_REPO%
echo   Live   : https://ptborneoibanjayaperkasa.id
echo  =====================================================
echo.
pause
endlocal

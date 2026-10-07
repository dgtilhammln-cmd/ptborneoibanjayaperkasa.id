@echo off
setlocal enabledelayedexpansion
chcp 65001 > nul

:: ══════════════════════════════════════════════════════════════════
::  DEPLOY SCRIPT - PT Borneo Iban Jaya Perkasa
::  Otomatis: Git commit+push ke GitHub, lalu SSH pull ke Hostinger
:: ══════════════════════════════════════════════════════════════════

set GIT_REPO=https://github.com/dgtilhammln-cmd/ptborneoibanjayaperkasa.id.git
set GIT_BRANCH=main
set SSH_HOST=u664715641@46.202.186.86
set SSH_PORT=65002
set REMOTE_DIR=/home/u664715641/domains/ptborneoibanjayaperkasa.id/public_html

echo.
echo  ================================================
echo   DEPLOY - ptborneoibanjayaperkasa.id
echo  ================================================
echo.

:: ── Ambil commit message dari argumen atau buat otomatis ──────────
set COMMIT_MSG=%~1
if "!COMMIT_MSG!"=="" (
    for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value 2^>nul') do set DT=%%I
    set COMMIT_MSG=Deploy: update !DT:~0,4!-!DT:~4,2!-!DT:~6,2! !DT:~8,2!:!DT:~10,2!
)

echo [1/4] Menambahkan semua perubahan ke staging...
git add -A
if errorlevel 1 ( echo [ERROR] git add gagal & pause & exit /b 1 )

echo [2/4] Commit: "!COMMIT_MSG!"
git commit -m "!COMMIT_MSG!"
if errorlevel 1 (
    echo [INFO] Tidak ada perubahan baru untuk di-commit, lanjut push...
)

echo [3/4] Push ke GitHub ^(%GIT_BRANCH%^)...
git push origin %GIT_BRANCH%
if errorlevel 1 ( echo [ERROR] git push gagal & pause & exit /b 1 )
echo       GitHub: OK

echo [4/4] Menghubungi server Hostinger via SSH dan menjalankan git pull...
echo       Host : %SSH_HOST%
echo       Port : %SSH_PORT%
echo       Dir  : %REMOTE_DIR%
echo.

ssh -p %SSH_PORT% -o StrictHostKeyChecking=no %SSH_HOST% "cd %REMOTE_DIR% && git pull origin %GIT_BRANCH% && php artisan config:cache && php artisan view:cache && php artisan route:cache && echo 'DEPLOY SELESAI: OK'"

if errorlevel 1 (
    echo.
    echo [ERROR] SSH ke server gagal!
    echo Pastikan SSH key sudah ditambahkan ke server Hostinger.
    echo Jalankan perintah ini untuk setup SSH key pertama kali:
    echo   ssh-copy-id -p %SSH_PORT% %SSH_HOST%
    echo.
    pause
    exit /b 1
)

echo.
echo  ================================================
echo   DEPLOY BERHASIL!
echo   GitHub : https://github.com/dgtilhammln-cmd/ptborneoibanjayaperkasa.id
echo   Server : https://ptborneoibanjayaperkasa.id
echo  ================================================
echo.
pause
endlocal

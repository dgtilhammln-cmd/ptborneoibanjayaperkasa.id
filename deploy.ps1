# ============================================================
# DEPLOY SCRIPT - ptborneoibanjayaperkasa.id
# Usage: .\deploy.ps1 "pesan commit kamu"
# ============================================================

param(
    [string]$CommitMessage = "Update website"
)

$SSH_HOST = "46.202.186.86"
$SSH_PORT  = "65002"
$SSH_USER  = "u664715641"
$REMOTE_PATH = "/home/u664715641/public_html"

Write-Host ""
Write-Host "=======================================" -ForegroundColor Cyan
Write-Host "  DEPLOY - ptborneoibanjayaperkasa.id  " -ForegroundColor Cyan
Write-Host "=======================================" -ForegroundColor Cyan
Write-Host ""

# Step 1: Git add semua perubahan
Write-Host "[1/4] Staging semua perubahan..." -ForegroundColor Yellow
git add .

# Step 2: Git commit
Write-Host "[2/4] Commit: $CommitMessage" -ForegroundColor Yellow
git commit -m "$CommitMessage"

if ($LASTEXITCODE -ne 0) {
    Write-Host "Tidak ada perubahan untuk di-commit, atau terjadi error." -ForegroundColor Red
}

# Step 3: Push ke GitHub
Write-Host "[3/4] Push ke GitHub..." -ForegroundColor Yellow
git push origin main

if ($LASTEXITCODE -ne 0) {
    Write-Host "GAGAL push ke GitHub!" -ForegroundColor Red
    exit 1
}

Write-Host "GitHub updated!" -ForegroundColor Green

# Step 4: Deploy ke server via SSH
Write-Host "[4/4] Deploy ke server via SSH..." -ForegroundColor Yellow
ssh -p $SSH_PORT "${SSH_USER}@${SSH_HOST}" "cd $REMOTE_PATH && git pull origin main && php artisan config:cache && php artisan route:cache && php artisan view:cache"

if ($LASTEXITCODE -ne 0) {
    Write-Host "GAGAL deploy ke server! Cek koneksi SSH." -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "=======================================" -ForegroundColor Green
Write-Host "  DEPLOY SELESAI!  " -ForegroundColor Green
Write-Host "=======================================" -ForegroundColor Green
Write-Host ""

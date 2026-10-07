# =====================================================
#  DEPLOY - PT Borneo Iban Jaya Perkasa
#  Usage  : ./deploy
#  Custom : ./deploy "pesan commit custom"
# =====================================================

param(
    [string]$CommitMessage = ""
)

$GIT_REPO    = "https://github.com/dgtilhammln-cmd/ptborneoibanjayaperkasa.id.git"
$GIT_BRANCH  = "main"
$SSH_USER    = "u664715641"
$SSH_HOST    = "46.202.186.86"
$SSH_PORT    = "65002"
$REMOTE_PATH = "/home/u664715641/domains/ptborneoibanjayaperkasa.id/public_html"

Write-Host ""
Write-Host "  =====================================================" -ForegroundColor Cyan
Write-Host "   DEPLOY - ptborneoibanjayaperkasa.id" -ForegroundColor Cyan
Write-Host "  =====================================================" -ForegroundColor Cyan
Write-Host ""

# ── Commit message: custom atau otomatis timestamp ────────────
if ($CommitMessage -eq "") {
    $CommitMessage = "Update: $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
}

# ── Step 1: Cek file yang berubah ────────────────────────────
Write-Host "[1/4] File yang berubah:" -ForegroundColor Yellow
Write-Host "-----------------------------------------------" -ForegroundColor DarkGray
git status --short
Write-Host "-----------------------------------------------" -ForegroundColor DarkGray
Write-Host ""

# git add -u = HANYA file yang sudah ditrack dan berubah
# (tidak include file/folder baru yang belum pernah di-commit)
git add -u

# Cek apakah ada staged changes
$staged = git diff --cached --name-only
if (-not $staged) {
    Write-Host "[INFO] Tidak ada perubahan file yang ditrack. Lanjut ke server..." -ForegroundColor DarkYellow
} else {
    # ── Step 2: Commit ────────────────────────────────────────
    Write-Host "[2/4] Commit: $CommitMessage" -ForegroundColor Yellow
    Write-Host "      File yang di-commit:" -ForegroundColor DarkGray
    $staged | ForEach-Object { Write-Host "        $_" -ForegroundColor DarkGray }
    Write-Host ""
    git commit -m $CommitMessage
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[ERROR] Commit gagal!" -ForegroundColor Red
        exit 1
    }
}

# ── Step 3: Push ke GitHub ───────────────────────────────────
Write-Host "[3/4] Push ke GitHub ($GIT_BRANCH)..." -ForegroundColor Yellow
git push origin $GIT_BRANCH
if ($LASTEXITCODE -ne 0) {
    Write-Host "[ERROR] Push gagal! Coba: git pull origin main --rebase" -ForegroundColor Red
    exit 1
}
Write-Host "      Push GitHub: OK" -ForegroundColor Green

# ── Step 4: SSH ke Hostinger ─────────────────────────────────
Write-Host ""
Write-Host "[4/4] SSH ke Hostinger ${SSH_USER}@${SSH_HOST} (port $SSH_PORT)..." -ForegroundColor Yellow
Write-Host "      Dir server: $REMOTE_PATH" -ForegroundColor DarkGray
Write-Host ""

$sshCmd = "cd $REMOTE_PATH && git remote set-url origin $GIT_REPO && git pull origin $GIT_BRANCH && php artisan config:cache && php artisan view:cache && php artisan route:cache && echo '' && echo '=== SERVER UPDATED OK ==='"

ssh -p $SSH_PORT -o StrictHostKeyChecking=no "${SSH_USER}@${SSH_HOST}" $sshCmd

if ($LASTEXITCODE -ne 0) {
    Write-Host ""
    Write-Host "[ERROR] Deploy ke server gagal!" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "  =====================================================" -ForegroundColor Green
Write-Host "   DEPLOY BERHASIL!" -ForegroundColor Green
Write-Host "   GitHub : $GIT_REPO" -ForegroundColor Green
Write-Host "   Live   : https://ptborneoibanjayaperkasa.id" -ForegroundColor Green
Write-Host "  =====================================================" -ForegroundColor Green
Write-Host ""

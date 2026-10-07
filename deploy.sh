#!/usr/bin/env bash
# ══════════════════════════════════════════════════════════════════
#  DEPLOY SCRIPT - PT Borneo Iban Jaya Perkasa
#  Gunakan: bash deploy.sh
#  Atau  : bash deploy.sh "pesan commit custom"
# ══════════════════════════════════════════════════════════════════

set -e  # Berhenti otomatis jika ada error

GIT_BRANCH="main"
SSH_HOST="u664715641@46.202.186.86"
SSH_PORT="65002"
REMOTE_DIR="/home/u664715641/domains/ptborneoibanjayaperkasa.id/public_html"

# Warna terminal
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m' # No Color

echo ""
echo -e "${BOLD}${CYAN}  ══════════════════════════════════════════════════${NC}"
echo -e "${BOLD}${CYAN}   DEPLOY - ptborneoibanjayaperkasa.id${NC}"
echo -e "${BOLD}${CYAN}  ══════════════════════════════════════════════════${NC}"
echo ""

# ── Commit message: dari argumen atau otomatis timestamp ──────────
COMMIT_MSG="${1:-"Deploy: update $(date '+%Y-%m-%d %H:%M')"}"

# ── Step 1: Git Add ───────────────────────────────────────────────
echo -e "${YELLOW}[1/4] Menambahkan semua perubahan ke staging...${NC}"
git add -A
echo -e "${GREEN}      git add: OK${NC}"

# ── Step 2: Git Commit ────────────────────────────────────────────
echo -e "${YELLOW}[2/4] Commit: \"${COMMIT_MSG}\"${NC}"
if git diff --cached --quiet; then
    echo -e "      Tidak ada perubahan baru, melewati commit..."
else
    git commit -m "${COMMIT_MSG}"
    echo -e "${GREEN}      Commit: OK${NC}"
fi

# ── Step 3: Git Push ke GitHub ───────────────────────────────────
echo -e "${YELLOW}[3/4] Push ke GitHub (${GIT_BRANCH})...${NC}"
git push origin "${GIT_BRANCH}"
echo -e "${GREEN}      Push GitHub: OK${NC}"

# ── Step 4: SSH ke Hostinger → git pull + artisan cache ──────────
echo -e "${YELLOW}[4/4] SSH ke Hostinger: ${SSH_HOST} (port ${SSH_PORT})${NC}"
echo -e "      Dir: ${REMOTE_DIR}"
echo ""

ssh -p "${SSH_PORT}" \
    -o StrictHostKeyChecking=no \
    -o ConnectTimeout=15 \
    "${SSH_HOST}" \
    "set -e
     echo '--- Masuk ke direktori...'
     cd ${REMOTE_DIR}
     echo '--- Git pull dari GitHub...'
     git pull origin ${GIT_BRANCH}
     echo '--- Membersihkan cache Laravel...'
     php artisan config:cache
     php artisan view:cache
     php artisan route:cache
     echo ''
     echo '  DEPLOY SELESAI: $(date)'
    "

echo ""
echo -e "${BOLD}${GREEN}  ══════════════════════════════════════════════════${NC}"
echo -e "${BOLD}${GREEN}   DEPLOY BERHASIL!${NC}"
echo -e "${GREEN}   GitHub : https://github.com/dgtilhammln-cmd/ptborneoibanjayaperkasa.id${NC}"
echo -e "${GREEN}   Live   : https://ptborneoibanjayaperkasa.id${NC}"
echo -e "${BOLD}${GREEN}  ══════════════════════════════════════════════════${NC}"
echo ""

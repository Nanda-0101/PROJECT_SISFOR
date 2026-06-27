document.addEventListener('DOMContentLoaded', () => {
    console.log('Tutup Sesi Manual — Dimuatkan! 🔒');

    // ─── Element References ───────────────────────────────────────────────────
    const eventSelect   = document.getElementById('eventSelect');
    const emptyState    = document.getElementById('emptyState');
    const loadingState  = document.getElementById('loadingState');
    const sesiGrid      = document.getElementById('sesiGrid');
    const modalSesiNama = document.getElementById('modalSesiNama');
    const btnConfirm    = document.getElementById('btnConfirmTutup');
    const toastMessage  = document.getElementById('toastMessage');

    // ─── State ────────────────────────────────────────────────────────────────
    let currentSesiId   = null;
    let confirmModal    = null;
    let successToast    = null;

    // ─── CSRF Token ───────────────────────────────────────────────────────────
    const csrfToken = () =>
        document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // ─── Bootstrap Component Init ─────────────────────────────────────────────
    const confirmModalEl = document.getElementById('confirmModal');
    if (confirmModalEl) {
        confirmModal = new bootstrap.Modal(confirmModalEl);
    }

    const successToastEl = document.getElementById('successToast');
    if (successToastEl) {
        successToast = new bootstrap.Toast(successToastEl, { delay: 3500 });
    }

    // ─── Event: Pilih Event ───────────────────────────────────────────────────
    if (eventSelect) {
        eventSelect.addEventListener('change', () => {
            const eventId = eventSelect.value;
            if (!eventId) {
                showEmptyState();
                return;
            }
            fetchSesiByEvent(eventId);
        });

        if (eventSelect.value) {
            attachTutupListeners();
        }
    }

    async function fetchSesiByEvent(eventId) {
        showLoadingState();

        try {
            const response = await fetch(`/admin/kelola-sesi/event/${eventId}/sesi`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken(),
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const data = await response.json();
            renderSesiCards(data.sesis ?? []);

        } catch (error) {
            console.error('Gagal memuat sesi:', error);
            renderErrorState();
        } finally {
            loadingState?.classList.add('d-none');
        }
    }

    function renderSesiCards(sesis) {
        emptyState?.classList.add('d-none');
        loadingState?.classList.add('d-none');

        if (!sesis || sesis.length === 0) {
            sesiGrid.innerHTML = `
                <div class="col-12 text-center py-5">
                    <i class="bi bi-calendar-x empty-state-icon"></i>
                    <p class="text-muted mt-3 mb-0 fw-medium">Tidak ada sesi untuk event ini</p>
                </div>`;
            return;
        }

        sesiGrid.innerHTML = sesis.map(sesi => buildSesiCardHTML(sesi)).join('');
        attachTutupListeners();
    }

    function buildSesiCardHTML(sesi) {
        const isBuka       = sesi.status === 'buka';
        const cardClass    = isBuka ? '' : 'sesi-card-closed';
        const badgeHTML    = isBuka
            ? `<span class="badge-status badge-buka"><span class="status-dot dot-buka"></span> Buka</span>`
            : `<span class="badge-status badge-tutup"><span class="status-dot dot-tutup"></span> Tutup</span>`;
        const buttonHTML   = isBuka
            ? `<button class="btn-tutup-sesi w-100"
                       data-sesi-id="${sesi.id}"
                       data-sesi-nama="${sesi.nama_sesi}">
                   Tutup Sesi Ini
               </button>`
            : `<button class="btn-sudah-ditutup w-100" disabled>Sudah Ditutup</button>`;

        return `
            <div class="col-md-6">
                <div class="sesi-card ${cardClass}">
                    <h5 class="sesi-name">${sesi.nama_sesi}</h5>
                    <p class="sesi-info">${sesi.jam_mulai} – ${sesi.jam_selesai} | ${sesi.jumlah_terisi}/${sesi.kapasitas} terisi</p>
                    <div class="mb-3">${badgeHTML}</div>
                    ${buttonHTML}
                </div>
            </div>`;
    }

    function renderErrorState() {
        sesiGrid.innerHTML = `
            <div class="col-12 text-center py-5">
                <i class="bi bi-exclamation-circle empty-state-icon text-danger"></i>
                <p class="text-muted mt-3 mb-0 fw-medium">Gagal memuat data sesi. Silakan coba lagi.</p>
                <button class="btn btn-sm btn-outline-danger mt-3" id="btnRetry">
                    <i class="bi bi-arrow-clockwise me-1"></i> Coba Lagi
                </button>
            </div>`;

        document.getElementById('btnRetry')?.addEventListener('click', () => {
            if (eventSelect?.value) fetchSesiByEvent(eventSelect.value);
        });
    }

    function showLoadingState() {
        emptyState?.classList.add('d-none');
        loadingState?.classList.remove('d-none');
        sesiGrid.innerHTML = '';
    }

    function showEmptyState() {
        loadingState?.classList.add('d-none');
        emptyState?.classList.remove('d-none');
        sesiGrid.innerHTML = '';
    }

    function attachTutupListeners() {
        document.querySelectorAll('.btn-tutup-sesi').forEach(btn => {
            btn.removeEventListener('click', handleTutupClick); // hindari duplikat
            btn.addEventListener('click', handleTutupClick);
        });
    }

    function handleTutupClick(e) {
        currentSesiId = e.currentTarget.dataset.sesiId;
        const sesiNama = e.currentTarget.dataset.sesiNama;

        if (modalSesiNama) modalSesiNama.textContent = sesiNama;
        confirmModal?.show();
    }

    if (btnConfirm) {
        btnConfirm.addEventListener('click', async () => {
            if (!currentSesiId) return;

            setConfirmLoading(true);

            try {
                const response = await fetch(`/admin/kelola-sesi/${currentSesiId}/tutup`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken(),
                    },
                });

                if (!response.ok) {
                    const errData = await response.json().catch(() => ({}));
                    throw new Error(errData.message ?? `HTTP ${response.status}`);
                }

                const data = await response.json();

                updateCardToTutup(currentSesiId);

                if (toastMessage) {
                    toastMessage.textContent = data.message ?? 'Sesi berhasil ditutup!';
                }
                successToast?.show();

            } catch (error) {
                console.error('Gagal menutup sesi:', error);
                showErrorToast(error.message ?? 'Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                setConfirmLoading(false);
                confirmModal?.hide();
                currentSesiId = null;
            }
        });
    }

    function updateCardToTutup(sesiId) {
        const btn = document.querySelector(`.btn-tutup-sesi[data-sesi-id="${sesiId}"]`);
        if (!btn) return;

        const card = btn.closest('.sesi-card');
        if (!card) return;

        // Ganti badge status
        const badgeEl = card.querySelector('.badge-status');
        if (badgeEl) {
            badgeEl.outerHTML = `
                <span class="badge-status badge-tutup">
                    <span class="status-dot dot-tutup"></span> Tutup
                </span>`;
        }

        // Ganti tombol
        btn.outerHTML = `<button class="btn-sudah-ditutup w-100" disabled>Sudah Ditutup</button>`;

        card.classList.add('sesi-card-closed');
    }

    function setConfirmLoading(isLoading) {
        if (!btnConfirm) return;

        const textEl    = btnConfirm.querySelector('.confirm-text');
        const loadingEl = btnConfirm.querySelector('.confirm-loading');

        btnConfirm.disabled = isLoading;

        if (isLoading) {
            textEl?.classList.add('d-none');
            loadingEl?.classList.remove('d-none');
        } else {
            textEl?.classList.remove('d-none');
            loadingEl?.classList.add('d-none');
        }
    }

    function showErrorToast(message) {
        const toastEl = document.getElementById('successToast');
        if (!toastEl) return;

        toastEl.style.background = '#7F1D1D';
        const iconEl = toastEl.querySelector('.bi-check-circle-fill');
        if (iconEl) {
            iconEl.className = 'bi bi-x-circle-fill text-danger fs-5';
        }
        if (toastMessage) toastMessage.textContent = message;

        successToast?.show();
        toastEl.addEventListener('hidden.bs.toast', () => {
            toastEl.style.background = '';
            if (iconEl) iconEl.className = 'bi bi-check-circle-fill text-success fs-5';
        }, { once: true });
    }
});
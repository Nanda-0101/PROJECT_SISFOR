document.addEventListener('DOMContentLoaded', () => {
    // 1. Fitur Real-time Search
    const search = document.getElementById('searchAdmin');
    const rows = document.querySelectorAll('#adminTable tbody tr');

    if (search) {
        search.addEventListener('keyup', (e) => {
            const val = e.target.value.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(val) ? '' : 'none';
            });
        });
    }

    // 2. Hover effect untuk baris tabel
    rows.forEach(row => {
        row.addEventListener('mouseover', () => row.style.transform = 'scale(1.01)');
        row.addEventListener('mouseout', () => row.style.transform = 'scale(1)');
    });

    // 4. Script untuk Pagination (Efek pindah halaman 1, 2, 3)
    const pageButtons = document.querySelectorAll('.page-btn:not(.page-next)');
    pageButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Hapus class active dari semua angka
            pageButtons.forEach(btn => btn.classList.remove('active'));
            // Tambahkan ke yang diklik
            this.classList.add('active');
        });
    });
});

// Fungsi toggle password (dibiarkan di luar agar bisa dipanggil dari onclick HTML)
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon  = document.getElementById('pwIcon');
    if (input && icon) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
}
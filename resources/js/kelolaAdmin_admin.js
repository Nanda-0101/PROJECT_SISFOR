document.addEventListener('DOMContentLoaded', () => {
    // 1. Fitur Search (Filter tabel otomatis)
    const searchInput = document.getElementById('searchAdmin');
    const table = document.getElementById('adminTable');
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const nameCol = rows[i].getElementsByTagName('td')[0];
                if (nameCol) {
                    const text = nameCol.textContent || nameCol.innerText;
                    rows[i].style.display = text.toLowerCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        });
    }

    // 2. Konfirmasi Hapus
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Yakin ingin menghapus admin ini?')) {
                // Logika hapus (misal: redirect ke route delete)
                console.log('Admin dihapus');
            }
        });
    });
});
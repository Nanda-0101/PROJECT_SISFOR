document.addEventListener('DOMContentLoaded', () => {
    console.log('Halaman Kelola Event Berhasil Dimuat! 📅');

    const btnTambah = document.getElementById('btn-tambah-event');
    if (btnTambah) {
        btnTambah.addEventListener('click', () => {
            console.log('Navigasi ke form tambah event...');
            // window.location.href = '/admin/buat-event';
        });
    }

    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('Membuka modal edit event...');
        });
    });

    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('Apakah Anda yakin ingin menghapus event ini?')) {
                console.log('Proses hapus event...');
            }
        });
    });
});
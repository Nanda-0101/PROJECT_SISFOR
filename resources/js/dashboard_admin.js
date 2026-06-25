document.addEventListener('DOMContentLoaded', () => {
    console.log('Dashboard Admin Berjaya Dimuatkan! 🛠️');
    const cardBuatEvent = document.getElementById('card-buat-event');
    const cardKelolaKategori = document.getElementById('card-kelola-kategori');
    const cardKelolaSesi = document.getElementById('card-kelola-sesi');
    const cardKelolaUser = document.getElementById('card-kelola-user');

    if (cardBuatEvent) {
        cardBuatEvent.addEventListener('click', () => {
            console.log('Navigasi ke halaman Buat Event...');
            // window.location.href = '/admin/buat-event'; 
        });
    }

    if (cardKelolaKategori) {
        cardKelolaKategori.addEventListener('click', () => {
            console.log('Navigasi ke halaman Kelola Kategori...');
            // window.location.href = '/admin/kelola-kategori';
        });
    }

    if (cardKelolaSesi) {
        cardKelolaSesi.addEventListener('click', () => {
            console.log('Navigasi ke halaman Kelola Sesi...');
            // window.location.href = '/admin/kelola-sesi';
        });
    }

    if (cardKelolaUser) {
        cardKelolaUser.addEventListener('click', () => {
            console.log('Navigasi ke halaman Kelola User...');
            // window.location.href = '/admin/kelola-user';
        });
    }
});
document.addEventListener('DOMContentLoaded', () => {
    console.log('Halaman Profil Admin Berhasil Dimuat! 👤');

    const formProfil = document.getElementById('form-profil');
    
    if (formProfil) {
        formProfil.addEventListener('submit', (e) => {
            e.preventDefault(); 
            // Disini logika Ajax atau form handling
            console.log('Menyimpan perubahan profil...');
            alert('Perubahan profil berhasil disimpan (Simulasi)');
        });
    }
});
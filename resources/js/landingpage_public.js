document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Hapus class 'active' 
            menuItems.forEach(nav => nav.classList.remove('active'));
            
            // Tambahkan class 'active' ke menu yang diklik
            this.classList.add('active');
        });
    });
});
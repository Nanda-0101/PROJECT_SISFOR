document.addEventListener('DOMContentLoaded', () => {

    console.log('Profil Admin Loaded');

    const form = document.getElementById('form-profil');

    if(form){

        form.addEventListener('submit', function(){

            const btn = this.querySelector('.btn-simpan');

            btn.disabled = true;
            btn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

        });

    }

});
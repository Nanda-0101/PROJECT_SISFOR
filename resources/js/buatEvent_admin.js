document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-event');
    
    if (form) {
        form.addEventListener('submit', (e) => {
            console.log('Data Event divalidasi dan siap dikirim...');
        });
    }
});
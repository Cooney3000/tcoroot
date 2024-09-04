document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        var form = document.getElementById('uploadForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
            this.textContent = 'Formular ausblenden';
        } else {
            form.style.display = 'none';
            this.textContent = 'Neuen Presseartikel hochladen';
        }
    });

    document.getElementById('uploadFormElement').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        fetch('lib/upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Erfolg',
                    text: 'Der Presseartikel wurde erfolgreich hochgeladen!'
                }).then(() => {
                    // Seite nach dem Schließen des SweetAlert-Dialogs neu laden
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Fehler',
                    text: data.message || 'Beim Hochladen der Datei ist ein Fehler aufgetreten (1).'
                });
            }
        })
        .catch(error => {
            console.error('Fehlerdetails:', error);
            Swal.fire({
                icon: 'error',
                title: 'Fehler',
                text: 'Beim Hochladen der Datei ist ein Fehler aufgetreten (2).'
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const toggleFormBtn = document.getElementById('toggleFormBtn');
    if (toggleFormBtn) {
        toggleFormBtn.addEventListener('click', function () {
            var form = document.getElementById('uploadForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
                this.textContent = 'Formular ausblenden';
            } else {
                form.style.display = 'none';
                this.textContent = 'Neuen Presseartikel hochladen';
            }
        });
    }

    const carouselTrack = document.querySelector('.impressionen-track');
    const leftArrow = document.getElementById('left-arrow');
    const rightArrow = document.getElementById('right-arrow');

    // Prüfen, ob die Elemente existieren
    if (!carouselTrack || !leftArrow || !rightArrow) {
        console.error('Fehler: Carousel-Elemente wurden nicht gefunden.');
        return;
    }

    // Funktion, um alle Bilder vom Server abzurufen
    fetch('lib/get-images.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Netzwerkantwort war nicht ok');
            }
            return response.json();
        })
        .then(images => {
            if (images.length === 0) {
                console.error('Keine Bilder gefunden.');
                return;
            }

            // Initiale Bilder in den Container einfügen
            images.forEach((imageName, index) => {
                const item = document.createElement('div');
                item.className = 'impressionen-item';
                const img = document.createElement('img');
                img.src = `/images/impressionen/${imageName}`;
                img.alt = `Bild ${index + 1}`;
                img.className = 'impressionen-image';
                item.appendChild(img);
                carouselTrack.appendChild(item);

                // Fancybox hinzufügen
                img.setAttribute("data-fancybox", "gallery");
            });

            // Navigation mit Pfeilen
            rightArrow.addEventListener('click', () => {
                // Prüfen, ob das letzte Bild erreicht wurde
                if (carouselTrack.scrollLeft + carouselTrack.clientWidth >= carouselTrack.scrollWidth - 1) {
                    // Zum Anfang scrollen
                    carouselTrack.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                } else {
                    // Normal nach rechts scrollen
                    carouselTrack.scrollBy({
                        left: 300, // Pixelwert anpassen, je nach Größe der Bilder
                        behavior: 'smooth'
                    });
                }
            });

            leftArrow.addEventListener('click', () => {
                // Prüfen, ob das erste Bild erreicht wurde
                if (carouselTrack.scrollLeft === 0) {
                    // Zum Ende scrollen
                    carouselTrack.scrollTo({
                        left: carouselTrack.scrollWidth,
                        behavior: 'smooth'
                    });
                } else {
                    // Normal nach links scrollen
                    carouselTrack.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                }
            });
        })
        .catch(error => console.error('Fehler beim Abrufen der Bilder:', error));
});


document.getElementById('uploadFormElement').addEventListener('submit', function (e) {
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


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TC Olching</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header img {
            height: 50px;
        }

        nav {
            display: flex;
            gap: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        .current-news {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
        }

        /* Das Karussell wird mit einem Parallax-Effekt versehen */
        .carousel {
            position: relative;
            width: 100%;
            height: auto;
            overflow: hidden;
            background-color: #ccc;
            z-index: 1;
            will-change: transform; /* Optimiert die Performance */
        }

        .carousel img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .article-content {
            padding: 20px;
            background-color: #f4f4f9;
            transition: transform 0.5s ease-in-out;
            position: relative;
            z-index: 2;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #e6e6fa;
            border-radius: 10px;
        }

        .free-space {
            height: 50px;
        }

        @media (max-width: 768px) {
            .content {
                margin: 0 10px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.png" alt="TC Olching Logo">
        <h1>TC Olching</h1>
        <nav>
            <a href="#">Startseite</a>
            <a href="#">Über uns</a>
            <a href="#">Kontakt</a>
        </nav>
    </header>

    <div class="carousel" id="carousel">
    <img src="/images/sliders/1und2.jpg" alt="Platz 1 und 2">
<img src="/images/sliders/Clubheim.jpg" alt="Das Clubheim" style="display:none;">
<img src="/images/sliders/Zuschauer.jpg" alt="Zuschauer" style="display:none;">
<img src="/images/sliders/kids.jpg" alt="Kids" style="display:none;">
<img src="/images/sliders/playersfriends.jpg" alt="Party" style="display:none;">
    </div>

    <div class="article-content" id="articleContent">
        <div class="content">
            <h2>Artikel Titel</h2>
            <p>Hier steht der Inhalt des Artikels. Dieser Inhalt kann sich nach oben schieben, um über dem Bilderkarussell zu erscheinen. Das »Sicherheitspaket« der Ampelkoalition ist im Bundesrat teilweise gescheitert. Ein vom Bundestag zuvor beschlossenes zustimmungsbedürftiges Gesetz zu mehr Möglichkeiten für die Sicherheitsbehörden bekam bei einer Abstimmung in der Länderkammer in Berlin keine Mehrheit. Den anderen Teil des Sicherheitspakets, der Verschärfungen im Asyl- und Aufenthaltsrecht sowie im Waffenrecht vorsieht, ließ der Bundesrat passieren - er war nicht zustimmungspflichtig.
                </p>
                <p>
                    Per Gesetz sollten Sicherheitsbehörden erweiterte Befugnisse bei der Terrorismusbekämpfung erhalten. Die Ampel hatte sich auf ein Verfahren geeinigt, das Ermittlungsbehörden die Befugnis zugesteht, in bestimmten Fällen biometrische Daten im Internet abzugleichen. Die Suche nach Gesichtern und Stimmen mittels einer automatisierten Anwendung sollte aber nur dann erlaubt sein, wenn dies der Präsident des Bundeskriminalamtes (BKA) oder seine Vertretung von einem Gericht genehmigen lässt. Bei Gefahr im Verzug hätte der BKA-Chef oder einer der drei Vize selbst die Anordnung für eine Dauer von maximal drei Tagen treffen müssen. Den Ländern gingen die Maßnahmen aber nicht weit genug.
                </p>
                <p>

                    Die Abgleichung biometrischer Daten im Internet werde den Sicherheitsbehörden nur bei schwersten Straftaten ermöglicht, argumentierte der bayerische Staatskanzleichef Florian Herrmann (CSU) in der Debatte. Das seien »Hürden, die völlig lebensfremd sind«. Die irreguläre Migration werde so nicht bekämpft werden. Vorgesehene Messerverbote seien reine Symbolpolitik. »Der Ampelstreit wird zu einem Sicherheitsrisiko fürs Land«, sagte Herrmann.
                </p>
                <p>

                    Dagegen betonte der rheinland-pfälzische Innenminister Michael Ebling (SPD), das Paket sei eine geeignete Antwort. Er rief dazu auf, das Mehr an Sicherheit und Befugnissen für die Polizei nicht unnötig zu verhindern, wenn es einem noch nicht genug sei.
                </p>
                <p>

                    Den anderen Teil des »Sicherheitspakets« ließ der Bundesrat passieren. So sollen Asylbewerber, für deren Schutzersuchen nach den sogenannten Dublin-Regeln ein anderes europäisches Land die Verantwortung trägt, von staatlichen Leistungen ausgeschlossen werden - wenn die Ausreise für sie rechtlich und tatsächlich möglich ist. Ausnahmen soll es geben, wenn Kinder betroffen sind. Zudem sollen Messerverbote im öffentlichen Raum ausgeweitet werden.</p>
                    <p>Hier steht der Inhalt des Artikels. Dieser Inhalt kann sich nach oben schieben, um über dem Bilderkarussell zu erscheinen. Das »Sicherheitspaket« der Ampelkoalition ist im Bundesrat teilweise gescheitert. Ein vom Bundestag zuvor beschlossenes zustimmungsbedürftiges Gesetz zu mehr Möglichkeiten für die Sicherheitsbehörden bekam bei einer Abstimmung in der Länderkammer in Berlin keine Mehrheit. Den anderen Teil des Sicherheitspakets, der Verschärfungen im Asyl- und Aufenthaltsrecht sowie im Waffenrecht vorsieht, ließ der Bundesrat passieren - er war nicht zustimmungspflichtig.
                </p>
                <p>
                    Per Gesetz sollten Sicherheitsbehörden erweiterte Befugnisse bei der Terrorismusbekämpfung erhalten. Die Ampel hatte sich auf ein Verfahren geeinigt, das Ermittlungsbehörden die Befugnis zugesteht, in bestimmten Fällen biometrische Daten im Internet abzugleichen. Die Suche nach Gesichtern und Stimmen mittels einer automatisierten Anwendung sollte aber nur dann erlaubt sein, wenn dies der Präsident des Bundeskriminalamtes (BKA) oder seine Vertretung von einem Gericht genehmigen lässt. Bei Gefahr im Verzug hätte der BKA-Chef oder einer der drei Vize selbst die Anordnung für eine Dauer von maximal drei Tagen treffen müssen. Den Ländern gingen die Maßnahmen aber nicht weit genug.
                </p>
                <p>

                    Die Abgleichung biometrischer Daten im Internet werde den Sicherheitsbehörden nur bei schwersten Straftaten ermöglicht, argumentierte der bayerische Staatskanzleichef Florian Herrmann (CSU) in der Debatte. Das seien »Hürden, die völlig lebensfremd sind«. Die irreguläre Migration werde so nicht bekämpft werden. Vorgesehene Messerverbote seien reine Symbolpolitik. »Der Ampelstreit wird zu einem Sicherheitsrisiko fürs Land«, sagte Herrmann.
                </p>
                <p>

                    Dagegen betonte der rheinland-pfälzische Innenminister Michael Ebling (SPD), das Paket sei eine geeignete Antwort. Er rief dazu auf, das Mehr an Sicherheit und Befugnissen für die Polizei nicht unnötig zu verhindern, wenn es einem noch nicht genug sei.
                </p>
                <p>

                    Den anderen Teil des »Sicherheitspakets« ließ der Bundesrat passieren. So sollen Asylbewerber, für deren Schutzersuchen nach den sogenannten Dublin-Regeln ein anderes europäisches Land die Verantwortung trägt, von staatlichen Leistungen ausgeschlossen werden - wenn die Ausreise für sie rechtlich und tatsächlich möglich ist. Ausnahmen soll es geben, wenn Kinder betroffen sind. Zudem sollen Messerverbote im öffentlichen Raum ausgeweitet werden.</p>
                    <p>Hier steht der Inhalt des Artikels. Dieser Inhalt kann sich nach oben schieben, um über dem Bilderkarussell zu erscheinen. Das »Sicherheitspaket« der Ampelkoalition ist im Bundesrat teilweise gescheitert. Ein vom Bundestag zuvor beschlossenes zustimmungsbedürftiges Gesetz zu mehr Möglichkeiten für die Sicherheitsbehörden bekam bei einer Abstimmung in der Länderkammer in Berlin keine Mehrheit. Den anderen Teil des Sicherheitspakets, der Verschärfungen im Asyl- und Aufenthaltsrecht sowie im Waffenrecht vorsieht, ließ der Bundesrat passieren - er war nicht zustimmungspflichtig.
                </p>
                <p>
                    Per Gesetz sollten Sicherheitsbehörden erweiterte Befugnisse bei der Terrorismusbekämpfung erhalten. Die Ampel hatte sich auf ein Verfahren geeinigt, das Ermittlungsbehörden die Befugnis zugesteht, in bestimmten Fällen biometrische Daten im Internet abzugleichen. Die Suche nach Gesichtern und Stimmen mittels einer automatisierten Anwendung sollte aber nur dann erlaubt sein, wenn dies der Präsident des Bundeskriminalamtes (BKA) oder seine Vertretung von einem Gericht genehmigen lässt. Bei Gefahr im Verzug hätte der BKA-Chef oder einer der drei Vize selbst die Anordnung für eine Dauer von maximal drei Tagen treffen müssen. Den Ländern gingen die Maßnahmen aber nicht weit genug.
                </p>
                <p>

                    Die Abgleichung biometrischer Daten im Internet werde den Sicherheitsbehörden nur bei schwersten Straftaten ermöglicht, argumentierte der bayerische Staatskanzleichef Florian Herrmann (CSU) in der Debatte. Das seien »Hürden, die völlig lebensfremd sind«. Die irreguläre Migration werde so nicht bekämpft werden. Vorgesehene Messerverbote seien reine Symbolpolitik. »Der Ampelstreit wird zu einem Sicherheitsrisiko fürs Land«, sagte Herrmann.
                </p>
                <p>

                    Dagegen betonte der rheinland-pfälzische Innenminister Michael Ebling (SPD), das Paket sei eine geeignete Antwort. Er rief dazu auf, das Mehr an Sicherheit und Befugnissen für die Polizei nicht unnötig zu verhindern, wenn es einem noch nicht genug sei.
                </p>
                <p>

                    Den anderen Teil des »Sicherheitspakets« ließ der Bundesrat passieren. So sollen Asylbewerber, für deren Schutzersuchen nach den sogenannten Dublin-Regeln ein anderes europäisches Land die Verantwortung trägt, von staatlichen Leistungen ausgeschlossen werden - wenn die Ausreise für sie rechtlich und tatsächlich möglich ist. Ausnahmen soll es geben, wenn Kinder betroffen sind. Zudem sollen Messerverbote im öffentlichen Raum ausgeweitet werden.</p>
                    <p>Hier steht der Inhalt des Artikels. Dieser Inhalt kann sich nach oben schieben, um über dem Bilderkarussell zu erscheinen. Das »Sicherheitspaket« der Ampelkoalition ist im Bundesrat teilweise gescheitert. Ein vom Bundestag zuvor beschlossenes zustimmungsbedürftiges Gesetz zu mehr Möglichkeiten für die Sicherheitsbehörden bekam bei einer Abstimmung in der Länderkammer in Berlin keine Mehrheit. Den anderen Teil des Sicherheitspakets, der Verschärfungen im Asyl- und Aufenthaltsrecht sowie im Waffenrecht vorsieht, ließ der Bundesrat passieren - er war nicht zustimmungspflichtig.
                </p>
                <p>
                    Per Gesetz sollten Sicherheitsbehörden erweiterte Befugnisse bei der Terrorismusbekämpfung erhalten. Die Ampel hatte sich auf ein Verfahren geeinigt, das Ermittlungsbehörden die Befugnis zugesteht, in bestimmten Fällen biometrische Daten im Internet abzugleichen. Die Suche nach Gesichtern und Stimmen mittels einer automatisierten Anwendung sollte aber nur dann erlaubt sein, wenn dies der Präsident des Bundeskriminalamtes (BKA) oder seine Vertretung von einem Gericht genehmigen lässt. Bei Gefahr im Verzug hätte der BKA-Chef oder einer der drei Vize selbst die Anordnung für eine Dauer von maximal drei Tagen treffen müssen. Den Ländern gingen die Maßnahmen aber nicht weit genug.
                </p>
                <p>

                    Die Abgleichung biometrischer Daten im Internet werde den Sicherheitsbehörden nur bei schwersten Straftaten ermöglicht, argumentierte der bayerische Staatskanzleichef Florian Herrmann (CSU) in der Debatte. Das seien »Hürden, die völlig lebensfremd sind«. Die irreguläre Migration werde so nicht bekämpft werden. Vorgesehene Messerverbote seien reine Symbolpolitik. »Der Ampelstreit wird zu einem Sicherheitsrisiko fürs Land«, sagte Herrmann.
                </p>
                <p>

                    Dagegen betonte der rheinland-pfälzische Innenminister Michael Ebling (SPD), das Paket sei eine geeignete Antwort. Er rief dazu auf, das Mehr an Sicherheit und Befugnissen für die Polizei nicht unnötig zu verhindern, wenn es einem noch nicht genug sei.
                </p>
                <p>

                    Den anderen Teil des »Sicherheitspakets« ließ der Bundesrat passieren. So sollen Asylbewerber, für deren Schutzersuchen nach den sogenannten Dublin-Regeln ein anderes europäisches Land die Verantwortung trägt, von staatlichen Leistungen ausgeschlossen werden - wenn die Ausreise für sie rechtlich und tatsächlich möglich ist. Ausnahmen soll es geben, wenn Kinder betroffen sind. Zudem sollen Messerverbote im öffentlichen Raum ausgeweitet werden.</p>
        </div>
    </div>

    <div class="free-space"></div>

    <script>
        // Automatische Bildwechsel-Funktion
        let currentIndex = 0;
        const images = document.querySelectorAll('.carousel img');

        function changeImage() {
            images[currentIndex].style.display = 'none';
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].style.display = 'block';
        }

        setInterval(changeImage, 3000); // Alle 3 Sekunden wechselt das Bild

        // Parallax-Effekt für das Karussell
        window.addEventListener('scroll', function () {
            const carousel = document.getElementById('carousel');
            const scrollPosition = window.scrollY;

            // Das Karussell bewegt sich langsamer (verringere den Scroll-Wert durch Division)
            carousel.style.transform = 'translateY(' + scrollPosition * 0.5 + 'px)';
        });
    </script>
</body>

</html>

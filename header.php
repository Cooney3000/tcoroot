<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="cache-control" content="no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TC Olching <?= htmlspecialchars($_header, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="/css/styles.css" type="text/css" media="screen" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <script src="/js/vendor/modernizr.min.js"></script>
  <script src="/js/vendor/respond.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script>
    window.jQuery || document.write('<script type="text/javascript" src="/js/vendor/1.7.2.jquery.min.js"><\/script>')
  </script>
  <script src="/js/vendor/prefixfree.min.js"></script>
  <script src="/js/vendor/jquery.slides.min.js"></script>
  <script src="/js/script.js"></script>
  <script>
    $(function() {
      $('#slides').slidesjs({
        height: 235,
        navigation: false,
        pagination: false,
        effect: {
          fade: {
            speed: 400
          }
        },
        callback: {
          start: function(number) {
            $("#slider_content1,#slider_content2,#slider_content3").fadeOut(500);
          },
          complete: function(number) {
            $("#slider_content" + number).delay(500).fadeIn(1000);
          }
        },
        play: {
          active: false,
          auto: true,
          interval: 6000,
          pauseOnHover: false,
          effect: "fade"
        }
      });
    });
  </script>
</head>

<body>
  <a id="toplink" href="#top"><img src="/images/icons/top.gif" alt="Nach oben"></a>
  <div class="headerbackground">
    <header>
      <img id="logotcoheader" src="/images/TCO-Logo 2022-final.png" alt="Logo">
      <h1>TC Olching e.V.</h1>
    </header>
  </div>
  <div id="navbackground">
    <nav>
      <ul>
        <li class="<?= $navigation['aktuell'] ?>"><a href="index.php">Aktuell</a></li>
        <li class="<?= $navigation['verein'] ?>"><a href="verein.php">Verein</a></li>
        <li class="<?= $navigation['mannschaften'] ?>"><a href="mannschaften.php">Mannschaften</a></li>
        <li class="<?= $navigation['jugend'] ?>"><a href="jugend.php">Jugend</a></li>
        <li class="<?= $navigation['training'] ?>"><a href="training.php">Training</a></li>
        <li><a href="/intern/index.php">Intern</a></li>
      </ul>
    </nav>
  </div>
  <section class="clean mycontainer">
    <h2 class="hidden">Die Tennisanlage des TC Olching</h2>
    <div id="slides">
      <img src="/images/sliders/1und2.jpg" alt="Platz 1 und 2">
      <img src="/images/sliders/Clubheim.jpg" alt="Das Clubheim">
      <img src="/images/sliders/Zuschauer.jpg" alt="Zuschauer">
      <img src="/images/sliders/kids.jpg" alt="Zuschauer">
    </div>
    <div id="latest_news">
      <span class="text-success"><a href="index.php#olchingopen"><span class="persoenlich">Top Tennis</span><br>bei den Olching Open!</a></span>
    </div>
  </section>
</body>

</html>
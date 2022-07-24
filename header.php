<!doctype html>
<html lang="de">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="cache-control" content="no-cache">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TC Olching Home</title>

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/styles.css" type="text/css" media="screen" />
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<script src="/js/vendor/modernizr.min.js"></script>
	<script src="/js/vendor/respond.min.js"></script>

	<!-- include extern jQuery file but fall back to local file if extern one fails to load !-->
	<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
		window.jQuery || document.write('<script type="text/javascript" src="js\/vendor\/1.7.2.jquery.min.js"><\/script>')
	</script>

	<script src="/js/vendor/prefixfree.min.js"></script>
	<script src="/js/vendor/jquery.slides.min.js"></script>
	<script src="/js/script.js"></script>
	<!--[if lt IE 9]>
				<style>
						header
						{
								margin: 0 auto 20px auto;
						}
						#four_columns .img-item figure span.thumb-screen
						{
								display:none;
						}  
				</style>
		<![endif]-->
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
			<img id="logotcoheader" src="/images/tcoplain_0,33x.png" alt="Logo">
			<h1>TC Olching e.V.</h1>
		</header>
	</div>
	<div id="navbackground">
		<nav>
			<ul>
				<li class="<?= $_aktuell ?>"><a href="index.php">Aktuell</a></li>
				<li class="<?= $_verein ?>"><a href="verein.php">Verein</a></li>
				<li class="<?= $_mannschaften ?>"><a href="mannschaften.php">Mannschaften</a></li>
				<li class="<?= $_jugend ?>"><a href="jugend.php">Jugend</a></li>
				<li class="<?= $_training ?>"><a href="training.php">Training</a></li>
				<li><a href="/intern/internal.php">Intern</a></li>
				<!-- <li><a href="/intern/tafel/">Platzbuchung</a></li> -->
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
			<span class="text-success"><a href="https://www.tcolching.de/intern/tafel/">Neu: Platzbuchung jetzt schon 24h vorher möglich </a></span>
		</div>
	</section>
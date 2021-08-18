
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<title>Биддер ЦИАН</title>

		<!-- Styles -->
		<script rel="preload" src="{{ asset('assets/js/app2.min.js') }}" defer></script>
		<link rel="stylesheet" href="{{ asset('assets/css/app2.min.css') }}" as="style"></link>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
		<link rel="manifest" href="assets/favicon/site.webmanifest">
		<link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
	</head>
	<body>
		<div id="app2">
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
		<div class="container">
			<div class="row">
				<div class="col-3 col-sm-4 col-lg-3 mr-auto mx-lg-auto d-flex align-items-center">
					<button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
					<a class="navbar-brand" href="#" id="logo-top">
						<div class="logo-wrapper mt-2"><img class="logo-dark" src="assets/img/logo.png" alt="logo"></div>
						<img class="logo-light" src="assets/img/logo.png" alt="logo">
					</a>	
				</div>
				<section class="col-lg-6 navbar-mobile">
					<nav class="nav nav-navbar mr-lg-auto mx-lg-auto mt-1">
					<a class="nav-link active" href="/index"><span class="fs-head">Оптимизатор бюджета <span class="we-cian">ЦИАН</span></span></a>
					</nav>
				</section>
				<div class="col-9 col-sm-7 col-lg-3 d-flex justify-content-end">
					@guest
					<a class="btn btn-sm btn-round btn-outline-success d-lg-inline-block ms-1 mt-1" href="/login">Войти</a>
					@endguest
					@auth
					<a href="{{ url('/logout') }}" class="btn btn-sm btn-round btn-outline-success d-lg-inline-block text-end" >
						Выход
					</a>
					@endauth
				</div>
			</div>
		</div>
		</nav><!-- /.navbar -->


		<!-- Header -->
		<header class="header text-white h-fullscreen pb-0 overflow-hidden" style="background-image: url(/assets/img/16.png); background-color: #262a37;">
		<div class="overlay opacity-95" style="background-image: linear-gradient(to bottom, #09203f 0%, #537895 100%);"></div>
		<div class="container text-center">
			<div class="row align-items-center h-100">

			<div class="col-md-8 mx-auto">
				<h1 style="font-size: 35px"><span class="main-title">ПОБЕЖДАЙТЕ <span class="prim">ИНТЕЛЛЕКТОМ</span>,<br>а не бюджетами.</span></h1>
				<p class="lead mt-4 mb-7">Повысьте количество клиентов при меньшем бюджете. Мы покажем какие объявления нужно продвигать и суммы на каждое  с точностью до рубля. Распределим бюджеты в 1 клик.</p>
				<a href="#" data-toggle="modal" data-target="#RegisterModal" class="btn btn-xl btn-round btn-primary px-8">Попробуйте бесплатно</a>
			</div>

			<div class="col-md-8 mx-auto align-self-end">
				<img class="mt-7" src="assets/img/content.png" alt="img" data-aos="fade-up">
			</div>

			</div>
		</div>
		</header><!-- /.header -->


		<!-- Main Content -->
		<main class="main-content">

		<!--
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		| Features
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		!-->
		<section class="section bg-gray overflow-hidden">
			<div class="container-fluid">
			<div class="row gap-y align-items-center">
				<div class="col-md-6 col-lg-5 col-xl-4 mx-auto text-center">
					<div class="container-img">
						<img class="border shadow-7" src="assets/img/block-1.png" alt="..." data-aos="fade-right">
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-xl-5 mx-auto">
				<h3>Результат нашего клиента: 1-ое место с двукратным отрывом от ближайшего конкурента при меньшем бюджете!</h3>
				<p>Умные алгоритмы продвижения позволили компании «Наследие» всего за полтора месяца занять лидирующие позиции в Ростове-на-Дону, при этом рекламный бюджет удалось сократить, т. к. агенты перестали справляться с потоком лидов.</p>
				<a href="#" data-toggle="modal" data-target="#myModal">Узнать подробнее<i class="fas fa-arrow-right ms-1"></i></a>
				</div>

			</div>
			</div>
		</section>


		<section class="section overflow-hidden">
			<div class="container-fluid">
			<div class="row gap-y align-items-center">
				<div class="col-md-6 col-lg-5 col-xl-4  mx-auto text-center">
					<div class="container-img2">
						<img class="border shadow-7" src="assets/img/block-2.png" alt="..." data-aos="fade-left">
					</div>
				</div>


				<div class="col-md-6 col-lg-6 col-xl-5 mx-auto order-md-first">
				<h3>Мы используем самые передовые математические модели и алгоритмы.</h3>
				<p>За построение математических моделей и финансовую математику отвечают практикующие дипломированные специалисты с опытом работы и преподавания в немецких и лучших российских университетах.</p>
				<a href="#" data-toggle="modal" data-target="#myModal">Узнать подробнее<i class="fas fa-arrow-right ms-1"></i></a>
				</div>

			</div>
			</div>
		</section>


		<section class="section bg-gray overflow-hidden">
			<div class="container-fluid">
			<div class="row gap-y align-items-center">
				<div class="col-md-6 col-lg-5 col-xl-4  mx-auto text-center">
					
						<img class="border shadow-7" src="assets/img/block-3.png" alt="..." data-aos="fade-right">
					
				</div>


				<div class="col-md-6 col-lg-6 col-xl-5 mx-auto">
				<h3>Опыт более 10 лет в разработке приложений для риэлторов.</h3>
				<p>Наша команда автоматизирует работу агентств недвижимости с 2009 года. Нами создано более 20 CRM и ERP систем, большое количество ПО различного назначения.</p>
					<a href="#" data-toggle="modal" data-target="#myModal">Узнать подробнее<i class="fas fa-arrow-right ms-1"></i></a>
				</div>

			</div>
			</div>
		</section>

		<!--
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		| Teamwork To The Next Level
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		!-->
		<section class="section">
			<div class="container">
			<header class="section-header">
				<h2>Преимущества  Оптимизатора бюджета ЦИАН</h2>
				<hr>
			</header>

			<div class="row gap-y text-center">

				<div class="col-md-6 col-xl-4 feature-1">
				<p class="feature-icon lead-8 text-info"><img src="assets/img/block-4-icon-1.png"></p>
				<h5>Подходит для компаний любого размера.</h5>
				<p class="text-muted">Нам не важно сколько у Вас объектов в рекламе 20 или 20 000.</p>
				</div>

				<div class="col-md-6 col-xl-4 feature-1">
				<p class="feature-icon lead-8 text-danger"><img src="assets/img/block-4-icon-2.png"></p>
				<h5>Маркетинг в один клик.</h5>
				<p class="text-muted">Выбирайте из нескольких автостратегий: минимальная цена лида, максимальное количество клиентов, либо сбалансированный вариант. Кроме того, можно настроить все вручную.</p>
				</div>

				<div class="col-md-6 col-xl-4 feature-1">
				<p class="feature-icon lead-8 text-success"><img src="assets/img/block-4-icon-3.png"></p>
				<h5>Дружелюбная поддержка.</h5>
				<p class="text-muted">Мы с радостью проконсультируем не только по работе нашей системы, но и по любым другим вопросам маркетинга, лидогенерации, CRM и IT.</p>
				</div>

			</div>

			</div>
		</section>


		<!--
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		| Pricing
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		!-->
		<buy-block/>
		<!--
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		| CTA
		|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
		!-->
		</main>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<modal-contact/>
		</div>
		<div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="RegisterModalLabel">
			<register-modal/>
		</div>
		<!-- Footer -->
		<footer class="footer text-white bt-0 py-7" style="background-image: linear-gradient(135deg, #4481eb 0%, #04befe 100%);">
		<div class="container">
			<div class="row align-items-center">

			<div class="col-12 col-md-3 d-flex justify-content-center text-center">
				<a class="navbar-brand" href="#">
					<div class="logo-wrapper mt-2">
						<img class="logo-light" src="assets/img/logo.png" alt="logo">
					</div>
				</a>
			</div>
			<div class="col-12 col-md-6 col-lg-6 d-flex justify-content-center text-center">
				<a class="nav-link active" href="/index"><span class="fs-head">Оптимизатор бюджета <span class="we-cian">ЦИАН</span></span></a>
			</div>
			<div class="col-md-3 text-center text-md-left mt-5 mt-md-0">
				<div class="social social-bg-dark">
				<a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
				<a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
				<a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
				<a class="social-youtube" href="#"><i class="fa fa-youtube"></i></a>
				<a class="social-dribbble" href="#"><i class="fa fa-dribbble"></i></a>
				</div>
			</div>
			<div class="col-12 text-center">
				<ul id="nav3">
					<li>
						<i class="fas fa-phone-square-alt"></i>
						<span class = "ms-1">8-(863)-296-0455</span>
					</li>
					<li class="ms-2">
						<i class="fas fa-envelope"></i>
						<span class = "ms-1">web@enterprise-it.ru</span>
					</li>  
				</ul>
			</div>
			<div class="col-12 text-center">
				<br>
				<small>© Интернет-агентство «IT Enterprise»</small>
			</div>

			</div>
		</div>
		</footer><!-- /.footer -->
	</body>
</html>

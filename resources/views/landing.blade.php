
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<title>TheSaaS Sample Demo Landing Page</title>

		<!-- Styles -->
		<script src="{{ asset('assets/js/app.js') }}" defer></script>
		<link href="{{ asset('assets/css/app2.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
		<!-- Favicons -->
		<link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
		<link rel="icon" href="../assets/img/favicon.png">
	</head>
	<body>
		<div id="app">
		<!-- Navbar -->
			<nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="smart">
				<div class="container">
					<div class="navbar-left mr-4">
						<button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
						<a class="navbar-brand" href="#">
							<img class="logo-dark" src="assets/img/logo-dark.png" alt="logo">
							<img class="logo-light" src="assets/img/logo-light.png" alt="logo">
						</a>
					</div>

					<section class="navbar-mobile">
						<nav class="nav nav-navbar mr-auto">
							@guest
							<a class="nav-link  d-stick-none" href="/index">Вход</a>
							<a class="nav-link d-stick-none" href="register">Регистрация</a>
							@endguest
							@auth
							<a class="nav-link " href="/index">Ставки</a>
							@endauth
							<a class="nav-link " href="#section-pricing">Pricing</a>
							<a class="nav-link " href="#">Resources</a>
							<a class="nav-link " href="#">Contact</a>
                            @auth
                            <a href="{{ url('/logout') }}" class="nav-link text-end" >
                                Выход
                            </a>
                            @endauth
						</nav>
                        @guest
						<div class="d-none d-stick-block">
							<a class="btn btn-sm btn-light ml-lg-5 mr-2" href="/index">Войти</a>
							<a class="btn btn-sm btn-success" href="register">Зарегистрироваться</a>
						</div>
                        @endguest
					</section>

				</div>
                
			</nav>
			<header id="home" class="header text-white h-fullscreen text-center text-lg-left" style="background-color: #24292e">
				<canvas class="constellation" data-color="rgba(255,255,255,0.3)"></canvas>
				<div class="container">
					<div class="row align-items-center h-100">

						<div class="col-lg-6">
							<h1>How developers work</h1>
							<p class="lead mt-5 mb-8">Support your workflow with lightweight tools and features. Then work how you work best—we'll follow your lead.</p>
							<p class="gap-xy">
								<a class="btn btn-round btn-outline-light mw-150" href="#">Learn more</a>
								<a class="btn btn-round btn-light mw-150" href="#">Sign up</a>
							</p>
						</div>

						<div class="col-lg-5 ml-auto">
							<img class="mt-5" src="assets/img/laptop-1.png" alt="img">
						</div>

					</div>
				</div>
			</header>
			<!-- Main Content -->
			<main class="main-content">

	<!--
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	| Welcome
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	!-->
	<section class="section">
		<div class="container">
			<header class="section-header">
				<small>Welcome</small>
				<h2>Get a Better Understanding</h2>
				<hr>
				<p class="lead">Holisticly implement fully tested process improvements rather than dynamic internal.</p>
			</header>



			<div class="row gap-y">

				<div class="col-md-8 mx-auto">
					<img src="assets/img/dribbble-9.gif" alt="..." data-aos="fade-up" data-aos-duration="2000">
				</div>


				<div class="w-100"></div>


				<div class="col-md-6 col-xl-4">
					<div class="media">
						<div class="lead-6 line-height-1 text-dark mr-5"><i class="icon-mobile"></i></div>
						<div class="media-body">
							<h5>Responsive</h5>
							<p>Your website works on any device: desktop, tablet or mobile.</p>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-xl-4">
					<div class="media">
						<div class="lead-6 line-height-1 text-primary mr-5"><i class="icon-gears"></i></div>
						<div class="media-body">
							<h5>Customizable</h5>
							<p>You can easily read, edit, and write your own code, or change everything.</p>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-xl-4">
					<div class="media">
						<div class="lead-6 line-height-1 text-info mr-5"><i class="icon-tools"></i></div>
						<div class="media-body">
							<h5>UI Kit</h5>
							<p>There is a bunch of useful and necessary elements for developing your website.</p>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-xl-4">
					<div class="media">
						<div class="lead-6 line-height-1 text-warning mr-5"><i class="icon-layers"></i></div>
						<div class="media-body">
							<h5>Lego Base</h5>
							<p>You can find our code well organized, commented and readable.</p>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-xl-4">
					<div class="media">
						<div class="lead-6 line-height-1 text-danger mr-5"><i class="icon-recycle"></i></div>
						<div class="media-body">
							<h5>Clean Code</h5>
							<p>As you can see in the source code, we provided a clean code.</p>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-xl-4">
					<div class="media">
						<div class="lead-6 line-height-1 text-success mr-5"><i class="icon-chat"></i></div>
						<div class="media-body">
							<h5>Support</h5>
							<p>When you purchase this template, you'll freely receive future updates.</p>
						</div>
					</div>
				</div>

			</div>

		</div>
	</section>


	<!--
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	| CTA
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	!-->
	<section class="section py-7" style="background-color: #8ea6e6">
		<div class="container">
			<div class="row gap-y align-items-center">
				<div class="col-md-9">
					<h4 class="mb-0 text-white text-center text-md-left">Want a bite? You're in the right place!</h4>
				</div>

				<div class="col-md-3 text-center text-md-right">
					<a class="btn btn-lg btn-round btn-light" href="#">Take a test drive</a>
				</div>
			</div>
		</div>
	</section>


	<!--
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	| Features
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	!-->
	<section id="section-features" class="section bg-gray">
		<div class="container">
			<header class="section-header">
				<small>Feature</small>
				<h2>More to Discover</h2>
				<hr>
				<p class="lead">We waited until we could do it right. Then we did! Instead of creating a carbon copy.</p>
			</header>


			<div class="row gap-y align-items-center">
				<div class="col-md-6 ml-auto">
					<h4>Getting Started page</h4>
					<p>As part of efforts to improve user onboarding, I shipped an experiment to a subset of new users showing them a Getting Started page immediately after signup to help them get to what we think are some of the most important actions for new users to take. We compared the subset of users against a control group to see whether such an experience improved engagement over a period of time.</p>
				</div>

				<div class="col-md-5 order-md-first">
					<img class="rounded shadow-2" src="assets/img/dribbble-6.png" alt="...">
				</div>
			</div>


			<hr class="my-8">


			<div class="row gap-y align-items-center">
				<div class="col-md-6 mr-auto">
					<h4>Outdated comments toggling</h4>
					<p>Last week we shipped outdated comments...well, brought them back, actually. We used to show collapsed comments on outdated diffs as a single line, but removed that when we shipped code review recently. We brought that back last week with an improvement: you can now toggle open threads on outdated diffs in a review individually.</p>
				</div>

				<div class="col-md-5">
					<img class="rounded shadow-2" src="assets/img/dribbble-7.png" alt="...">
				</div>
			</div>


			<hr class="my-8">


			<div class="row gap-y align-items-center">
				<div class="col-md-6 ml-auto">
					<h4>Code review illustrations</h4>
					<p>Less an illustration, and more a literal proxy. These show up when the feature's introduced. Monotonectally leverage existing standards compliant ideas with distributed data. Efficiently simplify cross-unit systems whereas adaptive testing. Monotonectally leverage existing standards compliant ideas with distributed data. Efficiently simplify cross-unit systems whereas adaptive testing.</p>
				</div>

				<div class="col-md-5 order-md-first">
					<img class="rounded shadow-2" src="assets/img/dribbble-8.png" alt="...">
				</div>
			</div>


		</div>
	</section>


	<!--
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	| Pricing
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	!-->
	<section id="section-pricing" class="section">
		<div class="container">
			<header class="section-header">
				<small>Plans</small>
				<h2>Pricing</h2>
				<hr>
				<p class="lead">Choose any of the following plans to get start with. You can start with the FREE plan to see our web application at first. You can always change your plan from your account.</p>
			</header>


			<div class="text-center my-7">
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
					<label class="btn btn-round btn-outline-secondary w-150 active">
						<input type="radio" name="pricing" value="monthly" autocomplete="off" checked> Monthly
					</label>
					<label class="btn btn-round btn-outline-secondary w-150">
						<input type="radio" name="pricing" value="yearly" autocomplete="off"> Yearly
					</label>
				</div>
			</div>


			<div class="row gap-y text-center">

				<div class="col-md-4">
					<div class="pricing-1">
						<p class="plan-name">Free</p>
						<br>
						<h2 class="price">0</h2>
						<p class="small">&nbsp;</p>

						<div class="text-muted">
							<small>1 Repository</small><br>
							<small>1 Private Project</small><br>
							<small>100 MB Attachment</small><br>
						</div>

						<br>
						<p class="text-center py-3">
							<a class="btn btn-primary" href="#">Get started</a>
						</p>
					</div>
				</div>


				<div class="col-md-4">
					<div class="pricing-1 popular">
						<p class="plan-name">Personal</p>
						<br>
						<h2 class="price text-success">
							<span class="price-unit">$</span>
							<span data-bind-radio="pricing" data-monthly="9" data-yearly="99">9</span>
							<span class="plan-period" data-bind-radio="pricing" data-monthly="/mo" data-yearly="/yr">/mo</span>
						</h2>
						<p class="small">&nbsp;</p>

						<div class="text-muted">
							<small>1 Repository</small><br>
							<small>10 Private Project</small><br>
							<small>10 GB attachment</small><br>
						</div>

						<br>
						<p class="text-center py-3">
							<a class="btn btn-success" href="#" data-bind-href="pricing" data-monthly="#monthly" data-yearly="#yearly">Get started</a>
						</p>
					</div>
				</div>


				<div class="col-md-4">
					<div class="pricing-1">
						<p class="plan-name">Team</p>
						<br>
						<h2 class="price">
							<span class="price-unit">$</span>
							<span data-bind-radio="pricing" data-monthly="39" data-yearly="399">39</span>
							<span class="plan-period" data-bind-radio="pricing" data-monthly="/mo" data-yearly="/yr">/mo</span>
						</h2>
						<p class="small">&nbsp;</p>

						<div class="text-muted">
							<small>5 Repository</small><br>
							<small>25 Private Project</small><br>
							<small>100 GB attachments</small><br>
						</div>

						<br>
						<p class="text-center py-3">
							<a class="btn btn-primary" href="#" data-bind-href="pricing" data-monthly="#monthly" data-yearly="#yearly">Get started</a>
						</p>
					</div>
				</div>

			</div>


		</div>
	</section>


	<!--
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	| Signup
	|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
	!-->
	<section class="section bg-gray text-center">
		<div class="container">

			<header class="section-header">
				<small>Try It Now</small>
				<h2 class="lead-8"><strong>Get Started Free</strong></h2>
				<hr>
				<p class="lead">Sign up for free and become one of the millions of people around the world who have fallen in love with TheSaaS.</p>
			</header>


			<div class="row">
				<form class="col-md-4 col-xl-4 mx-auto input-border">
					<div class="form-group">
						<input type="text" class="form-control form-control-lg" placeholder="Name">
					</div>

					<div class="form-group">
						<input type="text" class="form-control form-control-lg" placeholder="Email">
					</div>

					<div class="form-group">
						<input type="password" class="form-control form-control-lg" placeholder="Password">
					</div>

					<button class="btn btn-block btn-xl btn-success">Sign up</button>
					<p class="small mt-3 opacity-70">or use your <a href="#">Facebook account</a></p>
				</form>
			</div>

		</div>
	</section>
    </div>
</main>
		<footer class="footer">
			<div class="container">
				<div class="row gap-y align-items-center">

					<div class="col-md-3 text-center text-md-left">
						<a href="#"><img src="assets/img/logo-dark.png" alt="logo"></a>
					</div>

					<div class="col-md-6">
						<div class="nav nav-center">
							<a class="nav-link" href="#">About</a>
							<a class="nav-link" href="#">Blog</a>
							<a class="nav-link" href="#">Policy</a>
							<a class="nav-link" href="#">Contact</a>
						</div>
					</div>

					<div class="col-md-3 text-center text-md-right">
						<small>© 2020. All rights reserved.</small>
					</div>

				</div>
			</div>
		</footer><!-- /.footer -->

	</body>
</html>

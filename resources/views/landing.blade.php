
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>SaaS 1 — TheSaaS Sample Demo Landing Page</title>

    <!-- Styles -->
    <link href="../assets/css/page.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
  </head>

  <body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="smart">
      <div class="container">

        <div class="navbar-left mr-4">
          <button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
          <a class="navbar-brand" href="#">
            <img class="logo-dark" src="../assets/img/logo-dark.png" alt="logo">
            <img class="logo-light" src="../assets/img/logo-light.png" alt="logo">
          </a>
        </div>

        <section class="navbar-mobile">
          <nav class="nav nav-navbar mr-auto">
            @guest
            <a class="nav-link active" href="/index">Вход</a>
            <a class="nav-link" href="register">Регистрация</a>
            @endguest
            @auth
            <a class="nav-link" href="/index">Ставки</a>
            @endauth
            <a class="nav-link" href="#section-pricing">Pricing</a>
            <a class="nav-link" href="#">Resources</a>
            <a class="nav-link" href="#">Contact</a>
          </nav>

          <div class="d-none d-stick-block">
            <a class="btn btn-sm btn-light ml-lg-5 mr-2" href="#">Login</a>
            <a class="btn btn-sm btn-success" href="#">Sign up</a>
          </div>
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
            <img class="mt-5" src="../assets/img/preview/laptop-1.png" alt="img">
          </div>

        </div>
      </div>
    </header>
    <main class="main-content">
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
              <img src="../assets/img/preview/dribbble-9.gif" alt="..." data-aos="fade-up" data-aos-duration="2000">
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
    <footer class="footer">
      <div class="container">
        <div class="row gap-y align-items-center">

          <div class="col-md-3 text-center text-md-left">
            <a href="#"><img src="../assets/img/logo-dark.png" alt="logo"></a>
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


    <!-- Scripts -->
    <script src="../assets/js/page.min.js"></script>
    <script src="../assets/js/script.js"></script>

  </body>
</html>

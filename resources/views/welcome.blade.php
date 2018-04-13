<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Auto Shop Manager Software</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body id="page-top">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Cuesta</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#features">Features</a>
                </li>
              {{--<li class="nav-item">--}}
              {{--<a class="nav-link js-scroll-trigger" href="#about">About us</a>--}}
              {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                  @if(env('APP_DEBUG'))
                    <a class="nav-link js-scroll-trigger" href="{{ env('CLIENT_DEV_URL') }}">Login</a>
                  @else
                    <a class="nav-link js-scroll-trigger" href="/admin">Login</a>
                  @endif;
                </li>
            </ul>
        </div>
    </div>
</nav>
<header class="masthead">
  <div class="container">
    <div class="row">
      <div class="header-content">
        <h1>Easy Auto Repair Shop Software</h1>
        <h5>Powerful, Reliable and Easy to use automotive software solution for mechanics and small auto repair
          shop.</h5>
        <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Start Now for Free!</a>
      </div>
    </div>
  </div>
</header>

<section class="download bg-primary text-center" id="download">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="feature-item">
                    <span class="fa-stack fa-lg" style="font-size:31px">
                      <i class="fa fa-pencil fa-stack-2x" style="font-size:64px" aria-hidden="true"></i>
                      <i class="fa fa-wrench fa-flip-horizontal fa-stack-2x fa-inverse"></i>
                    </span>
                    <h3>Easily Run your Repair Shop</h3>
                    <p class="text-muted">We lead with design and fine-tune our software to provide a clean, modern user-experience.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-item">
                    <i class="fa fa-newspaper-o fa-4x" aria-hidden="true"></i>
                    <h3>Phone & Tablet Ready</h3>
                    <p class="text-muted">Never worry about switching devices. The Cuesta App is accessible and easy to use on any computer, tablet or phone.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-item">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h3>Card Processor</h3>
                    <p class="text-muted">Take credit card payments and receive deposits directly to your bank.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features" id="features">
  <div class="container comment">
        <div class="row">
            <div class="col-lg-4 my-auto">
              <img src="{{ asset('/images/mechanic-home.jpg')}}" alt="mechanic"/>
            </div>
            <div class="col-lg-8 my-auto">
                <div class="container-fluid">
                    <h3>Run Your Shop With Ease</h3>
                    <p>Our web-based, easy-to-use platform puts running every aspect of your repair shop all in one place. Save time with job templates, inventory management, tech timetracking, QuickBooks integration and more</p>
                </div>
            </div>
        </div>
    </div>
  <div class="container comment">
        <div class="row">
            <div class="col-lg-8 my-auto">
                <div class="container-fluid">
                    <h3>Provide World-Class Customer Service</h3>
                    <p>Use built-in tools to professionally communicate with customers through text and email with automated appointment confirmations, friendly reminders, follow-ups and inspection sheets.</p>
                </div>
            </div>
            <div class="col-lg-4 my-auto">
              <img src="{{ asset('/images/mechanic-desk.png')}}" alt="mechanic"/>
            </div>
        </div>
    </div>
    <div class="section-heading text-center">
        <h2>All the Features You Need</h2>
      {{--<p class="text-muted">Check out what you can do with this app theme!</p>--}}
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="feature-item">
                    <i class="fa fa-newspaper-o fa-4x" aria-hidden="true"></i>
                    <h3>Quotes & Invoices</h3>
                    <p class="text-muted">Grow your business without worrying about growing your costs.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="feature-item">
                    <i class="fa fa-calendar-check-o fa-4x" aria-hidden="true"></i>
                    <h3>Calendar & Scheduling</h3>
                    <p class="text-muted">Never miss a beat with appointments and planned work with the shop calendar.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="feature-item">
                    <i class="fa fa-search fa-4x" aria-hidden="true"></i>
                    <h3>Powerful Search</h3>
                    <p class="text-muted">Find the customer and car information you need the first time you try.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="feature-item">
                    <span class="fa-stack fa-lg" style="font-size:40px">
                      <i class="fa fa-folder-o fa-stack-2x" aria-hidden="true"></i>
                      <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                    </span>
                    <h3>Manage your books</h3>
                    <p class="text-muted">Ditch the sticky notes and notepads to track parts and work and get a real-time view.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact bg-primary" id="contact">
  <div class="section-content">
    <h1 class="section-header">Get in <span class="content-header wow fadeIn " data-wow-delay="0.2s"
                                            data-wow-duration="2s"> Touch with us</span></h1>
    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h3>
  </div>
  <div class="contact-section">
        <div class="container">
          <form action="{{ route('contactForm') }}" id="contactForm" method="POST">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="senderName">Your name</label>
                  <input type="text" name="senderName" class="form-control" id="senderName" placeholder=" Enter Name">
                </div>
                <div class="form-group">
                  <label for="senderEmail">Email Address</label>
                  <input type="email" name="senderEmail" class="form-control" id="senderEmail"
                         placeholder=" Enter Email id">
                </div>
                <div class="form-group">
                  <label for="telephone">Mobile No.</label>
                  <input type="tel" name="senderPhone" class="form-control" id="telephone"
                         placeholder=" Enter 10-digit mobile no.">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="message"> Message</label>
                  <textarea name="message" class="form-control" id="message"
                            placeholder="Enter Your Message"></textarea>
                </div>
                <div>

                  <button id="contactFormSubmitButton" type="submit" class="btn btn-default submit"><i
                      class="fa fa-paper-plane" aria-hidden="true"></i> Send Message
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; {{ date('Y') }} Cuesta. All Rights Reserved.</p>
      {{--<ul class="list-inline">--}}
      {{--<li class="list-inline-item">--}}
      {{--<a href="#">Privacy</a>--}}
      {{--</li>--}}
      {{--<li class="list-inline-item">--}}
      {{--<a href="#">Terms</a>--}}
      {{--</li>--}}
      {{--<li class="list-inline-item">--}}
      {{--<a href="#">FAQ</a>--}}
      {{--</li>--}}
      {{--</ul>--}}
    </div>
</footer>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/jquery-validate/jquery.validate.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>
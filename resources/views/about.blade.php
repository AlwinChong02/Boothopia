<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><title>About Page</title><link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="{{ asset('js/custom.js') }}"></script>
    </head>
    <header class="top-nav"><a href="/home">
        <img src="/img/boothopiaLogo.png" alt="Booking" class="logo" width="150" height="90"></a>
        @include('navigationbar')
    </header>
    <body>
        <section class="about-section">
            <div class="about-container">
                <h1 class="text-center">About Us</h1>
                <p class="text-center">Welcome to Boothopia, your ultimate destination for all things photo booths! We are a passionate team dedicated to providing you with the best photo booth experience for your events. Whether it's a wedding, birthday party, corporate event, or any special occasion, we have the perfect photo booth solution for you.</p>
                <p class="text-center">At Boothopia, we believe that capturing memories should be fun and easy. Our state-of-the-art photo booths come equipped with the latest technology, ensuring high-quality photos and a seamless experience for you and your guests. With a variety of props, backdrops, and customizable options, we make sure that every photo booth session is unique and tailored to your event.</p>
                <p class="text-center">Our team is committed to providing exceptional customer service from start to finish. We work closely with you to understand your needs and preferences, ensuring that every detail is taken care of. Our goal is to make your event unforgettable and leave you with lasting memories.</p>
                <p class="text-center">Thank you for choosing Boothopia! We look forward to being a part of your special moments.</p>
            </div>
        </section>
        <div class="wrapper">
            <button class="toggle-faq">
                How do I book a photo booth?
                <i class="fa fa-plus icon"></i>
            </button>
            <div class="content-faq">
                <p>You can easily book a photo booth by visiting our website and filling out the booking form, or by contacting our customer service team directly. We'll guide you through the process and help you choose the best package for your event.</p>
            </div>
        </div>
        <div class="wrapper">
            <button class="toggle-faq">
                What kind of events do you cater to?
                <i class="fa fa-plus icon"></i>
            </button>
            <div class="content-faq">
                <p>We cater to a wide range of events, including weddings, birthday parties, corporate events, and any other special occasions where you want to capture fun and lasting memories.</p>
            </div>
        </div>
    </body>
    @include('footer')
</html>


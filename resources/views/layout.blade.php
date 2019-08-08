<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Url Shortener</title>
    <link rel="stylesheet" href="/css/app.css" crossorigin="anonymous">
</head>
<body id="page-top">
<!-- Contact Section -->
<section class="page-section">
    <div class="container">
        <h2 class="page-section-heading text-center text-secondary mb-0"><a href="{{ route('root') }}">URL Shortener</a>
        </h2>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @yield('content')
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>

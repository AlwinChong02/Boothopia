<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Event</title>
    <link rel="stylesheet" href="{{ asset('css/myWeb.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .create-event-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .create-event-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control,
        .form-control-file,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .alert {
            padding: 10px;
            background: #f44336;
            color: white;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<header class="top-nav">
    <a href="/home">
        <img src="/img/boothopiaLogo.png" alt="Boothopia Logo" class="logo" width="150" height="90">
    </a>
    @include('navigationbar')
</header>
<body>
    <div class="container create-event-container">
        <h2>Create a New Event</h2>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert" style="background: #4CAF50;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Event creation form -->
        <form action="{{ route('organiser.event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Event Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter event name">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" placeholder="Enter event description"></textarea>
            </div>

            <div class="form-group">
                <label for="img">Event Image:</label>
                <input type="file" id="img" name="img" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter event location">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" class="form-control" placeholder="Enter event category">
            </div>

            <div class="form-group">
                <label for="booth_quantity">Booth Quantity:</label>
                <input type="number" id="booth_quantity" name="booth_quantity" class="form-control" placeholder="Enter number of booths">
            </div>

            <button type="submit" class="btn-primary">Create Event</button>
        </form>
    </div>

    <div class="footer">
        @include('footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-b5kHyXgcpbZl2nKp1spnkV01xJ8pR3tv9eVwA5PizL8WvC3Kpg5S6sOlNq9jk5kN" crossorigin="anonymous"></script>
</body>
</html>

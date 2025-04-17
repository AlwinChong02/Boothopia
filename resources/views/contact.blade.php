@extends('layouts.app')

@section('title', 'About Page')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush


@section('content')
        <div class="contact-container">
            <div class="contact-background">
                <img src="/img/contactBackground.png" alt="Booking" class="contact-background" width="1521" height="750">
            </div>
            <h1>Contact Us</h1>
            <p>For any inquiries, please contact us at:</p>
                <div class="col-container">  
                    <form action ="contact" method ="post">
                    <input type="hidden" id="user_id" name="get_user_id" value="{{ Auth::id() ?? '' }}" />
                    @csrf
                        <span class="name-err" style="color: red">@error('username'){{ $message }}@enderror</span>
                        <h5>Name</h5><input type="text" id="name" name="username" placeholder="Your name.."><br><br>

                        <span class="email-err" style="color: red">@error('email'){{ $message }}@enderror</span>
                        <h5>Email</h5><input type="email" id="email" name="email" placeholder="Your email.."><br><br>

                        <span class="feedback-err" style="color: red">@error('feedback'){{ $message }}@enderror</span>
                        <h5>What can we help you?</h5><textarea id="subject" name="feedback" placeholder="Write something.."></textarea>
                        <button class="btn-contact" type="submit">Submit</button>

                        <span style="color:rgb(57, 221, 57)"><h1 id="sub-contact">{{session ("message")}}</h1></span>
                    </form>
                </div>
        </div>
@endsection


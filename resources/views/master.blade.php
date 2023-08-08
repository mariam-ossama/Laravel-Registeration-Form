<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="registeration"/>
    <title>Registration Page</title>
  </head>

  <body>
     <header style="background-color: #9ec2e6;  color: #fff; padding: 10px; text-align: center; height:60px">
        <h1 style="margin: 0; font-size: 24px ;  text-align: center">{{ __('messages.welcome') }}</h1>
    <a style="text-decoration: none; color: #fff;" href="{{ route('lang.switch', 'ar')  }}">{{ __('messages.arabic') }}</a> <br/>
    <a style="text-decoration: none;color: #fff;" href="{{ route('lang.switch', 'en') }}">{{ __('messages.english') }}</a>
    </header>
     @section('content')

     @show
     <footer style="background-color: #9ec2e6;  color: #fff; padding: 7px; text-align: center; height:50px ;font-weight: bold">
        <p>&copy;  {{ __('messages.footer1') }}<br> {{ __('messages.footer2') }}</p>
      </footer>
  </body>

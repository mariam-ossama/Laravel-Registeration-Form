<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8"/>
    <meta name="description" content="registeration"/>
    <title>Registration Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>function validateForm(e) {

        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const name= document.getElementById('name').value;

        if(/\d/.test(name)){
            alert('Full name must not contain any numbers')
            e.preventDefault();
        }
        if(/[^\w\s]/.test(name)){
            alert('Full name must not contain any special charecters')
            e.preventDefault();
        }
        if (password !== confirmPassword) {
          alert('Entered passwords do not match')
        e.preventDefault();
        }
        if (password.length < 8) {
          alert('Password must be more than 8 characters long ')
        e.preventDefault();
        }
        if( !/\d/.test(password) ){
         alert('password must contain at least 1 number ')
        e.preventDefault();

        }
        if( !/[^\w\s]/.test(password) ){
         alert('password must contain at least 1 special charecter ')
        e.preventDefault();
        }}

        //Ajax function
        function getActors()
        {
            var xmlhttp = new XMLHttpRequest();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            date = document.getElementsByName("date")[0].value;
            var d = new Date(date);
            month = d.getMonth()+1;
            day = d.getDate();
            xmlhttp.open("GET", "samedate/"+month+"/"+day,true);
            xmlhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            if(date.length ==0)
            {
                  document.getElementById("actors").innerHTML = "";
            }
            else
            {
                xmlhttp.onreadystatechange = function()
                {
                       if(this.status == 200 && this.readyState == 4)
                       {
                          document.getElementById("actors").innerHTML = this.responseText ;
                          console.log("The response arrived");
                       }
                };
                 xmlhttp.send();
                 console.log("The request was sent");

            }
        }
        </script>
        <style>
          body {font-family: Arial, sans-serif; background-color: #ece7e7; margin: 0; padding: 0;}
          main {width: 400px; margin: 0 auto; background-color: rgb(255, 255, 255); padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.2);}
          label {display: block; font-weight: bold; margin-bottom: 5px;}
          span {color: red;}
          input[type=button], input[type=submit] {background-color: #2271b1; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;}
        </style>
  </head>
  <body>
    @extends('master')
    @section('content')
    <main>
      <form name="myform" method="POST" action="submit"  onsubmit="return validateForm(event)" style="text-align:{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}">
      @csrf
      <span>
        {{ nl2br(__('messages.required')) }}
        <br>
        {{ nl2br(__('messages.fullname')) }}
        <br>
        {{ nl2br(__('messages.password')) }}
        <br>
        {{ nl2br(__('messages.confirmpassword')) }}
        <br> <br>
       </span>

        <label><span>*</span>{{ __('messages.lfullname') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="text" name="name" id="name" required><br><br>
        <label><span>*</span>{{ __('messages.lusername') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="text"  name="username" required ><br><br>
        <label><span>*</span>{{ __('messages.lemail') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="email"  name="email" placeholder="email@example.io" required ><br><br>
        <label><span>*</span>{{ __('messages.ldate') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="date"  name="date"required > <input type="button" value="{{htmlentities(__('messages.bactors'))}}" onclick="getActors()"><br><br>
        <p id="actors"></p>
        <label><span>*</span>{{ __('messages.lphone') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="text"  name="phone"required ><br><br>
        <label><span>*</span>{{ __('messages.laddress') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="text"  name="address"required ><br><br>
        <label><span>*</span>{{ __('messages.lpassword') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="password" name="password"  id="password" required ><br><br>
        <label><span>*</span>{{ __('messages.lconfirm') }}<span>{{ __('messages.lrequired') }}</span></label>
        <input type="password" name="confirm_password" id="confirm_password" required ><br><br>
        <input type="submit" value={{ __('messages.bsubmit') }} >
      </form>
    </main>
    @endsection
  </body>
</html>

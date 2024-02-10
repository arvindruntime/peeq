<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>419 Page Expired</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon1.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
     body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        /*====================== 419 page =======================*/

.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
 }
 

.four_zero_four_bg{
  width: 500px;
}

 
 .four_zero_four_bg h1{
 font-size:80px;
 }
 
  .four_zero_four_bg h3{
       font-size:80px;
       }
       
       .link_404{      
  color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
  .contant_box_404{ margin-top:-50px;}

  /* New css */
 
  @media (max-width:768px){
    .error-img{
      height: 400px;
    }

  }
  @media (max-width:576px){
    .error-img{
      height: 280px;
    }

  }

  @media (max-width:425px){
    .error-img{
      height: 210px;
    }

  }
    </style>
</head>
<body>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-10 mx-auto">
          <div>
            <img class="error-img mx-auto mb-5" src="{{ asset('assets/images/419.svg') }}" alt="Error 404">
            <h1 class="fw-bold">
            Page Expired
            </h1>
            <p class="text-dark">Oops! It looks like the page has expired due to inactivity.</p>
            <a href="{{ route('login') }}" class="btn btn--primary px-5">Go to Home</a>
          </div>
        </div>
      </div>
    </div>
  </section>    
</body>
</html>

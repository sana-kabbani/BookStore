<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">
         .center{
             margin: auto;
             width: 70%;
             text-align: center;
             padding: 20px;
         }
         .font_size
         {
             text-align: center;
             font-size: 40px;
             padding-top: 20px;
             fon
             
         }
         .img_size
         {
             width: 75px;
             height: 150px;
         }
         .th_color
         {
             background: skyblue;
         }
         .th_deg
         {
             padding: 5px;
             font-size: 30px;
             background: rgb(173, 120, 174);

         }
         .img_deg
         {
            width: 120px;
            height: 200px;
         }
         table,th,td{
            border: 1px solid gray
         }
         .total_deg{
            font-size: 20px;
            padding: 40px;
         }
         td{
            padding: 30px;
            font-weight: bold
         }
     
         </style>
   </head>
   <body>
      <div class="hero_area">
        @include('home.header')
         <!-- slider section -->
      <!-- end cart section -->
<div class ="center">
   <div style="padding-left: 230px">
     
      <table >
         
          <?php $totalprice=0; ?>
          @foreach($cart as $cart)
          <tr>
              <td>{{ $cart->product_title }}</td>

              <td>{{ $cart->price }}</td>
              <td>{{ $cart->quantity }}</td>
              <td> <img class="img_deg" src="/product/{{ $cart->image }}"></td>
              <td> <a class="btn btn-danger" href="{{ url('remove_cart', $cart->id) }}"> Ürün Sil</td>

    

          </tr>
          <?php $totalprice = $totalprice  +$cart->price ?>
          @endforeach



      </table>
</div>
      <div>
        <h1 class="total_deg">  Tüm Fiyatı:        {{ $totalprice }}
        </h1>
      </div>
      <div>
        <h1 style="font-size: 25px ; padding-bottom : 15 px"> Sepeti Onayla</h1>
        <a href="{{ url('cash_order') }}" class="btn btn-danger"> Kapıda Ödeme</a> 

        <a href="{{ url('stripe' , $totalprice) }}" class="btn btn-danger"> Kart ile Öde</a> 

      </div>

   </div>

      <!-- footer start -->
 
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
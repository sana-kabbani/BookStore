<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
Önerdiğimiz <span> Kitaplar </span>           </h2>
       </div>
       <div class="row">
        @foreach ($product as $product)
            
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{ url('product_details',$product->id) }}" class="option1">
                        Kitap Hakkında                      </a>
                      <form action="{{ url('add_cart',$product->id) }}" method="Post">
                        {{ csrf_field() }}                        <div class="row">
                           <div class="col-md-4">
                        <input type="number" name="quantity" value="1" min="1" >
                           </div>
                           <div class="col-md-4">

                        <input type="submit" value="Sepete Ekle">
                           </div>
                        </div>
                      </form>
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{ $product->image }}" alt="">
                </div>
                <div class="detail-box">
                   <h5 style="padding-top: 50px">
                     {{ $product->title }}
                   </h5>
                   <h6 style="padding-top: 50px">
                     ${{ $product->price }}
                   </h6>
                </div>
             </div>
          </div>

         
                @endforeach


     
    </div>
 </section>
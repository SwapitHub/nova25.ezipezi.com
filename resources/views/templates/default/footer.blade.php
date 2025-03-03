 
<!--Footer-->
<footer>
<div class="main-footer">
  <div class="container">
    <div class="footer-inner">
      <div class="footer-content">
      <div class="fcols col-1">
        <div class="logo-footer">
          <h2><a href="{{ route('home') }}"><img style="max-width: 150px;" src="{{  asset(sc_store('logo')) }}"></a></h2>
        </div>
      </div>
        <div class="fcols col-2">
          <?php $widget1 = App\Models\Widget::getSinglewidget('footer-second'); 
         echo $widget1->description; ?>
          
          
        </div>
        <div class="fcols col-3">
          <?php $widget2 = App\Models\Widget::getSinglewidget('footer-third'); 
         echo $widget2->description; ?>
        </div>
        <div class="fcols col-4">
          <?php $widget3 = App\Models\Widget::getSinglewidget('footer-fourth'); 
         echo $widget3->description; ?>
        </div>  
      </div>
    </div>
    
    <div class="footer-bottom">
      <?php $widget4 = App\Models\Widget::getSinglewidget('copyright'); 
         echo $widget4->description; ?>
    </div>  
  </div>
  </div>
  <div class="disclaimer-outer">
  <div class="container">
    <div class="disclaimer">
      
    </div>
  </div>
  </div>

  <div class="alert text-center cookiealert" role="alert">
    <?php $widget4 = App\Models\Widget::getSinglewidget('gdpr'); 
        
    echo $widget4->description;
    ?> 

    
</div>
</footer>                                             
            
</div>
<!--Module top footer -->
<?php /*
  @isset ($blocksContent['footer'])
      @foreach ( $blocksContent['footer']  as $layout)
        @php
          $arrPage = explode(',', $layout->page)
        @endphp
        @if ($layout->page == '*' ||  (isset($layout_page) && in_array($layout_page, $arrPage)))
          @if ($layout->type =='html')
            {!! $layout->text !!}
          @elseif($layout->type =='view')
            @if (view()->exists('blockView.'.$layout->text))
             @include('blockView.'.$layout->text)
            @endif
          @elseif($layout->type =='module')
            {!! sc_block_render($layout->text) !!}
          @endif
        @endif
      @endforeach
  @endisset

<!--//Module top footer -->

  <?php $widgets = array("footer-second", "footer-third", "footer-fourth");
      
  
  ?>
  <footer id="footer"><!--Footer-->
    <div class="footer-widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="single-widget">
              <h2><a href="{{ route('home') }}"><img style="max-width: 150px;" src="{{  asset(sc_store('logo')) }}"></a></h2>
             <!-- <ul class="nav nav-pills nav-stacked">
               <li>{{ sc_store('title') }}</li>
             </ul> -->
            </div>
          </div>
         <?php foreach($widgets as $alias) {
          $widget = App\Models\Widget::getSinglewidget($alias); ?>  
  
          <div class="col-sm-3">
            <div class="single-widget">
              <?php echo $widget->description; ?>
            </div>
          </div>
        <?php } ?>
          <!-- <div class="col-sm-3">
            <div class="single-widget">
              <h2>{{ trans('front.about') }}</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">{{ trans('front.shop_info.address') }}: {{ sc_store('address') }}</a></li>
                <li><a href="#">{{ trans('front.shop_info.hotline') }}: {{ sc_store('long_phone') }}</a></li>
                <li><a href="#">{{ trans('front.shop_info.email') }}: {{ sc_store('email') }}</a></li>
            </ul>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="single-widget">
              <h2>{{ trans('front.subscribe.title') }}</h2>
              <form action="{{ route('subscribe') }}" method="post" class="searchform">
                @csrf

                <input type="email" name="subscribe_email" required="required" placeholder="{{ trans('front.subscribe.subscribe_email') }}">
                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                <p>{{ trans('front.subscribe.subscribe_des') }}</p>
              </form>
            </div>
          </div> -->

        </div>
      </div>
    </div>

   <!--  <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <p class="pull-left">Copyright © {{date('Y')}} <a href="{{ route('home') }}">{{ sc_store('title') }} </a> Inc. All rights reserved.</p>
          <p class="pull-right">Power by <a href="{{ config('scart.homepage') }}">{{ config('scart.name') }} {{ config('scart.version') }}</a>. Hosted by  <span><a target="_blank" href="https://giaiphap247.com">GiaiPhap247</a></span></p>
           
        </div>
      </div>
    </div> -->
  </footer>
<!--//Footer-->
*/?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

$(document).ready(function() {

  $('.acco-gallery .gallery-item img').mouseover(function(){
    var imgurl = $(this).attr('src');
    //$('section.banner_product-listing').css('background-image', 'url(' + imgurl + ')');
    $('section.banner_product-listing .banner-image img').attr('src', imgurl);
    //alert(imgurl);
    });

  $('select.reg_country').change(function(){

       var cid = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('getstate') }}',
                data: {
                  cid:cid,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.province').html(data);
                }
            });
    });

    $('select.bcountry').change(function(){

       var cid = $(this).val();
        $.ajax({
                method: 'post',
                url: '{{ route('getstate') }}',
                data: {
                  cid:cid,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                   $('select.bprovince').html(data);
                }
            });
    });

  $('.declinecookies').click(function(){
    $('.cookiealert').remove();
  });
  $(".text-area").readMore({lines: 3, readMoreLabel: "Read more",       readLessLabel: "Read less",});
    
    
    $('.banner-slider').slick({
          dots: true,
          infinite: true,
          speed: 1000,
          slidesToShow: 1,
          adaptiveHeight: true,
      autoplay: true  
        });
    
      $('.nav-btn').click(function(){
         $('.wrapper').toggleClass('overflow');
         $('.nav-toggler').toggleClass('sidebar');
        });

      $('.menu-bar .dropdown .fa-angle-down').click(function(){
        $(this).siblings('ul.sub-menu').slideToggle();
      });

        $('.team-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
   adaptiveHeight: true,
   autoplay: true,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow:4,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
    
    $( "#generate_pdf_btn" ).click(function() {
  $('#pdddd').show();
 
  setTimeout(function(){ make_product_sheet(); }, 500);
  setTimeout(function(){  $('#pdddd').hide(); }, 1000);
  
  
});


function make_product_sheet() {
  var quotes = document.getElementById('pdddd');

    html2canvas(quotes, {
    onrendered:function(canvas) {
  
        var contentWidth = canvas.width;
        var contentHeight = canvas.height;
  
        //The height of the canvas which one pdf page can show;
        var pageHeight = contentWidth / 592.28 * 841.89;
        //the height of canvas that haven't render to pdf
        var leftHeight = contentHeight;
        //addImage y-axial offset
        var position = 0;
        //a4 format [595.28,841.89]       
              var imgWidth = 595.28;
        var imgHeight = 592.28/contentWidth * contentHeight;
  
        var pageData = canvas.toDataURL('image/jpeg', 1.0);
  
        var pdf = new jsPDF('', 'pt', 'a4');
  
       if (leftHeight < pageHeight) {
            pdf.addImage(pageData, 'JPEG', 0, 0, imgWidth, imgHeight );
        } else {
            while(leftHeight > 0) {
                pdf.addImage(pageData, 'JPEG', 0, position, imgWidth, imgHeight)
                leftHeight -= pageHeight;
                position -= 841.89;
                //avoid blank page
                if(leftHeight > 0) {
                    pdf.addPage();
                }
            }
        }
  
        pdf.save('content.pdf');
    }
      })
    


    /*console.log("#generate_pdf_btn clicked");
    var pdf = new jsPDF('p', 'pt', 'a4');
    pdf.addHTML(document.getElementById("pdddd"), function() {
      

        ps_filename = "generated-product-sheet";
        pdf.save(ps_filename+'.pdf');
    });*/
}
    
  });

 </script>



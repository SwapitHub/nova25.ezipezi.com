 {{-- <!--Footer-->
 <footer>
     <div class="main-footer">
         <div class="container">
             <div class="footer-inner">
                 <div class="footer-content">
                     <div class="fcols col-1">
                         <div class="logo-footer">
                             <h2><a href="{{ route('home') }}"><img style="max-width: 150px;"
                                         src="{{ asset(sc_store('logo')) }}"></a></h2>
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script>
     $(document).ready(function() {

         $('.acco-gallery .gallery-item img').mouseover(function() {
             var imgurl = $(this).attr('src');
             //$('section.banner_product-listing').css('background-image', 'url(' + imgurl + ')');
             $('section.banner_product-listing .banner-image img').attr('src', imgurl);
             //alert(imgurl);
         });

         $('select.reg_country').change(function() {

             var cid = $(this).val();
             $.ajax({
                 method: 'post',
                 url: '{{ route('getstate') }}',
                 data: {
                     cid: cid,
                     _token: '{{ csrf_token() }}',
                 },
                 success: function(data) {
                     $('select.province').html(data);
                 }
             });
         });

         $('select.bcountry').change(function() {

             var cid = $(this).val();
             $.ajax({
                 method: 'post',
                 url: '{{ route('getstate') }}',
                 data: {
                     cid: cid,
                     _token: '{{ csrf_token() }}',
                 },
                 success: function(data) {
                     $('select.bprovince').html(data);
                 }
             });
         });

         $('.declinecookies').click(function() {
             $('.cookiealert').remove();
         });
         $(".text-area").readMore({
             lines: 3,
             readMoreLabel: "Read more",
             readLessLabel: "Read less",
         });


         $('.banner-slider').slick({
             dots: true,
             infinite: true,
             speed: 1000,
             slidesToShow: 1,
             adaptiveHeight: true,
             autoplay: true
         });

         $('.nav-btn').click(function() {
             $('.wrapper').toggleClass('overflow');
             $('.nav-toggler').toggleClass('sidebar');
         });

         $('.menu-bar .dropdown .fa-angle-down').click(function() {
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
             responsive: [{
                     breakpoint: 1024,
                     settings: {
                         slidesToShow: 4,
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
             ]
         });

         $("#generate_pdf_btn").click(function() {
             $('#pdddd').show();

             setTimeout(function() {
                 make_product_sheet();
             }, 500);
             setTimeout(function() {
                 $('#pdddd').hide();
             }, 1000);


         });


         function make_product_sheet() {
             var quotes = document.getElementById('pdddd');

             html2canvas(quotes, {
                 onrendered: function(canvas) {

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
                     var imgHeight = 592.28 / contentWidth * contentHeight;

                     var pageData = canvas.toDataURL('image/jpeg', 1.0);

                     var pdf = new jsPDF('', 'pt', 'a4');

                     if (leftHeight < pageHeight) {
                         pdf.addImage(pageData, 'JPEG', 0, 0, imgWidth, imgHeight);
                     } else {
                         while (leftHeight > 0) {
                             pdf.addImage(pageData, 'JPEG', 0, position, imgWidth, imgHeight)
                             leftHeight -= pageHeight;
                             position -= 841.89;
                             //avoid blank page
                             if (leftHeight > 0) {
                                 pdf.addPage();
                             }
                         }
                     }

                     pdf.save('content.pdf');
                 }
             })

         }

     });
 </script> --}}


 <section class="footer-sec">
     <div class="top-footer">
         <div class="container">
             <div class="footer-inner-top">
                 <div class="footer-top-column">
                     <h3 class="modtitle"><i class="fa fa-map-marker" aria-hidden="true"></i>Find your nearest
                         store</h3>
                     <div class="modcontent">
                         <p>A contemporary grooming collection infused with the invigorating and sensual scent of
                             Revoshop</p>
                         <span>Find your store</span><a class="button" href="#">SHOP SYSTEM</a>
                     </div>
                 </div>
                 <div class="footer-top-column">
                     <div class="newsletter" style="width:100%; ">
                         <h3 class="modtitle"><i class="fa fa-envelope"></i> Newsletter </h3>
                         <div class="promotext">Contrary to popular belief, Lorem Ipsum is not simply random text.
                             It has roots in a piece of classical Latin literature from 45 BC, making it over 2000
                             years old.</div>
                         <div class="block_content">
                             <form method="post" id="signup" name="signup"
                                 class="form-group form-inline signup send-mail">
                                 <div class="form-group">
                                     <div class="input-box">
                                         <input type="email" placeholder="Your email address..." value=""
                                             class="form-control" id="txtemail" name="txtemail" size="55">
                                     </div>
                                     <div class="subcribe">
                                         <button class="btn btn-primary btn-default font-title" type="submit"
                                             onclick="return subscribe_newsletter();" name="submit">
                                             <span>Go</span>
                                         </button>
                                     </div>
                                 </div>
                             </form>


                         </div> <!--/.modcontent-->

                     </div>
                 </div>
                 <div class="footer-top-column">
                     <div class="box-social box-footer">
                         <div class="module clearfix">
                             <h3 class="modtitle">follow us!</h3>
                             <ul class="socials">
                                 <li class="facebook"><a href="https://www.facebook.com/smartaddons.page"
                                         target="_blank"><i class="fa fa-facebook"></i></a>
                                     <p>on</p>
                                     <h4>Facebook</h4>
                                 </li>
                                 <li class="twitter"><a href="https://twitter.com/smartaddons" target="_blank"><i
                                             class="fa fa-twitter"></i></a>
                                     <p>on</p>
                                     <h4>Twitter</h4>
                                 </li>
                                 <li class="google_plus"><a href="https://plus.google.com/u/0/+Smartaddons/posts"
                                         target="_blank"><i class="fa fa-google-plus"></i></a>
                                     <p>on</p>
                                     <h4>Google plus</h4>
                                 </li>

                                 <li class="instagram"><a href="#" target="_blank"><i
                                             class="fa fa-instagram"></i></a>
                                     <p>on</p>
                                     <h4>Instagram</h4>
                                 </li>
                             </ul>
                             <div class="logo-payment-footer">
                                 <a href="#"><img data-sizes="auto" class="lazyautosizes lazyloaded"
                                         src="{{ asset($templateFile . '/images/theme-images') }}/logo-payment-footer.png"
                                         data-src="{{ asset($templateFile . '/images/theme-images') }}/logo-payment-footer.png"
                                         alt="logo payment" sizes="50px"></a>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>


     <div class="main-footer">
         <div class="main-footer-bg">
             <div class="container">
                 <div class="main-footer-inner">
                     <div class="main-footer-clumn">
                         <div class="box-account box-footer">
                             <div class="module clearfix">
                                 <h3 class="modtitle">My Account</h3>
                                 <div class="modcontent">
                                     <ul class="menu">
                                         <li><a href="index.php?route=product/manufacturer">Brands</a></li>
                                         <li><a href="index.php?route=account/voucher">Gift Certificates</a></li>
                                         <li><a href="index.php?route=affiliate/login">Affiliates</a></li>
                                         <li><a href="index.php?route=product/special">Specials</a></li>
                                         <li><a href="#">FAQs</a></li>

                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="main-footer-clumn">
                         <div class="box-information box-footer">
                             <div class="module clearfix">
                                 <h3 class="modtitle">YOUR LINKS</h3>
                                 <div class="modcontent">
                                     <ul class="menu">
                                         <li><a href="#">Shipping guide</a></li>
                                         <li><a href="#">Store location</a></li>
                                         <li><a href="#">Afiliates</a></li>
                                         <li><a href="#">Customer point policy</a></li>
                                         <li><a href="#">Customer point policy</a></li>

                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="main-footer-clumn">
                         <div class="box-information box-footer">
                             <div class="module clearfix">
                                 <h3 class="modtitle">Information</h3>
                                 <div class="modcontent">
                                     <ul class="menu">
                                         <li><a href="index.php?route=information/information&amp;information_id=11">About
                                                 Us</a></li>
                                         <li><a
                                                 href="index.php?route=information/information&amp;information_id=6">FAQ</a>
                                         </li>
                                         <li><a href="index.php?route=information/information&amp;information_id=3">Warranty
                                                 And Services</a></li>
                                         <li><a href="index.php?route=information/information&amp;information_id=7">Support
                                                 24/7 page</a></li>
                                         <li><a href="index.php?route=extension/simple_blog/article">Blog</a></li>

                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="main-footer-clumn">
                         <div class="box-information box-footer">
                             <div class="module clearfix">
                                 <h3 class="modtitle">Information</h3>
                                 <div class="modcontent">
                                     <ul class="menu">
                                         <li><a href="index.php?route=information/information&amp;information_id=11">About
                                                 Us</a></li>
                                         <li><a
                                                 href="index.php?route=information/information&amp;information_id=6">FAQ</a>
                                         </li>
                                         <li><a href="index.php?route=information/information&amp;information_id=3">Warranty
                                                 And Services</a></li>
                                         <li><a href="index.php?route=information/information&amp;information_id=7">Support
                                                 24/7 page</a></li>
                                         <li><a href="index.php?route=extension/simple_blog/article">Blog</a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="main-footer-clumn">
                         <div class="box-contact box-footer">
                             <div class="module clearfix">
                                 <h3 class="modtitle">Contact Us</h3>
                                 <ul class="links-contact">
                                     <li class="address">
                                         <i class="fa fa-home" aria-hidden="true"></i> <span>Address : No 40
                                             Baria Sreet 133/2 NewYork City, NY, United States</span>
                                     </li>
                                     <li class="mail">
                                         <i class="fa fa-envelope" aria-hidden="true"></i><a
                                             href="mailto:contact@opencartworks.com">Email : contact@market.com</a>
                                     </li>
                                     <li class="phone">
                                         <i class="fa fa-phone" aria-hidden="true"></i><span>Phone 1 : 0123456789
                                             <br>Phone 2 : 0123456789</span>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="copy-writer-footer-main">
         <div class="container">
             <div class="copy-write-inner">
                 <div class="copy-write-column">
                     <img src="{{ asset($templateFile . '/images/theme-images') }}/payment-footer.png" alt="img">
                 </div>
             </div>
         </div>
     </div>
 </section>

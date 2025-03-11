 <!--Footer-->
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
 </script>


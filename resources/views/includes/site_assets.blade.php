{{ HTML::script('assets/js/jquery.min.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/script.js') }}
{{ HTML::script('assets/js/sweetalert/sweetalert.min.js') }}

<!--for resize header-->
{{ HTML::script('assets/js/classie.js') }}

<script>
    function init() {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 100,
                header = document.querySelector("header");
            if (distanceY > shrinkOn) {
                classie.add(header,"smaller");
            } else {
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                }
            }
        });
    }
  window.onload = init();
</script>
<!--for resize header-->

<!--for banner slider-->
{{-- {{ HTML::script('assets/js/jquery-ui-1.js') }} --}}
{{ HTML::script('assets/js/jquery-ui-1.11.4.custom/jquery-ui.min.js') }}
{{ HTML::script('assets/js/jb_fws.js') }}

<script type="text/javascript">
  jQuery(document).ready(function(){
      JBFWS = new JBFWS();
      JBFWS.init({
          width            : "100%",
          height           : "760px",
          showBigButtons   : 1,
          showSmallButtons : 1,
          slideSpeed       : 1000,
          slideEffect      : "easeInOutExpo",
          slideDelay       : 600,
          slideSpeed2      : 1000,
          slideEffect2     : "easeOutExpo",
          dragSlide        : 1,
          autoSlide        : 1,
          autoSlideDelay   : 10000
      });
  });
  </script>
<!--for banner slider-->
<!--for testimonials slider-->
{{ HTML::script('assets/js/owl.carousel.js') }}

<script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({

      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true

      // "singleItem:true" is a shortcut for:
      // items : 1,
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false

      });
    });
</script>
<!--for testimonials slider-->
<!--for search toggle-->
<script type="text/javascript">
function toggle1() {
	var ele = document.getElementById("toggleText1");
	var text = document.getElementById("displayText1");
	$("#toggleText1").slideToggle(300);
}
</script>
<!--for search toggle-->

<!-- for expertise -->
{!! Html::style('assets/css/expertise/style.css') !!}
{{ HTML::script('assets/js/expertise/script.js') }}
<!-- /for expertise -->

<!-- for question answer -->
{!! Html::style('assets/css/question-answer/style.css') !!}
{{ HTML::script('assets/js/question-answer/script.js') }}
<!-- /for question answer -->

<!-- FOR PROFILE -->
{{ HTML::script('assets/js/profile/profile.js') }}
<!-- /FOR PROFILE -->

<!-- for Tags START  -->
{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js') }}
{{ HTML::script('assets/js/tags/tags.js') }}
<!-- for Tags END  -->

<!-- Jquery Validator -->
{{ HTML::script('assets/js/jquery-form-validator/2.2.8/jquery.form-validator.min.js') }}

<!-- Toastr -->
{{ HTML::script('assets/js/toastr/toastr.min.js') }}
{!! Toastr::render() !!}

{{ HTML::script('assets/js/login/script.js') }}

<!-- for Appointment START  -->
{{ HTML::script('assets/js/appointment/appointment.js') }}
<!-- for Appointment END  -->

<!-- for Browse START  -->
{{ HTML::script('assets/js/browse/script.js') }}
<!-- for Browse END  -->

<!-- for Browse START  -->
{{ HTML::script('assets/js/search/script.js') }}
<!-- for Browse END  -->

<!-- open login / register popup -->
<script type="text/javascript">
$(document).ready(function() {
		$($('#popup-action-required').val()).click();
});

</script>
<!-- open login / register popup -->

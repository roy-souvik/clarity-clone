{{ HTML::script('assets/js/jquery.min.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/script.js') }}


<!-- Add mousewheel plugin (this is optional) fancybox -->
{{ HTML::script('assets/js/fancybox-2.1.5/lib/jquery.mousewheel-3.0.6.pack.js') }}

<!-- Add fancyBox -->
{!! Html::style('assets/js/fancybox-2.1.5/jquery.fancybox.css?v=2.1.5') !!}
{{ HTML::script('assets/js/fancybox-2.1.5/jquery.fancybox.pack.js?v=2.1.5') }}


<!-- Optionally add helpers - button, thumbnail and/or media -->
{!! Html::style('assets/js/fancybox-2.1.5/helpers/jquery.fancybox-buttons.css?v=1.0.5') !!}

{{ HTML::script('assets/js/fancybox-2.1.5/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}
{{ HTML::script('assets//js/fancybox-2.1.5/helpers/jquery.fancybox-media.js?v=1.0.6') }}
	
<!-- DataTables JavaScript -->
{{ HTML::script('assets/js/DataTables/datatables.min.js') }}

<!-- DataTables CSS -->
{!! Html::style('assets/js/DataTables/datatables.min.css') !!}

<!-- DataTables Responsive CSS -->
{!! Html::style('assets/css/responsive.dataTables.css') !!}

<!-- Jquery Validator -->
{{ HTML::script('assets/js/jquery-form-validator/2.2.8/jquery.form-validator.min.js') }}



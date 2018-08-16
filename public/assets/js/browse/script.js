jQuery(document).ready(function () {
    baseUrl = $('#baseUrl').val();
    jQuery('#filter-expertise a').on('click', function () {
        var filter_type = jQuery(this).attr('aria-controls');
        var category = jQuery(this).attr('data-category');
        var sort_by = jQuery(this).attr('data-sort_by');
        var page_url = baseUrl+"/browse_filter";

        jQuery('#' + filter_type).html('<span class="expertise-loading" style=""><i class="fa fa-spinner fa-spin "></i></span>');
        jQuery('#browse_sort_by').attr('data-filter', filter_type);

        ajax_filter_browse(category, filter_type, sort_by, page_url, 'html');
    });

    jQuery('#browse_sort_by').on('change', function () {
        var filter_type = jQuery(this).attr('data-filter');
        var target = jQuery('#filter-expertise a[aria-controls='+filter_type+']');
        jQuery('#filter-expertise a').attr('data-sort_by', jQuery(this).val());
        target.trigger('click');
    });

    jQuery(document).on('click', '.loadmore-expertise', function(){
        var $loadmore = jQuery(this);
        var filter_type = $loadmore.attr('data-filter_type');
        var category = $loadmore.attr('data-category');
        var sort_by = $loadmore.attr('data-sort_by');
        var page_url = $loadmore.attr('data-target');

        ajax_filter_browse(category, filter_type, sort_by, page_url, 'append');
    });
});

function ajax_filter_browse(category, filter_type, sort_by, page_url, action){
    var request = $.ajax({
        url: page_url,
        type: "GET",
        data: {category: category, filter_type: filter_type, sort_by: sort_by },
        dataType: "html"
    });

    request.done(function(result) {
        if(action == 'append'){
            jQuery('#' + filter_type).find('.load').remove();
            jQuery('#' + filter_type).append(result);
        }
        else{
            jQuery('#' + filter_type).html(result);
        }
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}
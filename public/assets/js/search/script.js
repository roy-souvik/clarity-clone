jQuery(document).ready(function () {
    baseUrl = $('#baseUrl').val();
    jQuery('#filter-search-expertise a').on('click', function () {
        var filter_type = jQuery(this).attr('aria-controls');
        var q = jQuery(this).attr('data-search');
        var sort_by = jQuery(this).attr('data-sort_by');
        var page_url = baseUrl+"/search_filter";

        jQuery('#' + filter_type).html('<span class="expertise-loading" style=""><i class="fa fa-spinner fa-spin "></i></span>');
        jQuery('#search_sort_by').attr('data-filter', filter_type);

        ajax_filter_search(q, page_url, 'html', filter_type, sort_by);
    });

    jQuery('#search_sort_by').on('change', function () {
        var filter_type = jQuery(this).attr('data-filter');
        var target = jQuery('#filter-search-expertise a[aria-controls='+filter_type+']');
        jQuery('#filter-search-expertise a').attr('data-sort_by', jQuery(this).val());
        target.trigger('click');
    });

    jQuery(document).on('click', '.loadmore-search-expertise', function(){
        var $loadmore = jQuery(this);
        var filter_type = $loadmore.attr('data-filter_type');
        var q = $loadmore.attr('data-search');
        var sort_by = $loadmore.attr('data-sort_by');
        var page_url = $loadmore.attr('data-target');

        ajax_filter_search(q, page_url, 'append', filter_type, sort_by);
    });

    //FOR USERS
    jQuery(document).on('click', '.loadmore-search-users', function(){
        var $loadmore = jQuery(this);
        var q         = $loadmore.attr('data-search');
        var page_url  = $loadmore.attr('data-target');
        ajax_filter_search(q, page_url, 'append', 'all');
    });
});

function ajax_filter_search(q, page_url, action, filter_type, sort_by){

    filter_type = (typeof filter_type === 'undefined') ? '' : filter_type;
    sort_by = (typeof sort_by === 'undefined') ? '' : sort_by;

    var request = $.ajax({
        url: page_url,
        type: "GET",
        data: {q: q, filter_type: filter_type, sort_by: sort_by },
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

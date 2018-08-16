jQuery(document).ready(function(){
    var baseUrl   = jQuery('#baseUrl').val();
    jQuery('#expertise_tags').select2({
        placeholder: "Tags related to your listing...",
        minimumInputLength: 3,
        ajax: {
            url : baseUrl + "/get_topics",
            dataType: "json",
            delay : 250,
            data: function (params) {
                var queryParameters = {
                    q: params.term
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: jQuery.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        };
                    })
                };
            }
        }
    });
    
    jQuery('#timezone').select2({
        placeholder: "Select a timezone"
    });
    
    jQuery('.add-expertise #choose_category').on('change', function(){
        if(this.value!=''){
            jQuery.ajax({                
                type: "POST",
                cache: false,
                data: {'_token':jQuery('input[name="_token"]').val(), 'parent':this.value},
                dataType: "json",
                url: "/expertise/ajax/get_child_categories",                  
                cache: false,
                success: function(data){
                    if(data.status){
                        var result = data.result;
                        var sub_category_options = '<option value="">Select a subcategory</option>';
                        jQuery.each(result, function(key, item) {
                            sub_category_options += '<option value="'+item.id+'">'+item.name+'</option>'
                        });
                        jQuery('#choose_subcategory').html(sub_category_options).removeAttr('disabled');
                    }
                    else{
                        var sub_category_options = '<option value="">No subcategory</option>';
                        jQuery('#choose_subcategory').html(sub_category_options).attr('disabled','disabled');
                    }
                }                 
            });
        }
        else{
            var sub_category_options = '<option value="">No subcategory</option>';
            jQuery('#choose_subcategory').html(sub_category_options).attr('disabled','disabled');
        }
    });
});
jQuery(document).ready(function(){
    var baseUrl   = jQuery('#baseUrl').val();
    jQuery('#question_tags').select2({
        placeholder: "Search to choose a topic",
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
    jQuery(document).on('click', '.load_more_questions', function(){
        var $this = jQuery(this);
        var next_questions_page = $this.attr('data-target');
        var type = $this.attr('data-type');
        var q = $this.attr('data-search');
        console.log(next_questions_page);

        $this.addClass('disabled');
        $this.find('.state-normal').hide();
        $this.find('.state-loading').show();
        jQuery.ajax({
            type: "GET",
            cache: false,
            dataType: "html",
            url: next_questions_page,
            data: {type: type, q: q},
            success: function(response){

                jQuery('#' + type + '-questions-listing').find('.load_more_questions').remove();
                jQuery('#' + type + '-questions-listing').append(response);

                $this.removeClass('disabled');
                $this.find('.state-loading').hide();
                $this.find('.state-normal').show();
            }
        });
    });

    jQuery(document).on('click', '.dismiss', function () {
        $this = jQuery(this);
        var baseUrl = jQuery('#baseUrl').val();
        var question_id = jQuery(this).attr('data-question-id');
        jQuery.ajax({
            type: "GET",
            cache: false,
            dataType: "text",
            url: baseUrl+'/questions/skip/'+question_id,
            success: function (response) {
                if(response != 'ERROR'){
                    $this.parent().slideUp('normal');
                    jQuery('#open_questions_count').html('('+response+')');
                }
                if(response == '0'){
                    jQuery('#open-questions-listing').html('No available question');
                }
            }
        });
    });

    jQuery('.searchQuestionForm').on('submit', function (e) {
        e.preventDefault();
        var $form = jQuery(this);
        var url = $form.attr('action');
        var type = $form.attr('data-type');
        var q = $form.find('.search_divfield').val();
        jQuery.ajax({
            type: "GET",
            dataType: "text",
            data: $form.serialize(),
            url: url,
            cache: false,
            success: function (response) {
                if(response != '' && response !='ERROR'){
                    jQuery('#' + type + '-questions-listing').html(response);
                }
            }
        });

    });
});
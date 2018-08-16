// JS for TAGS Start
$(document).ready(function(){
  var baseUrl   = $('#baseUrl').val();
  $("#tags").select2({
      tags: true,
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
                  results: $.map(data, function (item) {
                      return {
                          text: item.name,
                          id: item.name
                      };
                  })
              };
          }
      }
  });
});//End of Document Ready

// JS for TAGS End

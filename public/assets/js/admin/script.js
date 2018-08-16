/**
 * The js for user table
 */
$(document).ready(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'usersdata',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'full_name', name: 'name', searchable: false },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ],
        "drawCallback": function( settings ) {
          updateTableUI("users");
        }
    });

    /**
     * The js for tags table
     */
     $('#tags-table').DataTable({
        processing: true,
        serverSide: true,
        ajax      : 'tagsdata',
        columns   : [
            { data: 'name', name: 'name', searchable: true },
            { data: 'created_at', name: 'created_at', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ],
        "drawCallback": function( settings ) {
          updateTableUI("tags");
        }
    });

    /**
     * The js for expertise table
     */
    $('#expertise-table').DataTable({
        processing: true,
        serverSide: true,
        ajax      : 'expertisedata',
        columns   : [
            { data: 'title', name: 'title', searchable: true },
            { data: 'full_name', name: 'full_name', searchable: false },
            { data: 'email', name: 'email', searchable: true },
            { data: 'tags_list', name: 'tags_list', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ],
        "drawCallback": function( settings ) {
            updateTableUI("expertise");
        }
    });

  /**
   * The js for charity table
   */
   $('#charity-table').DataTable({
      processing: true,
      serverSide: true,
      ajax      : 'charitydata',
      columns   : [
          { data: 'username', name: 'username', searchable: true},
          { data: 'email', name: 'email', searchable: true},
          { data: 'name', name: 'name', searchable: true },
          { data: 'url', name: 'url', searchable: true },
          { data: 'action', name: 'action', searchable: false },
      ],
      "drawCallback": function( settings ) {
        updateTableUI("charity");
      }
  });

  // for changing Tags visibility
  $(document).on( "click", ".toggle-tag-visibility", function(e) {
    e.preventDefault();
    toggleTagVisibility( $(this) );
  });

    // for changing Expertise featured
    $(document).on( "click", ".toggle-expertise-featured", function() {
        toggleExpertiseFeatured( $(this) );
    });

    // for changing Charity visibility
    $(document).on( "click", ".toggle-charity-visibility", function(e) {
       e.preventDefault();
      var cname = $(this).data('charityname');
      if(cname.length === 0){
        swal("Error!", "Please add the name to activate.", "error");
         return false;
       } else {
          toggleCharityVisibility( $(this) );
       }
  });

    //sweetalert for approve expert

    $('#approve').click(function(e){
      e.preventDefault();
      var linkURL = $(this).attr("href");      
      confirmExpertApproval(linkURL);
    });

    //For WYSIWYG editor (TinyMCE)

    tinymce.init({
      selector: '#wysiwyg-editor'
    });

    //

    $('#page-title').change(function(){
      var pageId  = $(this).val(),
          baseUrl = $('#baseUrl').val(); 
      if(pageId>0){
      location.href = baseUrl + '/admin/review/pages/' + pageId;
      }
      else{
        swal('Error', 'Please select a Page Title to Add content', "error");
        return false;
      }
    });

    //

    $('#email-subject').change(function(){
      var emailId  = $(this).val(),
          baseUrl = $('#baseUrl').val();       
      location.href = baseUrl + '/admin/review/email/' + emailId;      
    });
  
  //

    $('#add-photo').change(function(){
      var albumId  = $(this).val(),
          baseUrl = $('#baseUrl').val();       
      location.href = baseUrl + '/admin/addphoto/' + albumId;      
    });


}); //END DOCUMENT READY

//==============================================================================

  function confirmExpertApproval(linkURL){
    swal({
      title: "Are you sure you want to make this User an Expert?",
      text: "OK",
      type: "warning",
      showCancelButton : true
    }, function(){
      window.location.href = linkURL;
    });
  }



//==============================================================================

  function toggleTagVisibility(_self) {
    var data         = {};
    data.visibility  = _self.attr('data-visibility');
    data.id          = _self.attr('data-tagid');
    data.urlChunk    = "/admin/toggleTagVisibility";
    data.moduleName  = "Tag";
    updateVisibility(data, _self);
  }

//==============================================================================

function toggleExpertiseFeatured(_self) {
    var data         = {};
    data.is_featured  = _self.attr('data-featured');
    data.id          = _self.attr('data-expertiseid');
    data.urlChunk    = "/admin/toggleExpertiseFeatured";
    data.moduleName  = "Expertise";
    updateIsFeatured(data, _self);
}

//==============================================================================

  function toggleCharityVisibility(_self) {
     var data         = {};
     data.visibility  = _self.attr('data-visibility');
     data.id          = _self.attr('data-charityid');
     data.urlChunk    = "/admin/alterCharityVisibility";
     data.moduleName  = "Charity";
     updateVisibility(data, _self);
  }

//==============================================================================

  function updateVisibility(data, element) {
    var baseUrl     = $('#baseUrl').val(),
        visibility  = data.visibility,
        id          = data.id;
        moduleName  = data.moduleName;
      $.ajax({
        type: "GET",
        url : baseUrl + data.urlChunk,
        data: {
           id          : id,
           visibility  : visibility
        },
        beforeSend: function( ) {
        },
        success : function(data){
          if(data == 1) {
            var setVisibility = 0, setText  = 'activate', setToastMsg = 'deactivated';
            if ( visibility == 0 ) {
                setVisibility = 1;
                setText     = 'deactivate';
                setToastMsg = 'activated';
            }

              element.attr('data-visibility', setVisibility).text(setText);
              toastClear();
              toastSuccess(moduleName + " " + setToastMsg);
          }
        }
      });
  }

//==============================================================================

function updateIsFeatured(data, element) {
    var baseUrl     = $('#baseUrl').val(),
        is_featured  = data.is_featured,
        id          = data.id;
    moduleName  = data.moduleName;
    $.ajax({
        type: "GET",
        url : baseUrl + data.urlChunk,
        data: {
            id          : id,
            is_featured  : is_featured
        },
        beforeSend: function( ) {
        },
        success : function(data){
            if(data == 1) {
                var setFeatured = 0, setText  = 'General', setToastMsg = 'General';
                if ( is_featured == 0 ) {
                    setFeatured = 1;
                    setText     = 'Featured';
                    setToastMsg = 'Featured';
                }
                element.attr('data-featured', setFeatured).text(setText);
                toastClear();
                toastSuccess(moduleName + " " + setToastMsg);
            }
        }
    });
}

//==============================================================================

function updateTableUI(moduleName) {
  var selectElement = $('select[name="'+ moduleName +'-table_length"]');
  if (! selectElement.hasClass('browser-default')) {
    selectElement.addClass('browser-default').wrap('<div class="input-field col m2"></div>');
    $('input[class="select-dropdown"], span[class="caret"]').remove();
    $('#' + moduleName +'-table_filter').addClass('right col m5');
    $('#' + moduleName +'-table_length').addClass('left col m6');
  }
}
$(document).ready(function() {

  toastr.options = {
    "closeButton"    : false,
    "debug"          : false,
    "progressBar"    : true,
    "positionClass"  : "toast-top-right",
    "onclick"        : null,
    "showDuration"   : "400",
    "hideDuration"   : "1000",
    "timeOut"        : "7000",
    "extendedTimeOut": "1000",
    "showEasing"     : "swing",
    "hideEasing"     : "linear",
    "showMethod"     : "fadeIn",
    "hideMethod"     : "fadeOut"
  };

  toastSuccess = function (body, head) {
    head  = (typeof head == 'undefined') ? '': head;
    if ((typeof body == 'undefined')) {
      return false;
    }
    toastr.success(body, head);
  };

  toastError = function (body, head) {
    head  = (typeof head == 'undefined') ? '': head;
    if ((typeof body == 'undefined')) {
      return false;
    }
    toastr.error(body, head);
  };

  toastInfo = function (body, head) {
    head  = (typeof head == 'undefined') ? '': head;
    if ((typeof body == 'undefined')) {
      return false;
    }
    toastr.info(body, head);
  };

  toastWarning = function (body, head) {
    head  = (typeof head == 'undefined') ? '': head;
    if ((typeof body == 'undefined')) {
      return false;
    }
    toastr.warning(body, head);
  };

  toastClear  = function () {
    toastr.clear();
  }

});

(function () {
  "use strict";
  
  // http -> https
  if (location.protocol !== "https:") {
    location.href = "https:" + location.href.substring(location.protocol.length);
  }
  
  // bars icon change
  $("#navbar-collapse").on("show.bs.collapse", function() {
    $("#navbar-toggler-icon").fadeOut(400, function() {
      $(this).removeClass("fa-bars").addClass("fa-times").fadeIn(400);
    });
  });
  
  $("#navbar-collapse").on("hide.bs.collapse", function() {
    $("#navbar-toggler-icon").fadeOut(400, function() {
      $(this).removeClass("fa-times").addClass("fa-bars").fadeIn(400);
    });
  });
  
  // Google Map
  var map = null;
  var myMarker;
  var myLatlng;
  
  function initializeGMap(lat, lng) {
    myLatlng = new google.maps.LatLng(lat, lng);
    
    var myOptions = {
      zoom: 14,
      zoomControl: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
    
    myMarker = new google.maps.Marker({
      position: myLatlng
    });
    
    myMarker.setMap(map);
    
    google.maps.event.trigger(map, "resize");
    
    map.setCenter(myLatlng);
  }
  
  // modal show
  $(".contact-btn").on("click", function (e) {
    e.preventDefault();
    $("#contact-form-modal").load("/modals/contact_form.php", function (result) {
      //console.log(result);
      var contactFormModal = new bootstrap.Modal(document.getElementById("contact-form-modal"), { backdrop: "static", keyboard: false });
      contactFormModal.show();
    });
  });
  
  // modal event
  $("#contact-form-modal").on("shown.bs.modal", function (e) {
    $("#contact-form :input[name='content']").focus();
    initializeGMap(37.7445334, 127.0958024);
    $("#we-do-best-1").fadeIn(1500, function () {
      $("#we-do-best-2").fadeIn(1500, function () {
        //$("#contact-form :input[name='content']").focus();
        //initializeGMap(37.5768012, 127.0701669);
      });
    });
  }).on("hidden.bs.modal", function (e) {
    $("#contact-form-modal").empty();
  }).on("hidePrevented.bs.modal", function (e) {
    e.preventDefault();
  });
  
})();

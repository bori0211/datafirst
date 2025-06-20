<?
	$defaultDate = date("Y-m-d");
	$toTimeZone = 540;
?>

<html>
  <head>
    <link rel="icon" href="/img/favicon-16x16.png" sizes="16x16">
    <link rel="stylesheet" href="/bower/fullcalendar/dist/fullcalendar.min.css">
    <script src="/bower/jquery/dist/jquery.min.js"></script>
  </head>
  <body>
    
    <div id="test-calendar" data-default-date="<?= $defaultDate ?>" data-params='{"toTimeZone":"<?= $toTimeZone ?>"}'></div>
    
    <script src="/bower/moment/min/moment.min.js"></script>
    <script src="/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="/bower/fullcalendar/dist/locale-all.js"></script>
    
<script>
(function() {
	var m = $.fullCalendar.moment('2014-01-22T05:00:00-07:00');
	//m.stripZone();
	console.log(m.format());

  
  // Full-Calendar
  if ($("#test-calendar").length > 0) {
    // FULL CALENDAR
    $("#test-calendar").fullCalendar({
      header: {
        left: "prev,next",
        center: "title",
        right: ""
      },
      timezone:"local",
      allDay: true,
      defaultDate: $("#test-calendar").data("default-date"),
      fixedWeekCount: false,
      height: "auto",
      timeFormat: "HH:mm",
      eventSources: [
        {
          url: "./index_fc_event.php",
          data: $("#test-calendar").data("params")
        }
      ],
      eventRender: function(event, element, view) {
        var title = element.find(".fc-title, .fc-list-item-title");
        title.html(title.text());
      },
      /*
      eventClick: function(event, element, view) {
        $("#match-modal").data("params").matchId = event.matchId;
        $("#match-modal").load("/modals/match.php", $("#match-modal").data("params"), function(response) {
          $("#match-modal").modal({backdrop: "static", keyboard: false});
        });
        return false;
      },*/
      selectable: false,
      editable: false,
      droppable: false
    });
    
  }
})();

</script>
    
  </body>
</html>
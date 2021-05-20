<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Golfplatz reservieren</title>
    <link rel="stylesheet" href="../../fullcalender.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        var t = false;

        function IsDateHasEvent(date) {
            var allEvents = [];
            allEvents = $('#calendar').fullCalendar('clientEvents');
            var event = $.grep(allEvents, function(v) {
                return +v.start === +date;
            });
            return event.length > 0;
        }
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                eventStartEditable: false,
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: 'reverse_golfcourt_load.php',
                selectable: true,
                selectHelper: true,
                dayClick: function(date, allDay, jsEvent, view) {
                    // t = IsDateHasEvent(date);
                },
                select: function(start, end, allDay) {
                    // if (t) return;
                    var title = prompt("Geben Sie ihren Club-Namen ein & den Golfplatz-Namen.");
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    if (title) {
                        $.ajax({
                            url: "reverse_golfcourt_insert.php",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                            },
                            success: function() {
                                alert("Erfolgreich reserviert.");
                                calendar.fullCalendar('refetchEvents');
                            }
                        })
                    }
                },
                editable: true,
                eventClick: function(event) {
                    if (confirm("Möchtest du die Reservierung wirklich löschen?")) {
                        var court_id = event.court_id;

                        $.ajax({
                            url: "reverse_golfcourt_check.php",
                            type: "POST",
                            data: {
                                court_id: court_id
                            },
                            error: function(jqXHR, exception) {
                                alert("Du hast keine Berechtigung, diese Reservierung zu löschen, da sie nicht von dir erstellt wurde.");
                            },
                            success: function() {
                                $.ajax({
                                    url: "reverse_golfcourt_delete.php",
                                    type: "POST",
                                    data: {
                                        court_id: court_id
                                    },
                                    success: function() {
                                        calendar.fullCalendar('refetchEvents');
                                        alert("Reservierung entfernt");
                                    }
                                })
                            }
                        })
                    }
                },
            });
        });
    </script>
</head>

<body>
    <form action="../../index.php" class="backform">
        <input type="submit" name="submit" value="Zurück">
    </form>
    <br />
    <h2 align="center">Golfplatz reservieren</h2>
    <br />
    <div class="container">
        <div id="calendar"></div>
    </div>
</body>

</html>
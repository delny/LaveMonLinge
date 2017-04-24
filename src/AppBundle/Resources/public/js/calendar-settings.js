$(function () {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar-holder').fullCalendar({
        defaultView: 'agendaWeek',
        views: {
            agendaWeek: {
                minTime: 8,
                maxTime: 19
            },
            agendaDay: {
                minTime: 6,
                maxTime: 23
            }
        },
        minTime:8,
        maxTime:20,
        eventSources: [
            {
                url: Routing.generate('fullcalendar_loader'),
                type: 'POST',
                // A way to add custom filters to your event listeners
                data: {
                },
                error: function() {
                    //alert('There was an error while fetching Google Calendar!');
                }
            }
        ],
        eventRender: function(event, element) {
            element.find('.fc-event-content').append("<div>" + event.name + "</div>");
        }
    });
});

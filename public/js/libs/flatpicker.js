flatpickr("input[type='time']", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    defaultDate: "10:00",
    minTime: "10:00",
    maxTime: "22:00",
});

flatpickr("input[type='date']", {
    dateFormat: "d.m.Y",
    defaultDate: "today",
    minDate: "today",
    maxDate: new Date().fp_incr(31)
});

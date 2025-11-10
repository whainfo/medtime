document.addEventListener("DOMContentLoaded", function () {
    const doctor_booking_calendars = document.querySelectorAll('.doctor-booking-calendar');

    doctor_booking_calendars.forEach((db_calendar) => {
const daysOfWeekDisabled = document.querySelectorAll('.doctor-booking-calendar');
        const today = new Date();
        const maxDate = new Date();
        maxDate.setDate(today.getDate() + 14);
        const datepicker = new Datepicker(db_calendar, {
            inline: true,
            minDate: today,
            format: 'dd/mm/yyyy',
            language: 'uk',
            datepicker: true,
            maxDate: maxDate,
            weekStart: 1,
            daysOfWeekDisabled:vitamedGlobalVars.daysOfWeekDisabled,
            todayHighlight: true,
        });


        db_calendar.addEventListener('changeDate', function (e) {


            let el = db_calendar.closest('.doctor-booking-form');
            if (el) {
                el.querySelector('.booking-date').value = datepicker.getDate('yyyy-mm-dd');
            }

        });


    });
});
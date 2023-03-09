require('./bootstrap');

import Alpine from 'alpinejs';
import Datepicker from 'flowbite-datepicker/Datepicker';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';
import 'flowbite-datepicker';
import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

const datepickerEl = document.getElementById('date-picker');
new Datepicker(datepickerEl, {
    // options
});

const dateRangePickerEl = document.getElementById('daterange-picker');
new DateRangePicker(dateRangePickerEl, {
    // options
}); 

import Datepicker from 'flowbite-datepicker/Datepicker';
import DatepickerLocalePt from 'flowbite-datepicker/locales/pt';

Object.assign(Datepicker.locales, DatepickerLocalePt);

const setDatePicker = (el, options = {}) => {
    new Datepicker(el, options);
};

document.addEventListener('DOMContentLoaded', () => {
    const datePickerSelector = '[data-toggle="datepicker"]';

    let datePickers = document.querySelectorAll(datePickerSelector);

    datePickers.forEach(datePickerElement => {
        let options = {
            autohide: datePickerElement.getAttribute('datepicker-autohide') || true,
            format: datePickerElement.getAttribute('datepicker-format') || 'yyyy-mm-dd',
            minDate: datePickerElement.getAttribute('datepicker-min-date'),
            maxDate: datePickerElement.getAttribute('datepicker-max-date'),
            orientation: datePickerElement.getAttribute('datepicker-orientation') || 'bottom left',
            title: datePickerElement.getAttribute('datepicker-title'),
            language: datePickerElement.getAttribute('datepicker-language') || document.documentElement.lang,
        };

        setDatePicker(datePickerElement, options);
    });

    const observer = new MutationObserver(function (mutationsList) {
        const refreshedDatePickers = document.querySelectorAll(datePickerSelector);

        const newDatePickers = Array.from(refreshedDatePickers).filter(datePicker => !Array.from(datePickers).includes(datePicker));

        newDatePickers.forEach(datePickerElement => setDatePicker(datePickerElement));

        datePickers = refreshedDatePickers;
    });

    // Start observing the document, including its descendants
    observer.observe(document.body, { childList: true, subtree: true });
});


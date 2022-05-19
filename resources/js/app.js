require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

import LocationAPI from "./api/LoactonAPI";
import WeatherAPI from "./api/WeatherAPi";
import FControl from "./FControl";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    const $selects = {
        'countries': $('#country'),
        'states': $('#state'),
        'cities': $('#city')
    };
    const $temperature = $('#temperature')

    const locationDataPrepare = (res) => {
        const type = Object.keys(res.data)[0];
        switch (type) {
            case 'location':
                getTemperature(res.data[type]);
                break;
            default:
                FControl.appendSelectOptions($selects[type], res.data[type]);
                FControl.show($selects[type]);
        }
    }

    const getTemperature = (data) => {
        WeatherAPI.getTemperature(data, (res) => {
            $temperature.html(res['temperature'] || 0);
            FControl.show($temperature);
        });
    }

    // Event binding
    $selects['countries'].change(e => LocationAPI.getCountryLocationData(e.target.value, locationDataPrepare));
    $selects['states'].change(e => LocationAPI.getStateLocationData(e.target.value, locationDataPrepare));
    $selects['cities'].change(e => getTemperature($(e.target).find(':selected').data('location')));
    $('select').change(e => $(e.target).parent('div').nextAll().hide());
});


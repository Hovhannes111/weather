require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

import LocationAPI from "./api/LoactonAPI";
import WeatherAPI from "./api/WeatherAPi";
import Select from "./Select";


$(document).ready(function() {

    const $countrySelect = $('#country');
    const $stateSelect = $('#state');
    const $citySelect = $('#city');

    LocationAPI.getCountries((res) => {
        Select.appendOptions($countrySelect, res.data)
    });

    function initData (data, $el) {
        if (data.length) {
            Select.show($el)
            Select.appendOptions($el, data)
        } else {
            Select.hide($el)
            return false;
        }
    }

    function countrySelectProcessing () {
        LocationAPI.getStates(this.value,(res) => {
            if(!initData(res.data, $stateSelect)) {
                LocationAPI.getStateCities(this.value, (res) => {
                    if(!initData(res.data, $citySelect)) {

                    }
                })
            }
        })
    }

    function stateSelectProcessing () {
        LocationAPI.getStateCities(this.value, res => {
            if (res.data.length) {
                Select.show($citySelect)
                Select.appendOptions($citySelect, res.data)
            } else {
                Select.hide($citySelect)
                LocationAPI.getStateCities(this.value, (res) => {
                    Select.appendOptions($citySelect, res.data)
                })
            }
        })
    }

    // Event binding
    $countrySelect.change(countrySelectProcessing)
    $stateSelect.change(stateSelectProcessing)
});


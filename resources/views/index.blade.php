@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h2>Weather</h2>
        <div>
            <p>Choose a country:</p>
            <select name="country" id="country" class="form-select mt-3">
                <option value="" data-id="0">Please select your country</option>
                @foreach($countries as $country)
                    <option 
                        value="{{ $country->name }}"
                        data-id={{ $country->id }}
                        data-lat={{ $country->latitude }}
                        data-lon={{ $country->longitude }}
                    >{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div  id="state-section" class="mt-3 d-none">
            <p>Choose a state:</p>
            <select name="state" id="state" class="form-select mt-3"></select>
        </div>
        
        <div id="city-section" class="mt-3 d-none">
            <p>Choose a city:</p>
            <select name="city" id="city" class="form-select mt-3"></select>
        </div>
        <button id="submit" type="button" class="mt-3 btn btn-success d-none">Find out the weather in the selected city</button>
    </div>

    <script>
        $("#country").on('change', function() {
            if($('.button:not(d-none)')) {
                $("button").addClass("d-none")
            }
            let selectedCountry = +$(this).find(":selected").attr("data-id")
            if(selectedCountry) {
                $.ajax({
                    type:'GET',
                    url:'/getStatesByCountry/'+selectedCountry,
                    success:function(res) {
                        if(res.length !== 0){
                            if($('.button:not(d-none)')) {
                                $("button").addClass("d-none")
                            }
                            $("#state-section").removeClass("d-none")
                            let html = '<option value="0" data-id="0">Please select your state</option>'
                            for (let i = 0; i < res.length; i++) {
                                let value = res[i]
                                html += `<option 
                                            value=${value.name}
                                            data-id=${value.id}
                                            data-lat=${value.latitude}
                                            data-lon=${value.longitude}
                                        >${value.name}</option>`
                            }
                            $('#state').append(html)
                        } else {
                            $("#state-section").addClass("d-none")
                            $("button").removeClass("d-none")
                        }
                    }
                })
            } else {
                $("#state-section").addClass("d-none")
            }
            $("#city-section").addClass("d-none")
            $('#city').find('option').remove().end()
            $('#state').find('option').remove().end()
        })

        $("#state").on('change', function() {
            let selectedState = +$('#state').find(":selected").attr("data-id")
            if(selectedState !== 0) {
                $.ajax({
                    type:'GET',
                    url:'/getCitiesByState/'+selectedState,
                    success:function(res) {
                        if(res.length !== 0){
                            if($('.button:not(d-none)')) {
                                $("button").addClass("d-none")
                            }
                            $("#city-section").removeClass("d-none")
                            let html = '<option value="0" data-id="0">Please select your ciry</option>'
                            for (let j = 0; j < res.length; j++) {
                                let value = res[j]
                                html += `<option 
                                            value=${value.name}
                                            data-id=${value.id}
                                            data-lat=${value.latitude}
                                            data-lon=${value.longitude}    
                                        >${value.name}</option>`
                            }
                            $('#city').append(html)
                            $("#city").on('change', function() {
                                if(+$('#city').find(":selected").attr("data-id") !== 0) {
                                    $("button").removeClass("d-none")
                                } else {
                                    if($('.button:not(d-none)')) {
                                        $("button").addClass("d-none")
                                    }
                                }
                            })
                        } else {
                            $("#city-section").addClass("d-none")
                            $("button").removeClass("d-none")
                        }
                    }
                })
            } else {
                $("#city-section").addClass("d-none")
            }
            $('#city').find('option').remove().end()
        })

        $("#submit").click(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let data = new Object()
            let elem
            if($('#city').find('option').length){
                elem = $('#city')
                data.city_id = elem.find(":selected").attr("data-id")
                data.state_id = $('#state').find(":selected").attr("data-id")
                data.country_id = $('#country').find(":selected").attr("data-id")
            } else if(!$('#city').find('option').length && $('#state').find('option').length) {
                elem = $('#state')
                data.state_id = elem.find(":selected").attr("data-id")
                data.country_id = $('#country').find(":selected").attr("data-id")
            } else {
                elem = $('#country')
                data.country_id = elem.find(":selected").attr("data-id")
            }
            data.latitude = elem.find(":selected").attr("data-lat")
            data.longitude = elem.find(":selected").attr("data-lon")
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:"/getWeather",
                data,
                success:function(data){
                    $('.weather').remove()
                    $('.container').append(`<h1 class="weather mt-3">${data} °C</h1>`)
                }
            });
        })
    </script>
@endsection
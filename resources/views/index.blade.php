@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h2>Weather</h2>
        <div>
            <p>Choose a country:</p>
            <select name="country" id="country" class="form-select mt-3">
                <option value="" data-id="0">Please select your country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->name }}" data-id={{ $country->id }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="city-section" class="mt-3 d-none">
            <p>Choose a city:</p>
            <select name="city" id="city" class="form-select mt-3"></select>
        </div>
        <button id="submit" type="button" class="mt-3 btn btn-success d-none">Find out the weather in the selected city</button>
    </div>

    <script>
        $("#country").on('change', function() {
            let selectedCountry = +$(this).find(":selected").attr("data-id")
            if(selectedCountry) {
                $.ajax({
                    type:'GET',
                    url:'/getCitiesByCountry/'+selectedCountry,
                    success:function(res) {
                        if(res.length !== 0){
                            $("#city-section").removeClass("d-none")
                            let html = '<option value="0" data-id="0">Please select your country</option>'
                            for (var i = 0; i < res.length; i++) {
                                let value = res[i]
                                html += `<option value=${value.name} data-id=${value.id}>${value.name}</option>`
                            }
                            $('#city').append(html)
                            $("#city").on('change', function() {
                                if($('#city').find(":selected").attr("data-id") !== 0) {
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
                $("button").addClass("d-none")
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
            if($('#city').find('option').value){
                data.cityId = $('#city').find(":selected").attr("data-id")
            } else {
                data.countryId = $('#country').find(":selected").attr("data-id") 
            }
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:"/getWeather",
                data,
                success:function(data){
                    $('.container').append(`<h1 class="mt-3">${data} °C</h1>`)
                }
            });
        })
    </script>
@endsection
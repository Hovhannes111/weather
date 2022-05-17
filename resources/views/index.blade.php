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
@endsection
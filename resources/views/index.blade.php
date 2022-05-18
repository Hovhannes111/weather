@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 py-5">
                <h2>Weather</h2>
                <div class="mt-3">
                    <label>Country:</label>
                    <select name="country" id="country" class="form-select"></select>
                </div>
                <div class="mt-3">
                    <label>State:</label>
                    <select name="state" id="state" class="form-select"></select>
                </div>
                <div class="mt-3">
                    <label>City:</label>
                    <select name="city" id="city" class="form-select"></select>
                </div>
                <div class="mt-3">
                    <button id="submit" type="button" class="btn btn-success">Find out the weather in the selected city</button>
                </div>
            </div>
        </div>
    </div>
@endsection

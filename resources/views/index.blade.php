@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 py-5">
                <h2>Weather</h2>
                <div class="mt-3">
                    <label>Country:</label>
                    <select name="country" id="country" class="form-select">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" data-location="{{ $country->location }}"> {{ $country->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3" style="display: none;">
                    <label>State:</label>
                    <select name="state" id="state" class="form-select"></select>
                </div>
                <div class="mt-3" style="display: none;">
                    <label>City:</label>
                    <select name="city" id="city" class="form-select"></select>
                </div>
                <div class="mt-3 p-3 border rounded-2 h-25" style="display: none;">
                    <b id="temperature"></b>
                    <span>℃</span>
                </div>
            </div>
        </div>
    </div>
@endsection

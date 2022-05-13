@extends('layouts.app')
@section('content')
    <div class="block">
        <label for="country">Choose a country:</label>

        <select name="country" id="country">
            <option value="0" data-id="0">Please select data</option>
            @foreach($countries as $country)
                <option value="{{ $country->name }}" data-id={{ $country->id }}>{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    <script>
        let selectedValue = document.getElementById("country")
        selectedValue.addEventListener('change', function() {
            let selectedCountry = this.options[selectedValue.selectedIndex].dataset.id
            // if(selectedCountry) {

            // }
        })
    </script>
@endsection
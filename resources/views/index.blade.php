@extends('layouts.app')
@section('content')
    {{-- <label for="country">Choose a country:</label>

    <select name="country" id="country">
        @foreach($countries as $country)
            <option value="{{ $country->name }}" data-id={{ $country->id }}>{{ $country->name }}</option>
        @endforeach
    </select> --}}
    <!-- Button trigger modal -->
{{-- <script>
    let selectedValue = document.getElementById("country")
    let selectedDataId = selectedValue.options[selectedValue.selectedIndex].dataset.id;

 </script> --}}
@endsection
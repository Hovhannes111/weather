<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <label for="country">Choose a country:</label>

        <select name="country" id="country">
            @foreach($countries as $country)
                <option value="{{ $country->name }}" data-id={{ $country->id }}>{{ $country->name }}</option>
            @endforeach
        </select>
    </body>
    <script>
        let selectedData = document.getElementById("country")
        console.log(selectedData, 'selectedData')
    </script>
</html>

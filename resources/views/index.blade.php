<html>
    <head>
        <title>XLR8 - Search Hotels</title>
    </head>

    <body>
        <form action="/search" method="POST">
            @csrf

            <div>
                <label for="latitude">Latitude</label>
                <input id="latitude" maxlength="21" name="latitude" type="text"
                    value="{{ old('latitude') }}" required>
            </div>

            <div style="margin-top: 5px">
                <label for="longitude">Longitude</label>
                <input id="longitude" maxlength="21" name="longitude"
                    value="{{ old('longitude') }}" type="text" required>
            </div>

            <div style="margin-top: 5px">
                <label for="order_by">Order by</label>
                <select name="order_by">
                    <option value="proximity"
                        @selected(old('order_by') == 'proximity')
                    >Proximity</option>
                    <option value="price_per_night"
                        @selected(old('order_by') == 'price_per_night')
                    >Price per night</option>
                <select>
            </div>

            <input style="margin-top: 5px" type="submit" value="Search">
        </form>

        @if (session()->has('hotels'))
            <ul>
                @foreach (session('hotels') as $hotel)
                    <li>
                        {{ $hotel->name }},
                        {{ $hotel->proximity != 'Without' ? round($hotel->proximity, 2) : 'tt' }} km,
                        {{ $hotel->price_per_night }} EUR
                    </li>
                @endforeach
            </ul>
        @endisset
    </body>
</html>

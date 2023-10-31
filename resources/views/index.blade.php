<html>
    <head>
        <title>XLR8 - Search Hotels</title>
    </head>

    <body>
        <form action="/" method="POST">
            @csrf

            <div>
                <label for="latitude">Latitude</label>
                <input id="latitude" maxlength="21" name="latitude" type="text" required>
            </div>

            <div style="margin-top: 5px">
                <label for="longitude">Longitude</label>
                <input id="longitude" maxlength="21" name="longitude" type="text" required>
            </div>

            <div style="margin-top: 5px">
                <label for="order_by">Order by</label>
                <select name="order_by">
                    <option value="proximity">Proximity</option>
                    <option value="pricepernight">Price per night</option>
                <select>
            </div>

            <input style="margin-top: 5px" type="submit" value="Search">
        </form>
    </body>
</html>

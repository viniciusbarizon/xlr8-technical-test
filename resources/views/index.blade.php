<html>
    <head>
        <title>XLR8 - Search Hotels</title>
    </head>

    <body>
        <form action="/" method="POST">
            @csrf

            <div>
                <label for="latitude">Latitude</label>
                <input id="latitude" maxlength="12" name="latitude" type="text" required>
            </div>

            <div style="margin-top: 5px">
                <label for="longitude">Longitude</label>
                <input id="longitude" maxlength="12" name="longitude" type="text" required>
            </div>

            <input style="margin-top: 5px" type="submit" value="Search">
        </form>
    </body>
</html>

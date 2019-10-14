<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clearance</title>

    <style>
    div.container{
        margin: 0 auto;
        max-width: 800px;
        padding-left: 10px;
        padding-right: 10px;
        border: 3px solid grey;
    }
    #hpglogo{
        width: 100px;
        height: 120px;
    }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://pnp-automation-bucket.s3-ap-southeast-1.amazonaws.com/media/pnp.png" id="hpglogo">
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) }} ">
    </div>
</body>
</html>
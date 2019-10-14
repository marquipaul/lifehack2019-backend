<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MVCC_Online_Application</title>
</head>

<style>
    div.container{
        margin: 0 auto;
        max-width: 1200px;
        padding-left: 10px;
        padding-right: 10px;
    }
    div.content{
        margin: 0 auto;
        max-width: 595px;
        padding-left: 10px;
        padding-right: 10px;
        border: 2px solid black;
        border-radius: 6px;
        padding-bottom: 30px;
    }

    th.headerClass{
        width: 250px;
        height: 250px;
        padding: 10px;
        text-align: left;
    }
    img.headerQR{
        width: 150px;
        height: 150px;
    }
    
    table{
        border-collapse: collapse;
    }
    p.name{
        font-size: 16px;
        font-weight: bold;
        padding: 0px;
        margin: 0px;
    }
    p.subcontent{
        font-size: 14px;
        font-weight: bold;
        padding: 0 px;
    }


</style>
<body>
    
    <div class="container">
        <div class="content">
            <table>
                <colgroup width="30%"></colgroup>
                <colgroup width="70%"></colgroup>

                <thead>
                    <th class="headerClass">
                    <!-- <img class="headerQR" src="qr_code_PNG2.png"> -->
                    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(175)->generate($qr_code)) }} ">
                    </th>
                    <th class="headerClass">
                            <h3>MOTOR VEHICLE CLEARANCE CERTFICATE</h3>
                            <p class="name">{{$user['first_name']}} {{$user['last_name']}}</p>
                            <p class="subcontent">{{$vehicle['plate_number']}}</p>
                            <p class="subcontent">{{$vehicle['body_type']}} / {{$vehicle['make']}} / {{$vehicle['color']}}</p>
                            <p class="subcontent">{{$clearance['purpose']}}</p>
                    </th>
                </thead>
            </table>
        </div>
    </div>
</body>
</html>
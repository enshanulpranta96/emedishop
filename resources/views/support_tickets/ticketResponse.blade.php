<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Response</title>
</head>

<body>
    <div class="row justify-content-center align-items-center mt-5">
        <div class="col-md-8">
            <div style="text-align: center" style="width: 400px; border:1px solid black; border-radius: 8px">
                <h4>NEW TICKET REQUEST FROM {{$name}}, <br>EMAIL: {{$email}}.</h4>
                <hr>
                <h4>ISSUE TITLE: {{$title}}</h4>
                <h4>DEPARTMENT: {{$department}}</h4>
                <h4>PRIORITY: {{$priority}}</h4>
                <h6>NOTE: CHECK ADMIN DASHBOARD TO REPLAY</h6>
                <hr>
                <small class="text-muted text-center">EMAIL DIRECTLY SENT FROM  <a href="https://office.bobosoho.com/" style="text-decoration: none;">OFFICE BOBOSOHO (office.bobosoho.com)</a>, <br>AUTOMATED MESSAGE. PLEASE DO NOT REPLY.</small>
            </div>
        </div>
    </div>
</body>

</html>

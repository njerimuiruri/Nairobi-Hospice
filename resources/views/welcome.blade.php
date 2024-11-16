<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairobi Hospice | Welcome</title>
    <!-- Link to CSS file -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
</head>

<body>
    <div class="navigationBar">
        <a class="navigationItem" href="#">Log in</a>
    </div>
    <div class="mainContent">
        <div class="textContent">
            <h1 class="welcomeHeading">Nairobi Hospice Patient Management</h1>
            <hr class="horiLine">
            <p class="welcomeText">
                Providing Palliative Care Services to patients facing life-limiting illnesses.<br>
                This system allows staff to manage patients, including search, symptom/diagnosis management, and more.
            </p>
        </div>

        <div class="imageContent">
            <img src="{{ asset('images/LogoNairobiHospice.png') }}" alt="Patient Management Illustration">
        </div>
    </div>

</body>

</html>
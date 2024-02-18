<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
     <div class="message-container">
      <div class="flex">
        <div class="header flex">
            <div class="name-section">
                <span class="label">Last Name:</span> {{$Message["Last_name"]}}
            </div>
            <div class="name-section">
                <span class="label">First Name:</span> {{$Message["First_name"]}}
            </div>
        </div>
        <div>
          Date : {{$Message["created_at"]}}
        </div>
      </div>
        <div class="email-section">
            <span class="label">Email:</span> {{$Message["Email"]}}
        </div>
        <div class="message-section">
            <span class="label">Message:</span>
            <div class="message-content">{{$Message["Message"]}}</div>
        </div>
    </div>
</body>
</html>
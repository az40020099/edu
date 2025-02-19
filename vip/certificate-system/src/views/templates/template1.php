<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة التقدير</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            color: #333;
            background-color: #f9f9f9;
        }
        .certificate {
            border: 5px solid #4CAF50;
            padding: 20px;
            margin: 50px auto;
            width: 80%;
            background-color: #fff;
        }
        .certificate h1 {
            font-size: 2.5em;
            color: #4CAF50;
        }
        .certificate p {
            font-size: 1.5em;
        }
        .footer {
            margin-top: 30px;
            font-size: 1em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>شهادة التقدير</h1>
        <p>تُمنح هذه الشهادة لـ <strong>{{name}}</strong></p>
        <p>لإنجازاته المتميزة في <strong>{{course}}</strong></p>
        <div class="footer">
            <p>تاريخ الإصدار: <strong>{{date}}</strong></p>
        </div>
    </div>
</body>
</html>
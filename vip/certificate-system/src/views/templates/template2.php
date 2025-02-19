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
            background-color: #f4f4f4;
        }
        .certificate {
            border: 5px solid #000;
            padding: 20px;
            margin: 50px auto;
            width: 80%;
            background-color: #fff;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .name {
            font-size: 36px;
            font-weight: bold;
            color: #007BFF;
            margin: 20px 0;
        }
        .footer {
            font-size: 18px;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">شهادة التقدير</div>
        <div class="name">{{name}}</div>
        <div class="footer">تم منح هذه الشهادة في {{date}}</div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield("title")</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .body-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        .card {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            margin-top: 80px;
        }

        .profile-form .form-group {
            margin-bottom: 20px;
        }

        .profile-form label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #555;
            color: #f5f5f5;
        }

        .profile-form button {
            padding: 10px;
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .profile-form button:hover {
            background-color: #138496;
        }
    </style>
</head>

<body>
    <div class="body-content">
        <div class="card text-center">
            @yield("content")
        </div>
    </div>
</body>

</html>
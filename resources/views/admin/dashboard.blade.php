<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    @vite(['resources/css/app.css', 'resources/css/navbar.css', 'resources/js/app.js'])
    <style>
        #sidebar li{
            list-style-type: none;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            transition: 0.2s ease;
        }
        #sidebar li:hover{
            background-color: rgb(243 244 246);;
            opacity: 1;
            color: #000;
            font-size: 18px;
            font-weight: bold;
            border-radius: 20px 0 0 20px;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    @section('padding-x')
        px-[50px]
    @endsection

    <div id="container" class="flex">
        @include('layouts.sidebar_admin_dashboard')
        <div id="content" class="bg-gray-100 w-[85%] mt-[70px] ml-[15%] h-screen">
            <div class="analyst flex p-8 gap-10 justify-between">
                <div class="analyst-item user w-[250px] py-4 bg-white rounded-lg">
                    <p class="text-center text-orange-500">User Quantity</p>
                    <h1 class="text-center font-bold text-5xl">{{$userCount}}</h1>
                </div>
                <div class="analyst-item user w-[250px] py-4 bg-white rounded-lg">
                    <p class="text-center text-orange-500">Category Quantity</p>
                    <h1 class="text-center font-bold text-5xl">{{$categoryCount}}</h1>
                </div>
                <div class="analyst-item user w-[250px] py-4 bg-white rounded-lg">
                    <p class="text-center text-orange-500">Post Quantity</p>
                    <h1 class="text-center font-bold text-5xl">{{$postCount}}</h1>
                </div>
                <div class="analyst-item user w-[250px] py-4 bg-white rounded-lg">
                    <p class="text-center text-orange-500">Unaprroved Post Quantity</p>
                    <h1 class="text-center font-bold text-5xl">{{$unaprrovedCount}}</h1>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

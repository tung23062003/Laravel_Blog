<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add user</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
    <x-head.tinymce-config/>
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
            background-color: rgb(243 244 246);
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
        <div id="content" class="ml-[15%] bg-gray-100 w-[85%] mt-[70px] px-[50px] h-screen">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('message'))
                    <div class="alert alert-success text-red-600">
                        {{ session('message') }}
                    </div>
                @endif
                <label for="name">Name:</label><br>
                <input type="text" name="name" placeholder="Name" class="w-50"><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" placeholder="Email"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" placeholder="Password"><br>
                <label for="role">Role:</label><br>
                <select name="role" id="">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button class="bg-red-600 text-white text-sm px-5 py-2.5 mt-2 rounded-md hover:bg-sky-700">ADD</button>
            </form>
        </div>
    </div>
    
    <style>
        input, select{
            width: 100%;
        }
        .tag {
            margin: 10px 0;
        }
        .tag ul {
            display: flex;
            flex-wrap: wrap;
            padding: 7px;
            margin: 12px 0;
            border: 1px solid #a6a6a6;
        }

        .tag ul li {
            color: #333;
            margin: 4px 3px;
            list-style: none;
            border-radius: 5px;
            background: #F2F2F2;
            padding: 5px 8px 5px 10px;
            border: 1px solid #e3e1e1;
        }

        .tag ul li i {
            height: 20px;
            width: 20px;
            color: #808080;
            margin-left: 8px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 50%;
            background: #dfdfdf;
            justify-content: center;
        }

        .tag ul input {
            flex: 1;
            padding: 5px;
            border: none;
            outline: none;
            font-size: 16px;
            border: transparent;
        }
        .tag ul input:focus{
            border: transparent;
        }
        .tag ul input:focus-visible{
            box-shadow: var(--tw-ring-inset) 0 0 0 calc(0px + var(--tw-ring-offset-width)) var(--tw-ring-color); 
        }
        .details {
            justify-content: space-between;
        }
    </style>
</body>
</html>

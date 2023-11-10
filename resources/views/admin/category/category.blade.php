<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Category</title>
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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th,td{
            padding: 10px
        }
        th{
            background-color: #2143b2;
            color: #fff;
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
            <a class="bg-red-500 text-white rounded-sm p-1 ml-[70px]" href="{{route('category.create')}}">Add Category</a>
            <table class="text-center mx-auto mt-[30px]">
                <tr>
                    <th class="w-[50px]">STT</th>
                    <th class="w-[400px]">NAME</th>
                    <th class="w-[600px]">SLUG</th>
                    <th>Function</th>
                </tr>
                
                @isset($categories)
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td class="flex items-center">
                                <a class="bg-red-500 text-white rounded-sm p-1" href="{{route('category.edit', ['category' => $category])}}">Edit</a>
                                <form action="{{route('category.destroy', ['category' => $category])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="bg-red-500 text-white rounded-sm p-1 ml-1" >Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </table>
        </div>
    </div>
</body>
</html>
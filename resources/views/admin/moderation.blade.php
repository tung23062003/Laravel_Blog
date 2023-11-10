<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Moderation</title>
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
            border-bottom: 1px solid #ccc;
            border-collapse: collapse;
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
        <div id="content" class="ml-[15%] bg-gray-100 w-[85%] mt-[70px] h-screen">
            <table class="mt-[30px]">
                <tr>
                    <td class="w-[50px]">STT</td>
                    <td class="w-[400px]">IMAGE</td>
                    <td class="w-[600px]">TITTLE</td>
                    <td class="w-[600px]">SLUG</td>
                    <td class="w-[600px]">AUTHOR</td>
                    <td class="w-[600px]">CONTENT</td>
                    <td>Function</td>
                </tr>
                @isset($posts)
                    @foreach ($posts as $post)
                        <tr>
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td center>
                                <div class="article-img w-[70px] h-[70px]">
                                    <img src="{{URL::asset('/upload/' . $post->image)}}" class="w-full h-full object-cover" alt="">
                                </div>
                            </td>
                            <td>{{$post->tittle}}</td>
                            <td>{{$post->slug}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>
                                <p class="line-clamp-1"><?php
                                    $dom = new DOMDocument();
                                    $dom->loadHTML($post->content);
                                    $paragraphs = $dom->getElementsByTagName('p');
                                    
                                    $result = '';
                                    foreach ($paragraphs as $paragraph) {
                                        $result .= $dom->saveHTML($paragraph);
                                    }
                                    echo strip_tags($result) . '...';?></p> {{--   {!!$post->content!!}   --}}
                            </td>
                            <td class="flex">
                                <a class="bg-red-500 text-white rounded-sm p-1" href="{{route('admin.moderation.accept', ['post' => $post])}}">Accept</a>
                                <a class="bg-red-500 text-white rounded-sm p-1 ml-1" href="{{route('admin.moderation.reject', ['post' => $post])}}">Reject</a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </table>
        </div>
    </div>
</body>
</html>

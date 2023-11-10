<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <x-head.tinymce-config/>
    @vite(['resources/css/app.css', 'resources/css/navbar.css', 'resources/js/app.js'])
</head>

<body>
    @extends('layouts.navbar')
    @section('subnav')
        <div class="sub-navbar flex justify-center bg-zinc-900">
        <div><a href="/">Home</a></div>
        <div><a href="">Categories <i class="fa-solid fa-chevron-down text-xs" style="color: #fffff;"></a></i></div>
        <div><a href="{{route('post.index')}}">Blog</a></div>
        <div><a href="">About</a></div>
        <div><a href="">Contact</a></div>
        <div><a href="">Ahihi</a></div>
    </div>
    @endsection
    @section('icon-social')
        <div class="social-networking-icon">
            <i class="fa-brands fa-facebook-f" style="color: #000000;"></i>
            <i class="fa-brands fa-twitter" style="color: #000000;"></i>
            <i class="fa-brands fa-instagram" style="color: #000000;"></i>
            <i class="fa-brands fa-pinterest" style="color: #000000;"></i>
        </div>
    @endsection
    @section('padding-x')
        px-[250px]
    @endsection
    
    <div class="py-12 mt-20 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('message'))
                            <div class="alert alert-success text-red-600">
                                {{ session('message') }}
                            </div>
                        @endif
                        <label for="tittle">Tittle:</label><br>
                        <input type="text" name="tittle" placeholder="Tittle" class="w-50"><br>
                        <label for="slug">Slug:</label><br>
                        <input type="text" name="slug" placeholder="Slug"><br>
                        <label for="category">Category:</label><br>
                        <select name="category_id">
                            <option value="">Not belong to category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select><br>
                        <div class="tag">
                            <p>Tag:</p>
                            <ul class="tag-aria"><input type="text" id="input-tag" name="tag" spellcheck="false"></ul>
                        </div>
                        <div class="details">
                            <p><span>10</span> tags are remaining</p>
                        </div>
                        <label for="image">Image:</label><br>
                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg"
                            class="border-solid border-gray-500"><br>
                        <label for="content">Content:</label><br>
                        <textarea id="editor" name="content"></textarea>
                        <br>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button onclick="sendTagToValueInput()" class="bg-red-600 text-white text-sm px-5 py-2.5 mt-2 rounded-md hover:bg-sky-700">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
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
        #container {
            width: 1000px;
            margin: 20px auto;
        }
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <script>
        var ul = document.querySelector(".tag ul"),
            input = document.querySelector(".tag input"),
            tagNumb = document.querySelector(".details span");

        let maxTags = 10,
            tags = [];

        countTags();
        createTag();

        function countTags() {
            input.focus();
            tagNumb.innerText = maxTags - tags.length;
        }

        function createTag() {
            ul.querySelectorAll("li").forEach(li => li.remove());
            tags.slice().reverse().forEach(tag => {
                if(tag.includes(' ')){
                    var newTag = tag.replace(/ /g, '-')
                }else{
                    newTag = tag;
                }
                let liTag = `<li>${newTag} <i class="uit uit-multiply" onclick="remove(this, '${newTag}')"></i></li>`;
                ul.insertAdjacentHTML("afterbegin", liTag);
                input.classList.add(newTag);
            });
            countTags();
        }

        function remove(element, tag) {
            let index = tags.indexOf(tag);
            tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
            element.parentElement.remove();
            if(getTagName().includes(tag)){
                input.classList.remove(tag);
            }
            getTagName();
            countTags();
        }
        function getTagName(){
            // input = document.querySelector(".tag input");
            inputArr = input.getAttribute('class').split(' ');
            // console.log(inputArr);
            return inputArr;
        }
        function addTag(e) {
            if (e.key == "Enter") {
                let tag = e.target.value.replace(/\s+/g, '-');
                if (tag.length > 1 && !tags.includes(tag)) {
                    if (tags.length < 10) {
                        console.log(tag);
                        tag.split(',').forEach(tag => {
                            tags.push(tag);
                            createTag();
                        });
                    }
                }
                e.target.value = "";
            }
        }

        input.addEventListener("keyup", addTag);
        function sendTagToValueInput(){
            input.value = getTagName().join(' ');
        }

        // prevent submit form when generate tag
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        <div id="content" class="ml-[15%] bg-gray-100 w-[85%] mt-[70px] h-screen">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('message'))
                    <div class="alert alert-success text-red-600">
                        {{ session('message') }}
                    </div>
                @endif
                <label for="tittle">Tittle:</label><br>
                <input type="text" name="tittle" placeholder="Tittle" value="{{$post->tittle}}" class="w-50"><br>
                <label for="slug">Slug:</label><br>
                <input type="text" name="slug" placeholder="Slug" value="{{$post->slug}}"><br>
                <label for="category">Category:</label><br>
                <select name="category">
                    <option value="">Not belong to category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" <?php echo $selected = ($category->id == $post->category_id) ? 'selected' : null; ?>>{{ $category->name }}</option>
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
                {{-- <img src="{{URL::asset('/upload/' . $post->image)}}" class="w-[200px] h-150px object-cover" alt=""> --}}
                {{-- <p>If you want change image, click here</p> --}}
                <input type="file" name="image" accept="image/png, image/gif, image/jpeg"
                    class="border-solid border-gray-500"><br>
                <label for="content">Content:</label><br>
                <textarea name="content" id="editor" value="{{$post->content}}"></textarea>
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
                <button onclick="sendTagToValueInput()" class="bg-red-600 text-white text-sm px-5 py-2.5 mt-2 rounded-md hover:bg-sky-700">UPDATE</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/pc53qsxplo1je7n4uzqewgcvqdaq50pgy87vpwmrr2i2xysk/tinymce/6/tinymce.min.js"
        referrerpolicy="origin">
        
    </script>
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant"))
        });
        // var doc = new DOMParser().parseFromString({!! json_encode($post->content) !!}, "text/xml");
        // var parser = new DOMParser();
        // var doc = parser.parseFromString({!! json_encode($post->content) !!}, "text/html");
        // var paragraphs = doc.getElementsByTagName("p");
        // var extractedContent = "";
        // for (var i = 0; i < paragraphs.length; i++) {
        //     extractedContent += paragraphs[i].outerHTML;
        // }
        // document.getElementById("tinymce").innerHTML = extractedContent;
    </script>
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

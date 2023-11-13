<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$post->tittle}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />\
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></>
    @vite(['resources/css/app.css', 'resources/css/navbar.css', 'resources/js/app.js'])
    
</head>
<body>
    {{-- Navbar --}}
    @extends('layouts.navbar')
        @section('subnav')
            <div class="sub-navbar flex justify-center bg-zinc-900">
            <div><a href="/">Home</a></div>
            <div><a href="">Categories <i class="fa-solid fa-chevron-down text-xs" style="color: #fffff;"></a></i></div>
            <div><a href="{{route('post.index')}}">Blog</a></div>
            <div><a href="">About</a></div>
            <div><a href="">Contact</a></div>
            <div><a href="/chat">QuickChat</a></div>
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
    {{-- Content --}}
    <section id="content" class="mt-[114px] mb-[50px]">
        <div id="article-content" class="px-[250px] pt-[30px]">
            @can('update', $post)
                <a href="{{route('post.edit', ['post' => $post])}}" class="bg-red-600 text-white rounded-sm px-2 py-1">Update</a>
            @endcan
            @can('delete', $post)
                <form action="{{route('post.destroy', ['post' => $post])}}"  class="inline bg-red-600 text-white rounded-sm px-2 py-1" method="POST">
                    @method('DELETE')
                    @csrf
                    <button>Delete</button>
                </form>
            @endcan
            <div class="mt-6 text-sm text-gray-400">{{$post->created_at}} - {{$post->user->name}}</div>
            <h1 class="font-extrabold text-[2.5rem]">{{$post->tittle}}</h1>
            <div class="mt-6">{!! $post->content !!}</div>
        </div>

        {{-- Comment --}}
        <div class="w-fullbg-white rounded-lg border p-1 md:p-3 m-10">
            
            @auth
            <form action="" method="POST" class="store_comment_form" id="{{$post->id}}">
                @csrf
                <h2 class="pl-3">Add Comment</h2>
                <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">
                <div class="w-full px-3 mb-2 mt-6">
                    <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white" name="content" placeholder="Comment" required></textarea>
                </div>
            
                <div class="w-full flex justify-end px-3 my-3">
                    <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" id="add_comment_btn" value='Add Comment'>
                </div>
            </form>
            @endauth
            <h3 class="font-semibold p-1">Comment</h3>
            <div class="flex flex-col gap-5 m-3">
                <div id="comment_container"></div>
            </div>
        </div>
    </section>
    
    {{-- Footer --}}
    @include('layouts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function show_reply_form(id, post_id){
            var replyForm = 
            `<form action='' method='POST' id='store_reply_form_${id}'>
                @csrf
                <input type='hidden' name='comment_id' id='comment_id' value="${id}">
                <input type='hidden' name='post_id' id='post_id' value="${post_id}">
                <div class='text-gray-300 font-bold pl-14'>|</div>
                <div class='mx-3'>
                    <textarea class='bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white' name='content' placeholder='Reply' required></textarea>
                </div>
                <div class='w-full flex justify-end px-3 my-3'>
                    <input type='submit' class='px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500' id="add_reply_btn" value='Post'>
                </div>
            </form>`

            var store_reply_form = document.getElementById(`store_reply_form_${id}`);
            var comment = document.querySelector(`.comment_${id}`);
            var store_reply_form = document.getElementById(`store_reply_form_${id}`);
            if(store_reply_form != null){
                store_reply_form.remove();
            }
            comment.innerHTML += replyForm;

            $(`#store_reply_form_${id}`).submit(function(e){
                e.preventDefault();
                const fd = new FormData(this);
                $('#add_reply_btn').val('Adding...');
                $.ajax({
                    url: '{{route('comment.reply')}}',
                    method: 'post',
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function(response){
                        console.log(response.status);
                        if(response.status == 200){
                            Swal.fire(
                            'Add successfully!',
                            'You clicked the button!',
                            'success'
                            )
                            $(`#store_reply_form_${id}`).remove();
                            fetchAllComment();
                        }
                    }
                })
            })
        }

        function edit_comment(id, commentContent){
            var comment = document.querySelector(`.comment_${id}`);
            // var comment_detail = comment.querySelector('.comment_detail');
            // comment_detail.remove();
            var comment_container = comment.querySelector('.comment_container');
            if(comment_container != null){
                comment_container.removeAttribute('class')
                comment_container.setAttribute('class', 'border rounded-md')
            }
            var comment_content = comment.querySelector('.comment_content');
            var reply_btn = comment.querySelector('.reply_btn');
            comment_content.remove();
            if(reply_btn != null){
                reply_btn.remove();
            }
            var comment_main_comp = comment.querySelector(`.comment_main_comp_${id}`);
            var formEditCmt = 
                `<form action="" method="POST" class="edit_comment_form_${id}">
                    @csrf
                    <input type="hidden" id="comment_id" name="comment_id" value="${id}">
                    <div class="w-full px-3 mb-2 mt-6">
                        <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white edit_comment_input" name="content" placeholder="Comment" required></textarea>
                    </div>
                
                    <div class="w-full flex justify-end px-3 my-3">
                        <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" id="edit_comment_btn" value='Edit Comment'>
                    </div>
                </form>`;

                console.log(comment_main_comp);
            comment_main_comp.innerHTML += formEditCmt;
            var edit_comment_input = comment_main_comp.querySelector('.edit_comment_input');
            edit_comment_input.value = commentContent;
            edit_comment_input.focus();

            $(`.edit_comment_form_${id}`).submit(function(e){
                e.preventDefault();
                const fd = new FormData(this);
                $('#edit_comment_btn').val('Editing...');
                $.ajax({
                    url: '{{route('comment.update')}}',
                    method: 'post',
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function(response){
                        if(response.status == 200){
                            Swal.fire(
                                'Edit successfully!',
                                'You clicked the button!',
                                'success'
                            )
                        }
                        $(`.edit_comment_form_${response.comment_id}`).remove();
                        var text = 
                            `<p class="text-gray-600 mt-2 comment_content">
                            ${response.comment_content}
                            </p>
                            <button class="text-right text-blue-500 reply_btn" onclick="show_reply_form(${response.comment_id})">Reply</button>`
                        $(`.comment_main_comp_${response.comment_id}`).append(text)
                        fetchAllComment();
                        }
                })
            });
        }
        
            $('.store_comment_form').submit(function (e) { 
                e.preventDefault();
                const fd = new FormData(this);
                $('#add_comment_btn').val('Adding...');
                $.ajax({
                    url: '{{route('comment.store')}}',
                    method: 'post',
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function(response){
                        console.log(response.status);
                        if(response.status == 200){
                            Swal.fire(
                            'Add successfully!',
                            'You clicked the button!',
                            'success'
                            )
                            fetchAllComment();
                        }
                        $('#add_comment_btn').val('Add Comment');
                        $('.store_comment_form')[0].reset();
                    }
                })
            });

            $(document).on('click', '.delete_comment_btn', function(e){
                e.preventDefault();
                const id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('comment.destroy') }}',
                        method: 'post',
                        data:{
                            id: id,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(response){
                            console.log(response.status);
                            if(response.status == 200){
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                fetchAllComment();
                            }
                        }
                    })
                }
                })
            })


            fetchAllComment();

            function fetchAllComment(){
                $.ajax({
                    url: '{{ route('fetchAllComment') }}',
                    method: 'get',
                    data:{
                        id: {{$post->id}}
                    },
                    success: function(response){
                        $('#comment_container').html(response.data);
                    }
                });
            }
    
    </script>
</body>
</html>
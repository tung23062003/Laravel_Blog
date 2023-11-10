@foreach ($comments as $comment)
    {!!$isReply!!}
    <div class="comment_{{$comment->id}} flex w-full justify-between rounded-md flex-col {{$margin}} {{$padding}}" id="{{$comment->id}}">
        <div class="flex justify-between border rounded-md comment_container">
            <div class="p-3 comment_main_comp_{{$comment->id}}">
                <div class="flex gap-3 items-center">
                    <img src="{{URL::asset('avatar/avatar.jpg')}}"
                        class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400  shadow-emerald-400">
                    <h3 class="font-bold">
                        {{$comment->user->name}}
                        <br>
                        <span class="text-sm text-gray-400 font-normal">{{$comment->created_at}}</span>
                    </h3>
                </div>
                <p class="text-gray-600 mt-2 comment_content">
                    {{$comment->content}}
                </p>
                @auth
                <button class="text-right text-blue-500 reply_btn" onclick="show_reply_form({{$comment->id}}, {{$post_id}})">Reply</button>
                @endauth
            </div>
            @include('layouts.detail', ['comment' => $comment])
        </div>
        @include('reply', ['comments' => $comment->replies, 'padding' => 'pl-10', 'margin' => null, 'isReply' => '<div class="text-gray-300 font-bold pl-14 {{$padding}}">|</div>'])
    </div>
@endforeach

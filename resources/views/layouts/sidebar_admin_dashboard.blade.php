<div id="sidebar" class="fixed flex-col t-0 mt-[70px] bg-zinc-800 w-[15%] h-screen">
    <li class="mt-[10px]"><i class="fa-solid fa-house"></i> <a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li><i class="fa-solid fa-clone"></i> <a href="{{route('category.index')}}">Category</a></li>
    <li><i class="fa-brands fa-product-hunt"></i> <a href="{{route('admin.post.index')}}">Post</a></li>
    <li><i class="fa-solid fa-user"></i> <a href="">User</a></li>
    <li><i class="fa-solid fa-signs-post"></i> <a href="{{route('admin.moderation')}}">Post moderation</a></li>
    <li><i class="fa-solid fa-signs-post"></i> <a href="{{route('admin.featuredPost')}}">Featured Post</a></li>
</div>
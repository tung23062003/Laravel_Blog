<?php
namespace App\Services;

use App\Models\Post;
use App\Repositories\Interface\PostRepositoryInterface;
use App\Repositories\Interface\PostTagRepositoryInterface;
use App\Repositories\Interface\TagRepositoryInterface;
use DOMDocument;
use Illuminate\Support\Facades\Auth;

class PostService{
    
    protected $postRepository;
    protected $tagRepository;
    protected $postTagRepository;
    public function __construct(PostRepositoryInterface $postRepository, TagRepositoryInterface $tagRepository, PostTagRepositoryInterface $postTagRepository){
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->postTagRepository = $postTagRepository;
    }
    public function getPublishUnOutstandingPost() {
        return $this->postRepository->getPublishUnOutstandingPost();
    }
    public function getFeaturedPost(){
        return $this->postRepository->getFeaturedPost();
    }
    public function getApprovedPost(){
        return $this->postRepository->getApprovedPost();
    }
    public function AddTagAndPostTag(Post $post, $tag){
        $tagRecordCheckExist = $this->tagRepository->getByName($tag);
        if($tagRecordCheckExist->count() == 0){
            $this->tagRepository->create(['name' => $tag]);
        }
        $tagRecord = $this->tagRepository->getByName($tag);
        $this->postTagRepository->create(['post_id' => $post->id, 'tag_id' => $tagRecord[0]->id]);
    }
    
    public function getImageElement($dom,$content){
        $dom->loadHTML($content, 9);
        $images = $dom->getElementsByTagName('img');
        return $images;
    }

    public function saveAddImageContent($key,$img){
        $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
        $image_name = '/upload/' . time() . $key . '.png';
        file_put_contents(public_path().$image_name, $data);

        $img->removeAttribute('src');
        $img->setAttribute('src', $image_name);
    }
    public function createPost($request){
        $imageShow_name = time() . rand(1,1000) . '.' . $request['image']->extension();
        $request['image']->move(public_path('upload'), $imageShow_name);
        
        $content = $request['content'];

        $dom = new DOMDocument();
        $images =  $this->getImageElement($dom, $content);
        foreach($images as $key => $img){
            $this->saveAddImageContent($key, $img);
        }
        $content = $dom->saveHTML();

        if(Auth::check() && Auth::user()->role == 'admin'){
            $post = $this->postRepository->createPostAdmin($request, $content, $imageShow_name);
        }else{
            $post = $this->postRepository->createPost($request, $content, $imageShow_name);
        }

        // Create Tag and PostTag
        $this->exlodeAddTagPostTag($request['tag'], $post);
        
    }
    public function exlodeAddTagPostTag($tag, Post $post){
        if(str_contains($tag, ' ')){
            $tagArr = explode(' ', $tag);
            foreach($tagArr as $tag){
                $this->AddTagAndPostTag($post, $tag);
            }
        }else{
            $this->AddTagAndPostTag($post, $tag);
        }
    }

    public function updatePost($request, Post $post){
        $imageShow_name = '';
        if(isset($request->image)){
            $imageShow_name = time() . rand(1,1000) . '.' . $request->image->extension();
            $request->image->move(public_path('upload'), $imageShow_name);
            $this->postRepository->updateImage($post, $imageShow_name);
        }
        
        $content = $request['content'];

        $dom = new DOMDocument();
        $images =  $this->getImageElement($dom, $content);
        foreach($images as $key => $img){
            if(strpos($img->getAttribute('src'),'data:image/') === 0){
                $this->saveAddImageContent($key, $img);
            }
        }
        $content = $dom->saveHTML();

        $post2 =  $this->postRepository->updatePost($request, $post, $content);

        // Xóa bỏ post_tag cũ rồi thêm lại mới
        $this->postTagRepository->delete($post->id);
        // Create Tag and PostTag
        $this->exlodeAddTagPostTag($request['tag'], $post2);
    }

    public function deletePost(Post $post){
        return $this->postRepository->deletePost($post);
    }
    public function addFeaturedPost(Post $post){
        if($this->postRepository->countFeaturedPost() >= 3){
            return redirect('../../')->with('message','You have only 3 featured post');
        }
        $this->postRepository->addFeaturedPost($post);
    }
    public function removeFeaturedPost(Post $post){
        return $this->postRepository->removeFeaturedPost($post);
    }
    public function getUnapprovedPost(){
        return $this->postRepository->getUnapprovedPost();
    }
    public function acceptPost(Post $post){
        return $this->postRepository->acceptPost($post);
    }
    public function rejectPost(Post $post){
        return $this->postRepository->rejectPost($post);
    }
    public function countApprovedPost(){
        return $this->postRepository->countApprovedPost();
    }
    public function countUnapprovedPost(){
        return $this->postRepository->countUnapprovedPost();
    }
}
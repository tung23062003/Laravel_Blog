<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'role' => 'admin',
        ]);

        Category::create([
            'name' => 'Tin tức xã hội',
            'slug' => 'tin-tuc-xa-hoi',
        ]);
        Category::create([
            'name' => 'An ninh',
            'slug' => 'an-ninh',
        ]);
        Tag::create([
            'name'=> 'Music',
        ]);
        Tag::create([
            'name'=> 'Game',
        ]);
        Tag::create([
            'name'=> 'Dance',
        ]);
        Tag::create([
            'name'=> 'School',
        ]);
        Post::create([
            'tittle' => 'What Your Music Preference Say About You and Your Personality',
            'slug' => 'music-prefrence',
            'image' => '1699617454990.jpg',
            'content' => 
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"> <html><body><p>asdasdasdasd</p>
            <p>asdasdasdasd123</p>
            <p>asdasdasdasd123</p>
            <p>&nbsp;</p>
            <p><img src="../../upload/16982483300.png" width="474" height="94"></p>
            <p>&nbsp;</p>
            <p>&aacute;dkjalsdasd</p>
            <p><img src="../../upload/16989825331.png"></p>
            <p>&nbsp;</p></body></html> ',

            'category_id' => 1,
            'user_id' => 1,
            'approved' => true,
            'outstanding' => true,
        ]);
        Post::create([
            'tittle' => 'What Your Music Preference Say About You and Your Personality',
            'slug' => 'gaming-prefrence',
            'image' => '1699617590294.jpg',
            'content' => 
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"> <html><body><p>asdasdasdasd</p>
            <p>asdasdasdasd123</p>
            <p>asdasdasdasd123</p>
            <p>&nbsp;</p>
            <p><img src="../../upload/16982483300.png" width="474" height="94"></p>
            <p>&nbsp;</p>
            <p>&aacute;dkjalsdasd</p>
            <p><img src="../../upload/16989825331.png"></p>
            <p>&nbsp;</p></body></html> ',

            'category_id' => 1,
            'user_id' => 1,
            'approved' => true,
            'outstanding' => true,
        ]);
        Post::create([
            'tittle' => 'What Your Music Preference Say About You and Your Personality',
            'slug' => 'community-prefrence',
            'image' => '16996175900.png',
            'content' => 
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"> <html><body><p>asdasdasdasd</p>
            <p>asdasdasdasd123</p>
            <p>asdasdasdasd123</p>
            <p>&nbsp;</p>
            <p><img src="../../upload/16982483300.png" width="474" height="94"></p>
            <p>&nbsp;</p>
            <p>&aacute;dkjalsdasd</p>
            <p><img src="../../upload/16989825331.png"></p>
            <p>&nbsp;</p></body></html> ',

            'category_id' => 1,
            'user_id' => 1,
            'approved' => true,
            'outstanding' => true,
        ]);
        Post::create([
            'tittle' => 'What Your Music Preference Say About You and Your Personality',
            'slug' => 'test-prefrence',
            'image' => '169945085038.jpg',
            'content' => 
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"> <html><body><p>asdasdasdasd</p>
            <p>asdasdasdasd123</p>
            <p>asdasdasdasd123</p>
            <p>&nbsp;</p>
            <p><img src="../../upload/16982483300.png" width="474" height="94"></p>
            <p>&nbsp;</p>
            <p>&aacute;dkjalsdasd</p>
            <p><img src="../../upload/16989825331.png"></p>
            <p>&nbsp;</p></body></html> ',

            'category_id' => 1,
            'user_id' => 1,
            'approved' => true,
            'outstanding' => false,
        ]);
        PostTag::create([
            'post_id' => 1,
            'tag_id' => 1,
        ]);
        PostTag::create([
            'post_id' => 2,
            'tag_id' => 2,
        ]);
        PostTag::create([
            'post_id' => 3,
            'tag_id' => 3,
        ]);
        PostTag::create([
            'post_id' => 4,
            'tag_id' => 4,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;

class BlogController extends Controller
{
    // ****************************** Catégories ******************************
    public function allBlogCategory () {
        $categories = BlogCategory::orderBy('category_name', 'asc')->get();
        return view('backend.blog.categories.blog_category', compact('categories'));
    } // fin de la fonction


    public function storeBlogCategory (Request $request) {

        $request->validate([
            'category_name' => 'required',
        ], [
            'category_name.required' => 'Entrez la categorie',
        ]);

        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_at' => Carbon::now(),
        ]);

        $notif = array('message' => 'Catégorie ajoutée avec succès', 'alert-type' => 'success');

        return redirect()->route('blog.category.all')->with($notif);

    } // fin de la fonction


    public function editBlogCategory ($id) {
        $catData = BlogCategory::find($id);
        return view('backend.blog.categories.category_edit', compact('catData'));
    } // fin de la fonction


    public function updateBlogCategory (Request $request) {

        $request->validate([
            'category_name' => 'required',
        ], [
            'category_name.required' => 'Entrez la categorie',
        ]);

        $cat_id = $request->id;

        BlogCategory::findOrFail($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'updated_at' => Carbon::now(),
        ]);

        $notif = array('message' => 'Catégorie éditée avec succès', 'alert-type' => 'success');

        return redirect()->route('blog.category.all')->with($notif);

    } // fin de la fonction


    public function deleteBlogCategory ($id) {
        BlogCategory::findOrFail($id)->delete();
        $notif = array('message' => 'Catégorie supprimée avec succès', 'alert-type' => 'success');
        return back()->with($notif);
    } // fin de la fonction


    // ********************************* Posts *********************************
    public function allBlogPost () {
        $posts = BlogPost::latest()->get();
        return view('backend.blog.posts.post_all', compact('posts'));
    } // fin de la fonction


    public function addBlogPost () {
        $blogCat = BlogCategory::orderBy('category_name', 'asc')->get();
        return view('backend.blog.posts.post_add', compact('blogCat'));
    } // fin de la fonction


    public function storeBlogPost (Request $request) {

        $request->validate([
            'post_title' => 'required',
        ], [
            'post_title.required' => 'Entrez le titre de l\'article'
        ]);

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()).$image->getClientOriginalExtension();
            $save_url = 'upload/posts/'.$name_gen;

            Image::make($image)->resize(770, 520)->save($save_url);
        } else {
            $save_url = '';
        }

        BlogPost::insert([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now(),
        ]);

        $notif = array('message' => 'Article posté avec succès', 'alert-type' => 'success');

        return redirect()->route('blog.post.all')->with($notif);

    } // fin de la fonction


    public function editBlogPost ($id) {
        $postData = BlogPost::find($id);
        $blogCat = BlogCategory::orderBy('category_name', 'asc')->get();
        return view('backend.blog.posts.post_edit', compact('postData', 'blogCat'));
    } // fin de la fonction


    public function updateBlogPost (Request $request) {

        $request->validate([
            'post_title' => 'required',
        ], [
            'post_title.required' => 'Entrez le titre de l\'article'
        ]);

        $post_id = $request->id;
        $obj = BlogPost::find($post_id);

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()).$image->getClientOriginalExtension();
            $save_url = 'upload/posts/'.$name_gen;

            Image::make($image)->resize(770, 520)->save($save_url);

            if ($obj->post_image) {
                unlink(public_path($obj->post_image));
                $obj->post_image = '';
            }

            $obj->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $obj->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_tags' => $request->post_tags,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notif = array('message' => 'Article actualisé avec succès', 'alert-type' => 'success');

        return redirect()->route('blog.post.all')->with($notif);

    } // fin de la fonction


    public function deleteBlogPost ($id) {

        $obj = BlogPost::find($id);

        if ($obj->post_image) {
            unlink(public_path($obj->post_image));
        }

        $obj->delete();

        $notif = array('message' => 'Article supprimé avec succès', 'alert-type' => 'success');

        return back()->with($notif);

    } // fin de la fonction


    // commentaires
    public function commentBlogPost () {
        $comments = Comment::where('parent_id', null)->latest()->get();
        return view('backend.blog.comments.comment_all', compact('comments'));
    } // fin de la fonction


    public function replayBlogPost ($id) {
        $comment = Comment::find($id);
        return view('backend.blog.comments.comment_replay', compact('comment'));
    }


    public function replayMessageBlogPost (Request $request) {

        $id = $request->id;
        $post_id = $request->post_id;
        $user_id = Auth::user()->id;

        $comment = Comment::find($id);

        Comment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        
        $notif = array('message' => 'Réponse postée avec succès', 'alert-type' => 'success');

        return redirect()->route('blog.post.comment')->with($notif);

    } // fin de la fonction

}



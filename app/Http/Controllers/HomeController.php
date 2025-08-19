<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;
use App\Models\Product;
use App\Models\Category;
use Usamamuneerchaudhary\Commentify\Models\Comment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $data['business'] = Business::limit(4)
                                    ->orderBy('created_at', 'asc')
                                    ->inRandomOrder()
                                    ->get();

        $data['products'] = Product::select('product.*', 'business.id as b_id' ,'business.name as b_name','business.score as b_score', 'categories.name as c_name', 'categories.tw_color as tw_bg')
                                    ->join('business', 'business.id', '=', 'product.business_id')
                                    ->join('categories', 'categories.id', '=', 'product.categories_id')
                                    ->limit(8)
                                    ->orderBy('business.created_at', 'desc')
                                    ->get();

        $data['business_comments'] = Comment::select('users.name as u_name', 'users.id as u_id', 'comments.id as comment_id','comments.body', 'comments.score', 'comments.created_at','business.id as business_id', 'business.name as b_name', 'business.score as b_score')
                                    ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                                    ->leftJoin('user_profile', 'user_profile.user_id', '=', 'users.id')
                                    ->leftJoin('business', 'business.id', '=', 'comments.commentable_id')
                                    ->where('comments.parent_id', null)
                                    ->where('comments.commentable_type', 'App\Models\Business')
                                    ->orderBy('comments.created_at', 'desc')
                                    ->limit(3)
                                    ->get();

        $data['products_comments'] = Comment::select('users.name as u_name', 'users.id as u_id', 'comments.id as comment_id', 'comments.body', 'comments.score', 'comments.created_at', 'product.id as product_id', 'product.name as p_name', 'product.score as p_score')
                                    ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                                    ->leftJoin('user_profile', 'user_profile.user_id', '=', 'users.id')
                                    ->leftJoin('product', 'product.id', '=', 'comments.commentable_id')
                                    ->where('parent_id', null)
                                    ->where('commentable_type', 'App\Models\Product')
                                    ->orderBy('comments.created_at', 'desc')
                                    ->limit(3)
                                    ->get();

        $data['categories'] = Category::inRandomOrder()
                                    ->limit(6)
                                    ->get();

        return view('web.sections.static.home', $data) ;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;
use App\Models\Product;
use App\Models\Category;
use App\Models\TradeSkill;
use Usamamuneerchaudhary\Commentify\Models\Comment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $data['business'] = Business::inRandomOrder()
                                    ->limit(4)
                                    ->get();

        $data['products'] = Product::select('product.*', 'business.id as b_id' ,'business.name as b_name','business.score as b_score', 'categories.name as c_name', 'categories.tw_color as tw_bg')
                                    ->join('business', 'business.id', '=', 'product.business_id')
                                    ->join('categories', 'categories.id', '=', 'product.categories_id')
                                    ->limit(8)
                                    ->inRandomOrder()
                                    ->get();
        
        $data['trades'] = TradeSkill::select('trade_skill.*', 'trade_categories.name as tradeskill_name', 'trade_categories.tw_color as tw_bg')
                                    ->leftJoin('trade_categories', 'trade_categories.id', '=', 'trade_skill.trade_id')
                                    ->limit(8)
                                    ->inRandomOrder()
                                    ->get();

        $data['business_comments'] = Comment::select('users.name as u_name', 'users.id as u_id', 'comments.id as comment_id','comments.body', 'comments.score', 'comments.created_at','business.id as business_id', 'business.name as b_name', 'business.score as b_score')
                                    ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                                    ->leftJoin('user_profile', 'user_profile.user_id', '=', 'users.id')
                                    ->leftJoin('business', 'business.id', '=', 'comments.commentable_id')
                                    ->where('comments.parent_id', null)
                                    ->where('comments.commentable_type', 'App\Models\Business')
                                    ->whereNull('business.deleted_at')
                                    ->orderBy('comments.created_at', 'desc')
                                    ->limit(3)
                                    ->get();

        $data['products_comments'] = Comment::select('users.name as u_name', 'users.id as u_id', 'comments.id as comment_id', 'comments.body', 'comments.score', 'comments.created_at', 'product.id as product_id', 'product.name as p_name', 'product.score as p_score')
                                    ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                                    ->leftJoin('user_profile', 'user_profile.user_id', '=', 'users.id')
                                    ->leftJoin('product', 'product.id', '=', 'comments.commentable_id')
                                    ->where('parent_id', null)
                                    ->where('commentable_type', 'App\Models\Product')
                                    ->whereNull('product.deleted_at')
                                    ->orderBy('comments.created_at', 'desc')
                                    ->limit(3)
                                    ->get();
        
        $data['trades_comments'] = Comment::select(
                                                'users.name as u_name', 
                                                'users.id as u_id', 
                                                'comments.id as comment_id', 
                                                'comments.body', 
                                                'comments.score', 
                                                'comments.created_at', 
                                                'trade_skill.id as trade_id', 
                                                'trade_skill.name as trade_name', 
                                                'trade_skill.lastname as trade_lastname',  
                                                'trade_skill.score as trade_score',
                                                'trade_categories.name as tradeskill_name'
                                                )

                                    ->leftJoin('users',             'users.id',             '=', 'comments.user_id')
                                    ->leftJoin('user_profile',      'user_profile.user_id', '=', 'users.id')
                                    ->leftJoin('trade_skill',       'trade_skill.id',       '=', 'comments.commentable_id')
                                    ->leftjoin('trade_categories',  'trade_categories.id',  '=', 'trade_skill.trade_id')

                                    ->where('parent_id', null)
                                    ->where('commentable_type', 'App\Models\TradeSkill')
                                    ->whereNull('trade_skill.deleted_at')
                                    ->orderBy('comments.created_at', 'desc')
                                    ->limit(3)
                                    ->get();

        $data['categories'] = Category::inRandomOrder()
                                    ->limit(6)
                                    ->get();

        return view('web.sections.static.home', $data) ;

    }

    public function ttcc(){
        return view('web.sections.static.partials.ttcc');
    }
}

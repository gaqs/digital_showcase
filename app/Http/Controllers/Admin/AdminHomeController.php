<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Business;
use App\Models\Product; 
use App\Models\TradeSkill as Trade;

use Usamamuneerchaudhary\Commentify\Models\Comment;

class AdminHomeController extends Controller
{

    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403, 'Unauthorized action.');
        }


        //count every model
        $data['user_count'] = User::count();
        $data['business_count'] = Business::count();
        $data['product_count'] = Product::count();
        $data['trade_count'] = Trade::count();

        $data['latest_comments'] = Comment::select('users.name as u_name', 'users.id as u_id', 'comments.id as comment_id','comments.body', 'comments.commentable_type','comments.score', 'comments.created_at')
                                            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                                            ->leftJoin('user_profile', 'user_profile.user_id', '=', 'users.id')
                                            ->where('comments.parent_id', null)
                                            ->orderBy('comments.created_at', 'desc')
                                            ->limit(5)
                                            ->get();

        return view('admin.dashboard', $data);
    }

    public function show()
    {
        if (Gate::denies('access-admin')) {
            abort(403, 'Unauthorized action.');
        }

        //
    }

    public function store(Request $request){

        //
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function delete_file(Request $request)
    {
        if( $request->type == 'business'){
            $file = public_path('uploads/business/'.$request->file);
        }else if( $request->type == 'product' ){
            $file = public_path('uploads/products/'.$request->file);
        }else if($request->type == 'trade'){
            $file = public_path('uploads/trades/'.$request->file);
        }

        if (file_exists($file)) {
            if (unlink($file)) {
                // Archivo eliminado exitosamente
                return true;
            } else {
                // Error al eliminar el archivo
                return false;
            }
        } else {
            // El archivo no existe
            return true;
        }
    }


}

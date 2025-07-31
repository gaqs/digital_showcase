<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class AdminHomeController extends Controller
{

    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.dashboard');
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
        $file = ($request->type == 'business') ? public_path('uploads/business/'.$request->file) : public_path('uploads/products/'.$request->file);

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

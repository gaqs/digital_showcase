<?php
use App\Models\Business;
use App\Models\UserProfile;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (! function_exists('category_list')) {
    function category_list($selected){
        echo '<option value="0">Todas las categorías</option>';
        foreach (Category::all() as $cat){
            $thisone = ( $cat->id == $selected ) ? 'selected':'';
            echo '<option class="text-xl" value="'.$cat->id.'" '.$thisone.'>'.$cat->name.'</option>';
        }

    }

}

if (! function_exists('business_list_per_id')) {
    function business_list_per_id($selected, $user_id){
        $business = Business::where('user_id', $user_id)->get();
        echo '<option value="0">Seleccione un negocio</option>';
        foreach ($business as $bsns){
            $thisone = ( $bsns->id == $selected) ? 'selected':'';
            echo '<option class="text-xl" value="'.$bsns->id.'" data-folder="'.$bsns->folder.'" '.$thisone.' >'.$bsns->name.'</option>';
        }

    }

}

if( ! function_exists('manage_profile_files')) {
    function manage_profile_files($request, $field_name)
    {
        $user_id = Auth::user()->id;

        if ($request->hasFile($field_name)) {
            $user = UserProfile::firstOrCreate(['user_id' => $user_id]);
            $fileName = $user->$field_name;

            if (empty($fileName)) {
                $fileName = $field_name . '_' . Str::random(10) . '.' . $request->file($field_name)->extension();
                $user->$field_name = $fileName;
                $user->save();
            }

            $request->file($field_name)->move(public_path('uploads/users/' . $user_id . '/'), $fileName);
        }

        return response()->json(['success' => 200]);
    }
}


/*
return the business avatar folder, name and extension 'ugxIKlsdjw/_avatar.jpg'
*/
if( ! function_exists('show_business_avatar')) {
    function show_business_avatar($folder) {
        if( $folder != 'default' || $folder != null ){
            $directory = public_path('uploads/business/' . $folder . '/');
            $files = glob($directory . '_avatar*');

            if (!empty($files)) {
                $file = $files[0];
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                return $folder.'/_avatar.'.$extension;
            }
        }else{
            return $folder.'/_avatar.jpg';
        }
    }
}

if( ! function_exists('show_business_gallery')) {
    function show_business_gallery($folder) {
        if( $folder != null){
            $directory = public_path('uploads/business/' . $folder . '/');
        }else if($folder == null){
            $directory = public_path('uploads/business/default/');
        }

        $allFiles = scandir($directory);
        $avatarFile = glob($directory. '/_avatar.*');
        $avatar = isset($avatarFile[0]) ? basename($avatarFile[0]) : null;
        // Excluir los archivos ".", ".." y cualquier archivo que empiece con "_avatar"
        $images = array_diff($allFiles, array('.', '..', $avatar));

        return $images;
    }
}

if( ! function_exists('show_product_picture')) {
    function show_product_picture($folder) {
        $directory = public_path('uploads/products/' . $folder . '/');

        $allFiles = scandir($directory);
        $exclude = array('.', '..');

        $images = array_diff($allFiles, $exclude);

        return reset($images);

    }
}

if( ! function_exists('show_product_gallery')) {
    function show_product_gallery($folder) {
        $directory = public_path('uploads/products/' . $folder . '/');

        $allFiles = scandir($directory);
        $exclude = array('.', '..');

        $images = array_diff($allFiles, $exclude);

        return $images;

    }
}

function print_stars($rating) {
    $total_stars = 5; // Cantidad total de estrellas
    $html = '';
    $rating = round($rating);
    $rating = max(0, min($rating, $total_stars));

    for ($i = 1; $i <= $rating; $i++) {
        $html .= '<i class="fa-solid fa-star color-amber"></i>';
    }
    for ($i = $rating + 1; $i <= $total_stars; $i++) {
        $html .= '<i class="fa-solid fa-star text-neutral-400"></i>';
    }

    return $html;
}

function beautiful_date($date){
    setlocale(LC_TIME, 'es_ES.utf8');
    $timestamp = strtotime($date);
    $fechaFormateada = date("F j, Y", $timestamp);

    return $fechaFormateada;
}

function comment_likes($id){
    $qty_likes = DB::table('comment_likes')
                    ->select('id')
                    ->where('comment_id', '=', $id)
                    ->count();

    return $qty_likes;
}

function delete_folder($carpeta) {

    if (is_dir($carpeta)) {

        $archivos = scandir($carpeta);

        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                $ruta = $carpeta . DIRECTORY_SEPARATOR . $archivo;

                if (is_dir($ruta)) {
                    delete_folder($ruta);
                } else {
                    unlink($ruta);
                }
            }
        }
        // Finalmente, elimina la carpeta
        rmdir($carpeta);
        return true;
    } else {
        return false;
    }
}


if (! function_exists('role_list')) {
    function role_list($selected){

        $roles = ['user','editor','admin','superadmin'];
        
        foreach ($roles as $rol) {
            $selectedRole = ($rol == $selected) ? 'selected' : '';
            echo '<option class="text-xl" value="'.$rol.'" '.$selectedRole.'>'.ucfirst($rol).'</option>';
        }

    }
}

if (! function_exists('str_random')) {
    function str_random($length = 10){

        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);

    }
}



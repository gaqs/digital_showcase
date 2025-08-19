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

if (!function_exists('get_images_from_folder')) {
    /**
     * Recupera avatar, banner o galería de imágenes desde cualquier carpeta padre.
     * @param string $entity (business, products, trades, user)
     * @param string|int $folder (nombre de la carpeta o id de usuario) ### FIX TO CHANGE FOLER NAME TO ONLY ID OF BUSINESS, PRODUCT, TRADE OR USER
     * @param string $type ('avatar', 'banner', 'gallery')
     * @return mixed (string para avatar/banner, array para galería)
     */
    function get_images_from_folder($entity, $folder, $type = 'gallery')
    {
        $base = public_path("uploads/$entity/$folder/");

        // Buscar avatar
        if ($type === 'avatar') {
            $avatar = glob($base . '_avatar.*');
            return isset($avatar[0]) ? $folder.'/'.basename($avatar[0]) : 'default/_avatar.jpg';
        }

        // Buscar banner
        if ($type === 'banner') {
            $banner = glob($base . '_banner.*');
            return isset($banner[0]) ? $folder.'/'.basename($banner[0]) : 'default/_banner.jpg';
        }

        // Buscar galería (excluye avatar y banner)
        if ($type === 'gallery') {
            $allFiles = scandir($base);
            $avatar = glob($base . '_avatar.*');
            $banner = glob($base . '_banner.*');
            $exclude = array('.', '..');
            if (isset($avatar[0])) $exclude[] = basename($avatar[0]);
            if (isset($banner[0])) $exclude[] = basename($banner[0]);
            $images = array_diff($allFiles, $exclude);
            return array_values($images); // array de nombres de archivo
        }

        return null;
    }
}


if (!function_exists('save_entity_image')) {
    /**
     * Guarda imágenes (avatar, banner, gallery) para user, product, business, trade.
     * @param \Illuminate\Http\Request $request
     * @param string $entity ('user', 'product', 'business', 'trade')
     * @param string|int $folder (id o nombre de carpeta)
     * @param string $type ('avatar', 'banner', 'gallery')
     * @return array|string
     */
    function save_entity_image($request, $entity, $folder, $type = 'gallery')
    {
        $base = public_path("uploads/$entity/$folder/");
        if (!is_dir($base)) {
            mkdir($base, 0775, true);
        }

        // Avatar o banner (un solo archivo)
        if (in_array($type, ['avatar', 'banner'])) {
            if ($request->hasFile($type)) {
                $file = $request->file($type);
                $ext = $file->getClientOriginalExtension();
                $fileName = "_{$type}." . $ext;

                // Borra el anterior si existe
                foreach (glob($base . "_{$type}.*") as $old) {
                    @unlink($old);
                }

                $file->move($base, $fileName);
                return true;
            }
        }

        // Galería (varios archivos)
        if ($type === 'gallery' && $request->hasFile('gallery')) {
            $saved = [];
            foreach ($request->file('gallery') as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $ext;
                $file->move($base, $fileName);
                $saved[] = $fileName;
            }
            return $saved;
        }

        return [];
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



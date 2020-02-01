<?php
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('login', 'AuthController@login');
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', function(){
    return view('profile', ['name'=>Auth::user()->name]);
})->name('profile');
Route::get('/charts', function(){
    return view('chart', ['name'=>Auth::user()->name]);
})->name('charts');
Route::get('/inmueble-personal', function(){
    return view('inmueble', ['name'=>Auth::user()->name]);
})->name('inmueble-personal');
Route::get('/inmueble-general', function(){
    return view('inmuebleg', ['name'=>Auth::user()->name]);
})->name('inmueble-geneal');
Route::get('/getalluser',function(){
    return DB::table('users')->get();
});
Route::get('/getallinm',function(){
    return DB::table('inmueble')->get();
});
Route::post('/getginm',function(Request $request){
    if(Auth::user()->admin==0){
        if($request->filtro!=="0"){
            return (DB::table('inmueble')->where('ubicacion', '=', $request->filtro)->paginate(3));
        }else{
            return (DB::table('inmueble')->paginate(3));
        }
    }else{
        abort(404);
    }
});
Route::post('/getpinm',function(Request $request){
    if(Auth::user()->admin==0){
        if($request->filtro!=="0"){
            return (DB::table('inmueble')->where([['id_usuario','=', Auth::user()->id],['ubicacion', '=', $request->filtro]])->paginate(3));
        }else{
            return (DB::table('inmueble')->where('id_usuario','=', Auth::user()->id)->paginate(3));
        }
    }else{
        abort(404);
    }
});
Route::get('/getpinm',function(Request $request){
    if(Auth::user()->admin==0){
            return (DB::table('inmueble')->where('id_usuario','=', Auth::user()->id)->paginate(3));
    }else{
        abort(404);
    }
});
Route::get('/getginm',function(Request $request){
    if(Auth::user()->admin==0){
        return (DB::table('inmueble')->paginate(3));
    }else{
        abort(404);
    }
});
Route::post('/get1inm',function(Request $request){
    if(Auth::user()->admin==0){
        return (DB::table('inmueble')->where('id','=', $request->id)->paginate(1));
    }else{
        abort(404);
    }
});
Route::post('/updateInm',function(Request $request){
    if($request->band==1){
        $images = DB::table('inmueble')->get();
        $imageName = sizeof($images).'.'.$request->image->extension();  
        $request->image->move(public_path('images/inmueble'), $imageName);
        DB::table('inmueble')->where('id',$request->id)->update(array(
            'tipo' => $request->tipo, 
            'ubicacion' => $request->ubic, 
            'precio' => $request->precio,
            'img' => $imageName,
            'name'=>$request->name
        ));
        return response()->json(['success'=>'You have successfully upload image.']);
    }else{
        DB::table('inmueble')->where('id',$request->id)->update(array(
            'tipo' => $request->tipo, 
            'ubicacion' => $request->ubic, 
            'precio' => $request->precio,
            'name'=>$request->name
        ));
        return response()->json(['success'=>'You have successfully upload image.']);
    }
    });
Route::post('/deleteInm',function(Request $request){
    DB::table('inmueble')->where('id',$request->id)->delete();
    return $request->id;

    });
Route::post('/createInm',function(Request $request){
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $images = DB::table('inmueble')->get();
    $imageName = sizeof($images).'.'.$request->image->extension();  

    $request->image->move(public_path('images/inmueble'), $imageName);
    DB::table('inmueble')->insert(
        ['id_usuario' => $request->id, 
        'tipo' => $request->tipo, 
        'ubicacion' => $request->ubic, 
        'precio' => $request->precio,
        'img' => $imageName,
        'name'=>$request->name]
    );
    return response()->json(['success'=>'You have successfully upload image.']);

    })->name('image.upload.post');
Route::get('/usuarios', function(){
        if(Auth::user()->admin==1){
            return view('users');
        }else{
            abort(404);
        }
        return view ('error');
})->name('users');
Route::get('invoice', function(){
    return view('invoice');
});
Route::get('/profiles', function(){
    return Auth::user();
})->name('profiles');
//Route::get('profile', 'HomeController@profile')->name('profile');
//Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );
Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::post('/formimage',function(Request $request){
    //$imageName = time().'.'.$request->image->getClientOriginalExtension();
    //$request->image->move(public_path('images'), $imageName);
    Log::info($request);
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
        
    $imageName = $request->id.'.'.$request->image->extension();  

    $request->image->move(public_path('images'), $imageName);
    DB::table('users')->where('id',request()->all()['id'])->update(array(
        'img'=>$imageName
    ));
    return response()->json(['success'=>'You have successfully upload image.']);

    })->name('image.upload.post');
Route::post('/formSubmit/{id}',function($id)
{
    $lista = explode("-", $id);
    
     DB::table('users')->where('id',$lista[0])->update(array(
        "id" => $lista[0],
        "name" => $lista[1],
        "email" => $lista[2],
        "password" => bcrypt($lista[3])
    ));
    return (request());

});
/*Route::post('/formSubmit',function(){
    return (request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed'
    ]));
});*/
Route::post('/formSubmit', function(){
      //request()->all()['id']
    $response = array('response' => '', 'success'=>false);

    $rules = array(
    'name' => 'required',
    'document' => 'required',
    'email' => 'required|email|unique:users' . ',id,' . request()->all()['id'],
    'password' => 'required|min:6|confirmed');       

    $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{

            DB::table('users')->where('id',request()->all()['id'])->update(array(
                "id" => request()->all()['id'],
                "name" => request()->all()['name'],
                "document" => request()->all()['document'],
                "email" => request()->all()['email'],
                "password" => bcrypt(request()->all()['password'])
            ));
       }
        

    return response()->json($response);
});
Route::get('/getusers',function(){
    if(Auth::user()->admin==1){
        return (DB::table('users')->where('admin','<>', 1)->orWhere('admin','=', null)->paginate(3));
    }else{
        abort(404);
    }
});
Route::post('/updateusers',function(){
    if(Auth::user()->admin==1){
        if(request()->all()['activo']!=2){
            return DB::table('users')->where('id',request()->all()['id'])->update(array(
                "id" => request()->all()['id'],
                "activo" => request()->all()['activo']
            ));
        }else{
            return DB::table('users')->where('id',request()->all()['id'])->delete();
        }
        }else{
            abort(404);
        }
        

});
});

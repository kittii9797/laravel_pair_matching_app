<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

    //+
            'image' => ['required','file','mimes:jpeg,png,jpg,bmb', 'max:1080'],
        ]);
    }
    /**
     *  2.(storage\app\public\images)      
     *  3.img_url
     */
    protected function create(array $data)
    {

        $fileName = $data['image']->getClientOriginalName();

        //  Storage::putFileAs('public/images',$data['image'],$fileName);
         $data['image']->storeAs('public/images',$fileName);


         $fullFilePath = 'storage/images/'.$fileName;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),


            'img_url'  => $fullFilePath,
        ]);
    }
}
<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
 
class GoogleLoginController extends Controller
{
 
public function redirect($provider)
{
    //dd('sdnasjfb');
    return Socialite::driver($provider)->redirect();
}
 
public function callback($provider)
{
    
           
    $getInfo = Socialite::driver($provider)->stateless()->user();
     
    $user = $this->createUser($getInfo,$provider);
 
    auth()->login($user);
 
    return redirect('/');
 
}
function createUser($getInfo,$provider){
 
 $user = User::where('google_id', $getInfo->id)->first();
 
 if (!$user) {
     $user = User::create([
        'name'     => $getInfo->name,
        'email'    => $getInfo->email,
        'provider' => $provider,
        'google_id' => $getInfo->id,
        'password'=>'password',
        'roles'=>' USER'
    ]);
  }
  return $user;
}
}
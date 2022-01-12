<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Hash;
use DB;
class LoginController extends Controller
{
    function index(){
        $this->data = array(
            "heading"=>__('login_data.login')
        );
        return view('login',$this->data);
    }

    function login_action(Request $req){

        $req->validate([
            "email"=>'required|email',
            "password"=>'required'
        ]);

        $email = $req->input('email');
        $password = $req->input('password'); 

        $userCheck = DB::table('users')->where('email', $email)->first();  
        if(!$userCheck){
            $req->session()->flash('warning','This email is not registered with us.');
            return redirect('/');
        }elseif($userCheck->login_attempt == 3){
            $req->session()->flash('warning','Your account is locked, To unlock account please contact admin.');
            return redirect('/');
        }elseif($userCheck->status=='I'){
            $req->session()->flash('warning','Your account is inactive, To activate account please contact admin.');
            return redirect('/');
        }

        if(hash::check($password,$userCheck->password)) {
             DB::table('users')
                ->where('id',$userCheck->id)
                ->update([
                    'is_login'=>'Y',
                    'login_attempt'=> 0 ,
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

            $user_log = DB::table('user_logs')
                ->insert([
                    'user_id'=>$userCheck->id,
                    'login_time'=>date('Y-m-d H:i:s'),
                    'ip_address'=>$req->ip()
                ]);
            $user_log_id =DB::getPdo()->lastInsertId();

            $getRoles = DB::table('roles')->where('id',$userCheck->role_id)->first();

            $req->session()->put([
                'id'=> $userCheck->id,
                'user_log_id'=> $user_log_id,
                'name'=> $userCheck->name,
                'email'=> $userCheck->email,
                'mobile'=> $userCheck->mobile,
                'image'=> $userCheck->image,
                'role'=> $getRoles->title,
                'role_id'=>$getRoles->id
            ]);

            $req->session()->flash('success','Login Successfuly');
            return redirect('Dashboard');
            

        }else{
          DB::table('users')
                ->where('id',$userCheck->id)
                ->update([
                    'login_attempt'=> $userCheck->login_attempt + 1 ,
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

            $userCheck = DB::table('users')->where('email', $email)->first();

            switch($userCheck->login_attempt){
                case 1 : 
                    $req->session()->flash('warning','Incorrect password. You have 2 attempt left.');
                    return redirect('/');
                case 2 :
                    $req->session()->flash('warning','Incorrect password. You have 1 attempt left.');
                    return redirect('/');
                case 3 :
                    $req->session()->flash('warning','Incorrect password. You have reach the maximum failed attempt. Your account is locked.');
                    return redirect('/');
            }  
        }

    }

    function registration_list(){
        $roleData = DB::select('select * from roles where status="A"');
        $countryData = DB::select('select * from countries where status="A"');
        $hobbyData = DB::select('select * from hobbies where status="A"');
        $languageData = DB::select('select * from languages where status="A"');
        $this->data = array(
            'roleData'=>$roleData,
            'countryData'=>$countryData,
            'languageData'=>$languageData,
            'hobbyData'=>$hobbyData,
        );
        return view('registration',$this->data);
    }

    function registration_action(){
        $req = Request();
        $req->validate([
            'role_id'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            "mobile"=>'required|min:10|max:10',
            "country_id"=>'required',
            "state_id"=>'required',
            "city_id"=>'required',
            "image"=>'required|mimes:jpg,gif,jpeg,png',
            'password'=>'required',
            "pin_code"=>'required',
            "dob"=>"required",
            "hobby_id"=>"required",
            "address"=>"required",
            "language_id"=>"required",
            "gender"=>"required",
        ]);
        // print_r($req->input());exit;

        $hobby_id = $req->input('hobby_id');
        if(is_array($hobby_id)  && $hobby_id!="")
        $hobby_id = implode(", ",$hobby_id);

        $language_id = $req->input('language_id');
        if(is_array($language_id)  && $language_id!="")
        $language_id = implode(", ",$language_id);

        $email = $req->input('email');
        $mobile = $req->input('mobile');

        $userCheck = DB::select("select * from users where email='{$email}' OR mobile='{$mobile}'");
        if($userCheck){
            $req->session()->flash('warning','Email or mobile already exist.');
            return redirect('registration');
        }
        $md5Name = md5_file($req->file('image')->getRealPath());
        $guessExtension = $req->file('image')->guessExtension();
        // $file_name = rand(4,1000).'_'.$req->file('image')->getClientOriginalName();
        $file_name = $md5Name.'.'.$guessExtension;
        $query = DB::table('users')
        ->insert([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'mobile'=>$req->input('mobile'),
            'country_id'=>$req->input('country_id'),
            'state_id'=>$req->input('state_id'),
            'city_id'=>$req->input('city_id'),
            'role_id'=>$req->input('role_id'),
            'address'=>$req->input('address'),
            'image'=>$file_name,
            'language_id'=>$language_id,
            'hobby_id'=>$hobby_id,
            'pincode'=>$req->input('pin_code'),
            'gender'=>$req->input('gender'),
            'dob'=>$req->input('dob'),
            'status'=>'A',
            "show_password"=>$req->input('password'),
            'password'=>Hash::make($req->input('password')),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        if($query){
            echo $req->file('image')->storeAs('uploads/user_profile',$file_name);
            $req->session()->flash('success','Registration successfully.');
        }
        return redirect('/');
    }

    function get_states(Request $req){
        $country_id = $req->input('country_id');
        $stateData = DB::select("select * from states where status='A' and country_id='{$country_id}'");
        
        $html = '';
        $html .= '<option value="">Select State</option>';
        foreach ($stateData as $row) {
            ($req->input("state_id")!=="" && $req->input("state_id")==$row->id)? $selected = "selected":$selected="";
            $html .= '<option value="'.$row->id.'" '.$selected.'>'.$row->title.'</option>';
        }
        return $html;
    }

    function get_cities(Request $req){
        $state_id = $req->input('state_id');
        $cityData = DB::select("select * from cities where status='A' and state_id='{$state_id}'");
        
        $html = '';
        $html .= '<option value="">Select City</option>';
        foreach ($cityData as $row) {
             ($req->input("city_id")!=="" && $req->input("city_id")==$row->id)? $selected = "selected":$selected="";
            $html .= '<option value="'.$row->id.'" '. $selected .'>'.$row->title.'</option>';
        }
        return $html;
    }

    function dashboard(Request $req){
        if(!$req->session()->has('name')){
            return redirect('/');
        }
        return view('dashboard');
    }

    function logout(Request $req){
        DB::table('user_logs')
                ->where('id',$req->session()->get('user_log_id'))
                ->update([
                    'logout_time'=>date('Y-m-d H:i:s'),
                ]);
        $req->session()->flush();
        $req->session()->flash('success',"Logout successfully.");
        return redirect('/');
    }
}

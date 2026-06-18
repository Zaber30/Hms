<?php

namespace App\Http\Controllers\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class RequestController extends Controller
{
    //
     //
    public function create(){
        return view('doctor.request');
    }
    public function store(Request $request){
          $user=Auth::user();
          $profileImagePath=null;
          if($request->hasFile('profile_image')){
            $profileImagePath=$request->file('profile_image')
            ->store('doctor_profiles','public');
          }

          Doctor::create([
            'user_id'=>$user->id,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'qualification'=>$request->qualification,
            'experience_years'=>$request->experience_years,
            'clinic_address'=>$request->clinic_address,
            'consultation_fee'=>$request->consultation_fee,
            'bio'=>$request->bio,
            'profile_image'=>$profileImagePath,
          ]);
           $user->role='doctor';
           $user->status='pending';
           $user->save();
          return redirect()->route('doctor.request.form')->with('success','Your doctor registration request has been submitted.Please wait for admin approval');

    }
}

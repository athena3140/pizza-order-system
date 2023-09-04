<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    // To Change Password Page
    public function changePassword()
    {
        return view('admin.account.changePassword');
    }

    // Update Password
    public function updatePassword(Request $req)
    {
        $id = Auth::user()->id;
        $dbPassword = User::select('password')->where('id',$id)->first()->password; // Hash Value
        $this->passwordValidationCheck($req);

        if (Hash::check($req->oldPassword, $dbPassword)) {
            User::where('id',$id)->update([
                'password' => Hash::make($req->newPassword)
            ]);

            return back()->with(['passChangeSuccess' => 'Your password was successfully changed.']);
        } else {
            return back()->with(['status'=>'Your old password does not match our records. Please try again.']);
        }

    }


    // Profile
    public function profile()
    {
        return view('admin.account.profile');
    }

    // Edit profile
    public function edit()
    {
        return view('admin.account.edit');
    }

    // update profile {{{{  post method  }}}}
    public function update(Request $req)
    {
        $id = Auth::user()->id;
        $this->accountValidation($req);
        $data = $this->getUserData($req);

        if($req->hasFile('img')) {
            $fileName = Auth::user()->name."_".uniqid().'.'.$req->file('img')->getClientOriginalExtension();
            $oldImg = User::where('id',$id)->first()->image;

            if($oldImg != null) {
                Storage::delete('public/images/profiles/'.$oldImg);
            }

            $req->file('img')->storeAs('public/images/profiles',$fileName);
            $data['image'] = $fileName;
        }


        User::where('id',$id)->update($data);
        return redirect()->route('admin#profile')->with([
            'message' => 'Profile Updated Succesful!',
            'color' => '#1b1e21',
            'backgroundColor' => '#d6d8d9',
            'borderColor' => '#c6c8ca'
        ]);
    }

    public function list()
    {
        $lists = User::where('role', 'admin')
                ->where(function ($query) {
                    $query->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('email', 'like', '%'.request('search').'%')
                        ->orWhere('gender', 'like', '%'.request('search').'%')
                        ->orWhere('phone', 'like', '%'.request('search').'%')
                        ->orWhere('address', 'like', '%'.request('search').'%');
                })->paginate(3);
        return view('admin.account.list',compact('lists'));
    }

    public function delete($id)
    {
        $img = User::find($id)->image;
        if ($img != null) {
            Storage::delete('public/images/profiles/'.$img);
        }
        User::find($id)->delete();
        return redirect()->route('admin#lists')->with([
            'message' => 'Profile Deleted !',
            'color' => '#0f5132',
            'backgroundColor' => '#d1e7dd',
            'borderColor' => '#c3e6cb'
        ]);
    }


    public function roleChange(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill(['role' => $request->role]);
        $user->update();

        return redirect()->route('admin#lists')->with([
            'message' => 'Role Changed !',
            'color' => '#721c24',
            'backgroundColor' => '#f8d7da',
            'borderColor' => '#f5c6cb'
        ]);
    }

    public function contact()
    {
        $data = Contact::orderBy('id','desc')->paginate(5);
        return view('admin.contact',compact('data'));
    }




    // {{{  ==( PRIVATE FUNCTION )==   }}}

    // password Validation
    private function passwordValidationCheck($req)
    {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
            'confirmPassword' => 'required|same:newPassword',
        ];

        $validationMessages = [
            'newPassword.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ];

        Validator::make($req->all(),$validationRules,$validationMessages)->validate();
    }

    // request data to array
    private function getUserData(Request $req)
    {
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address,
        ];
    }

    // account update validation
    private function accountValidation(Request $req)
    {
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required|not_in:default',
            'img' => 'mimes:jpg,jpeg,png,gif,webp,svg',
            'address' => 'required'
        ];

        Validator::make($req->all(),$validationRules)->validate();
    }
}

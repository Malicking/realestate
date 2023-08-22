<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

use App\Models\User;
use App\Models\Schedule;

class UserController extends Controller
{
    public function Index () {
        return view('frontend.index');
    } // fin de la fonction


    public function userProfile () {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard.edit_profile', compact('userData'));
    } // fin de la fonction


    public function userProfileStore (Request $request) {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHi').'user'.'.'.$ext;

            if ($data->photo) {
                unlink(public_path('upload/users/'.$data->photo));
                $data['photo'] = empty($data['photo']);
            }

            // $file->move(public_path('upload/users/'), $filename);
            Image::make($file)->resize(100, 100)->save('upload/users/'.$filename);
            $data['photo'] = $filename;
        }

        if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHi').'cover'.'.'.$ext;

            // dd($data->cover_photo);

            if ($data->cover_photo) {
                unlink(public_path('upload/users/covers/'.$data->cover_photo));
                $data['cover_photo'] = empty($data['cover_photo']);
            }

            // $file->move(public_path('upload/users/covers/'), $filename);
            Image::make($file)->resize(1560, 370)->save('upload/users/covers/'.$filename);
            $data['cover_photo'] = $filename;
        }

        $data->save();

        $notif = array(
            'message' => 'Votre profil a été actualisé avec succès',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    public function userLogout (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Vous vous êtes déconnecté.',
            'alert-type' => 'info'
        );

        return redirect()->route('login')->with($notification);
    } // fin de la fonction


    public function userChangePassword () {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.change_password', compact('profileData'));
    } // fin de la fonction


    public function userUpdatePassword (Request $request) {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Entrez votre mot de passe actuel',
            'new_password.required' => 'Entrez votre nouveau mot de passe',
            'confirm_password.required' => 'Répétez le nouveau mot de passe',
            'confirm_password.confirmed' => 'Confirmez votre nouveau mot de passe',
            'confirm_password.same' => 'Ce mot de passe doit être identique au nouveau',
        ]);

        // vérifier l'exactitude du mot de passe actuel
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notif = array(
                'message' => 'Le mot de passe actuel est incorrect',
                'alert-type' => 'error'
            );
            return back()->with($notif);
        }

        // mettre à jour le mot de passe
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Votre mot de passe a été mis à jour',
            'alert-type' => 'success'
        );

        return redirect()->route('user.profile')->with($notification);

    } // fin de la fonction


    public function userScheduleRequest () {
        $auth_id = Auth::user()->id;

        $userData = User::find($auth_id);
        $schedules = Schedule::where('user_id', $auth_id)->latest()->get();

        return view('frontend.messages.schedule_request', compact('userData', 'schedules'));
    } // fin de la fonction


    // live chat
    public function LiveChat () {
        $auth_id = Auth::user()->id;
        $userData = User::find($auth_id);
        return view('frontend.dashboard.live_chat', compact('userData'));
    } // fin de la fonction 
}


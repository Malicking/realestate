<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AgentController extends Controller
{
    public function agentDashboard () {
        return view('agent.index');
    } // fin de la fonction



    public function agentLogin () {
        return view('agent.agentLogin');
    } // fin de la fonction


    public function agentRegister (Request $request) {

        $user = User::create([
            'name' => $request->name,
            'username' => strtolower(str_replace(' ', '.', $request->name)),
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);

    } // fin de la fonction


    public function agentLogout (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Vous vous êtes déconnecté.',
            'alert-type' => 'info'
        );

        return redirect()->route('agent.login')->with($notification);
    } // fin de la fonction


    public function agentProfile () {

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('agent.agentProfile', compact('profileData'));

    } // fin de la fonction


    public function agentProfileStore (Request $request) {

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
            $filename = date('YmdHi').'agent'.'.'.$ext;

            $old_url = 'upload/agents/'.$data->photo;
            $new_url = 'upload/agents/'.$filename;

            if ($data->photo) {
                unlink(public_path($old_url));
                $data['photo'] = empty($data['photo']);
            }

            Image::make($file)->resize(370, 370)->save($new_url);
            $data['photo'] = $filename;
        }
        
        if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHi').'cover'.'.'.$ext;

            $old_path = 'upload/agents/covers/'.$data->cover_photo;
            $new_path = 'upload/agents/covers/'.$filename;

            if ($data->cover_photo) {
                unlink(public_path($old_path));
                $data['cover_photo'] = empty($data['cover_photo']);
            }

            Image::make($file)->resize(1560, 370)->save($new_path);
            $data['cover_photo'] = $filename;
        }

        $data->save();

        $notif = array(
            'message' => 'Votre profil a été actualisé avec succès',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    public function agentChangePwd () {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.changePwd', compact('profileData'));
    } // fin de la fonction


    public function agentUpdatePwd (Request $request) {

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
            $notification = array(
                'message' => 'Le mot de passe actuel est incorrect',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // mettre à jour le mot de passe
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Votre mot de passe a été mis à jour',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.profile')->with($notification);

    } // fin de la fonction
}


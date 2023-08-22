<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\PackagePlan;
use App\Models\PropertyMessage;


class AdminController extends Controller
{
    public function adminDashboard () {
        return view('admin.index');
    } // fin de la fonction


    public function adminLogout (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Vous vous êtes déconnecté.',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.login')->with($notification);
    } // fin de la fonction


    public function adminLogin () {
        return view('admin.adminLogin');
    } // fin de la fonction


    public function adminProfile () {

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.adminProfile', compact('profileData'));

    } // fin de la fonction


    public function adminProfileStore (Request $request) {

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
            $filename = date('YmdHi').'admin'.'.'.$ext;

            if ($data->photo) {
                unlink(public_path('upload/admin/'.$data->photo));
                $data['photo'] = empty($data['photo']);
            }

            // $file->move(public_path('upload/admin/'), $filename);
            Image::make($file)->resize(100, 100)->save('upload/admin/'.$filename);
            $data['photo'] = $filename;
        }

        if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHi').'cover'.'.'.$ext;

            // dd($data->cover_photo);

            if ($data->cover_photo) {
                unlink(public_path('upload/admin/covers/'.$data->cover_photo));
                $data['cover_photo'] = empty($data['cover_photo']);
            }

            // $file->move(public_path('upload/admin/covers/'), $filename);
            Image::make($file)->resize(1560, 370)->save('upload/admin/covers/'.$filename);
            $data['cover_photo'] = $filename;
        }

        $data->save();

        $notif = array(
            'message' => 'Votre profil a été actualisé avec succès',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    public function adminChangePwd () {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.changePwd', compact('profileData'));
    } // fin de la fonction


    public function adminUpdatePwd (Request $request) {

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

        return redirect()->route('admin.profile')->with($notification);

    } // fin de la fonction


    // ********************** Gestion des agents **********************
    public function agentAll () {
        $agents = User::where('role', 'agent')->get();
        return view('admin.agents.agent_all', compact('agents'));
    } // fin de la fonction


    public function agentAdd () {
        return view('admin.agents.agent_add');
    } // fin de la fonction


    public function agentStore (Request $request) {

        User::insert([
            'name' => $request->name,
            'username' => strtolower(str_replace(' ', '', $request->name)),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'status' => 'inactive',
            'role' => 'agent',
        ]);
        
        $notif = array(
            'message' => 'Agent ajouté avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.all')->with($notif);

    } // fin de la fonction


    public function agentEdit ($id) {
        $agentData = User::findOrFail($id);
        return view('admin.agents.agent_edit', compact('agentData'));
    } // fin de la fonction


    public function agentUpdate (Request $request) {
        $ag_id = $request->id;

        User::findOrFail($ag_id)->update([
            'name' => $request->name,
            'username' => strtolower(str_replace(' ', '.', $request->name)),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notif = array(
            'message' => 'Les informations de l\'agent ont été actualisées avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.all')->with($notif);

    } // fin de la fonction


    public function agentDelete ($id) {

        $agentData = User::find($id);

        if (isset($agentData->photo)) {
            unlink(public_path('upload/agents/'.$agentData->photo));
        }

        if (isset($agentData->cover_photo)) {
            unlink(public_path('upload/agents/covers/'.$agentData->cover_photo));
        }

        $agentData->delete();

        $notif = array(
            'message' => 'Agent supprimé avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    // activer / désactiver un agent
    public function agentManage (Request $request) {

        $ag_id = $request->id;

        $agentData = User::find($ag_id);

        if ($agentData->status == 'active') {
            User::findOrFail($ag_id)->update([
                'status' => 'inactive',
            ]);

            $notif = array(
                'message' => 'Agent activé avec succès',
                'alert-type' => 'success'
            );
        } else {
            User::findOrFail($ag_id)->update([
                'status' => 'active',
            ]);

            $notif = array(
                'message' => 'Agent activé avec succès',
                'alert-type' => 'success'
            );
        }

        return back()->with($notif);

    } // fin de la fonction

    // // activer / désactiver un agent (méthode avec js)
    // public function changeStatus (Request $request) {

    //     $agent = User::find($request->user_id);
    //     $user->status = $request->status;
    //     $user->save();

    //     return response()->json(['success' => 'Statut modifié avec succès.']);

    // } // fin de la fonction


    // ******************* Historique des achats de forfaits *******************
    public function adminPackageHistory () {
        $packages = PackagePlan::latest()->get();
        return view('admin.packages.package_history', compact('packages'));
    } // fin de la fonction


    public function adminPackageInvoice ($id) {
        $packageData = PackagePlan::where('id', $id)->first();

        $pdf = PDF::loadView('admin.packages.package_history_invoice', compact('packageData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('facture.pdf');
    } // fin de la fonction


    // ****************************** messages ******************************
    public function allPropertyMessages () {
        $messages = PropertyMessage::orderBy('msg_status', 'ASC')->latest()->get();
        $newMsgs = PropertyMessage::where('msg_status', 0)->latest()->get();
        return view('admin.messages.message_all', compact('messages', 'newMsgs'));
    } // fin de la fonction


    public function newPropertyMessages () {
        $newMsgs = PropertyMessage::where('msg_status', 0)->latest()->get();
        $messages = PropertyMessage::orderBy('msg_status', 'ASC')->latest()->get();
        return view('admin.messages.message_news', compact('newMsgs', 'messages'));
    } // fin de la fonction


    public function detailPropertyMessages ($id) {
        $msgData = PropertyMessage::find($id);
        $newMsgs = PropertyMessage::where('msg_status', 0)->latest()->get();
        $messages = PropertyMessage::orderBy('msg_status', 'ASC')->latest()->get();
        return view('admin.messages.message_detail', compact('msgData', 'newMsgs', 'messages'));
    } // fin de la fonction


    public function adminAll () {
        $admins = User::where('role', 'admin')->orderBy('name', 'asc')->get();
        return view('admin.admins.admin_all', compact('admins'));
    } // fin de la fonction


    public function adminAdd () {
        $roles = Role::all();
        return view('admin.admins.admin_add', compact('roles'));
    } // fin de la fonction


    public function adminStore (Request $request) {

        $user = new User();

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';

        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notif = array('message' => 'Admin ajouté avec succès.', 'alert-type' => 'success');

        return redirect()->route('admin.all')->with($notif);

    } // fin de la fonction


    public function adminEdit ($id) {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.admins.admin_edit', compact('user', 'roles'));
    } // fin de la fonction


    public function adminUpdate (Request $request) {

        $id = $request->id;
        $user = User::findOrFail($id);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';

        $user->update();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notif = array('message' => 'Admin édité avec succès.', 'alert-type' => 'success');

        return redirect()->route('admin.all')->with($notif);

    } // fin de la fonction


    public function adminDelete ($id) {

        $user = User::findOrFail($id);

        if (!is_null($user)) {
            $user->delete();
        }

        $notif = array(
            'message' => 'Utilisateur supprimé avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction

}


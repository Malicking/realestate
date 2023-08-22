<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use App\Models\State;

class StateController extends Controller
{
    public function allState () {
        $states = State::orderBy('state_name', 'ASC')->get();
        return view('backend.states.state_all', compact('states'));
    } // fin de la fonction


    public function addState () {
        return view('backend.states.state_add');
    } // fin de la fonction


    public function storeState (Request $request) {

        if ($request->file('state_image')) {
            $image = $request->file('state_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/states/'.$name_gen;
            Image::make($image)->resize(370, 275)->save($save_url);
        } else {
            $save_url = '';
        }

        State::insert([
            'state_name' => $request->state_name,
            'state_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notif = array('message' => 'Région ajoutée avec succès.', 'alert-type' => 'success');

        return redirect()->route('state.all')->with($notif);

    } // fin de la fonction


    public function editState ($id) {
        $stateData = State::where('id', $id)->first();
        return view('backend.states.state_edit', compact('stateData'));
    } // fin de la fonction


    public function updateState(Request $request) {

        $state_id = $request->id;

        if ($request->file('state_image')) {
            $image = $request->file('state_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/states/'.$name_gen;

            $obj = State::findOrFail($state_id);

            if ($obj->state_image) {
                unlink(public_path($obj->state_image));
                $obj->state_image = '';
            }

            Image::make($image)->resize(370, 275)->save($save_url);

            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
                'state_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notif = array('message' => 'Région éditée avec succès.', 'alert-type' => 'success');

        return redirect()->route('state.all')->with($notif);

    } // fin de la fonction


    public function deleteState ($id) {
        $obj = State::findOrFail($id);

        if ($obj->state_image) {
            unlink(public_path($obj->state_image));
        }

        $obj->delete();

        $notif = array('message' => 'Région supprimée avec succès.', 'alert-type' => 'success');

        return back()->with($notif);
    } // fin de la fonction

}

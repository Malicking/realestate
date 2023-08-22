<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

use App\Models\Testimonial;


class TestimonialController extends Controller
{
    public function allTestimonial () {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonials.testimonial_all', compact('testimonials'));
    } // fin de la fonction


    public function addTestimonial () {
        return view('backend.testimonials.testimonial_add');
    } // fin de la fonction


    public function storeTestimonial (Request $request) {

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Entrez le nom du témoignageur',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/testimonials/'.$name_gen;
            Image::make($image)->resize(100, 100)->save($save_url);
        } else {
            $save_url = '';
        }

        Testimonial::insert([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notif = array('message' => 'Témoignage ajouté avec succès.', 'alert-type' => 'success');

        return redirect()->route('testimonial.all')->with($notif);

    } // fin de la fonction


    public function editTestimonial ($id) {
        $testimData = Testimonial::find($id);
        return view('backend.testimonials.testimonial_edit', compact('testimData'));
    } // fin de la fonction


    public function updateTestimonial (Request $request) {

        $test_id = $request->id;
        $obj = Testimonial::find($test_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/testimonials/'.$name_gen;
            Image::make($image)->resize(100, 100)->save($save_url);

            if ($obj->image) {
                unlink(public_path($obj->image));
                $obj->image = '';
            }

            Image::make($image)->resize(100, 100)->save($save_url);

            Testimonial::findOrFail($test_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Testimonial::findOrFail($test_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notif = array('message' => 'Témoignage édité avec succès.', 'alert-type' => 'success');

        return redirect()->route('testimonial.all')->with($notif);

    } // fin de la fonction


    public function deleteTestimonial ($id) {

        $obj = Testimonial::find($id);

        if ($obj->image) {
            unlink(public_path($obj->image));
        }

        $obj->delete();

        $notif = array('message' => 'Suppression effectuée.', 'alert-type' => 'success');

        return back()->with($notif);

    } // fin de la fonction
}




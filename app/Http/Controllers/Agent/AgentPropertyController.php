<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PHPUnit\Framework\Constraint\Count;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

use App\Mail\ScheduleMail;

use App\Models\Amenitie;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PackagePlan;
use App\Models\PropertyMessage;
use App\Models\State;
use App\Models\Schedule;


class AgentPropertyController extends Controller
{
    public function agentAllProperty () {
        $ag_id = Auth::user()->id;
        $properties = Property::where('agent_id', $ag_id)->latest()->get();
        return view('agent.property.property_all', compact('properties'));
    } // fin de la fonction


    public function agentAddProperty () {

        $propertyType = PropertyType::orderBy('type_name', 'ASC')->get();
        $amenities = Amenitie::orderBy('amenitie_name', 'ASC')->get();
        $states = State::orderBy('state_name', 'ASC')->get();

        $ag_id = Auth::user()->id;
        $agent = User::where(['role' => 'agent', 'id' => $ag_id])->first();
        $pcount = $agent->credit;

        if ($pcount == 1 || $pcount == 7) {
            return redirect()->route('buy.package');
        } else {
            return view('agent.property.property_add', compact('propertyType', 'amenities', 'states'));
        }

    } // fin de la fonction


    public function agentStoreProperty (Request $request) {

        $ag_id = Auth::user()->id;
        $agent = User::findOrFail($ag_id);
        $ag_credit = $agent->credit;

        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);
        // dd($amenities);

        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = 'upload/property/thumbnail/'.$name_gen;

        Image::make($image)->resize(370,250)->save($save_url);

        // sauvegarde des infos principales (table: Property)
        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'property_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // sauvegarde des images multiples (table: MultiImage)
        $images = $request->file('multi_img');

        foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $uploadPath = 'upload/property/multiImg/'.$make_name;

            Image::make($img)->resize(770, 520)->save($uploadPath);

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        // sauvegarde des avantages/portées de la propriété (table: Facility)
        $facilities = Count($request->facility_name);

        if ($facilities != NULL) {
            for ($i=0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        // actualiser le nombre de crédits de l'agent
        User::where('id', $ag_id)->update([
            // 'credit' => $ag_credit + 1,
            'credit' => DB::raw('1 + '.$ag_credit),
        ]);

        $notif = array(
            'message' => 'Propriété ajoutée avec succès.',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.property.all')->with($notif);

    } // fin de la fonction


    public function agentDetailProperty ($id) {
        $propertyData = Property::where('id', $id)->first();
        $multiImg = MultiImage::where('property_id', $id)->get();
        $facilities = Facility::where('property_id', $id)->get();

        $propertyType = PropertyType::orderBy('type_name', 'ASC')->get();
        $amenities = Amenitie::orderBy('amenitie_name', 'ASC')->get();
        $agents = User::where(['role' => 'agent', 'status' => 1])->latest()->get();

        $type = $propertyData->amenities_id;
        $property_ami = explode(',', $type);

        return view('agent.property.property_detail', compact('propertyData', 'multiImg', 'facilities', 'amenities', 'agents', 'property_ami', 'propertyType'));
    } // fin de la fonction


    public function agentEditProperty ($id) {

        $propertyData = Property::findOrFail($id);

        $type = $propertyData->amenities_id;
        $property_ami = explode(',', $type);

        $facilities = Facility::where('property_id', $id)->get();

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenitie::latest()->get();
        $agents = User::where(['role' => 'agent', 'status' => 'active'])->get();
        $states = State::orderBy('state_name', 'ASC')->get();

        $multiImg = MultiImage::where('property_id', $propertyData->id)->get();

        return view('agent.property.property_edit', compact('propertyData', 'propertyType', 'amenities', 'agents', 'property_ami', 'multiImg', 'facilities', 'states'));
    } // fin de la fonction


    public function agentUpdateProperty (Request $request) {

        $prop_id = $request->id;

        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);

        $obj = Property::find($prop_id);
        // dd($obj);

        $multiImg = MultiImage::where('property_id', $obj->id)->get();

        $obj->ptype_id = $request->ptype_id;
        $obj->amenities_id = $amenities;
        $obj->property_name = $request->property_name;
        $obj->property_slug = strtolower(str_replace(' ', '-', $request->property_name));
        $obj->property_status = $request->property_status;

        $obj->lowest_price = $request->lowest_price;
        $obj->max_price = $request->max_price;
        $obj->short_desc = $request->short_desc;
        $obj->long_desc = $request->long_desc;
        $obj->bedrooms = $request->bedrooms;
        $obj->bathrooms = $request->bathrooms;
        $obj->garage = $request->garage;
        $obj->garage_size = $request->garage_size;

        $obj->property_size = $request->property_size;
        $obj->property_video = $request->property_video;
        $obj->address = $request->address;
        $obj->city = $request->city;
        $obj->state_id = $request->state_id;
        $obj->postal_code = $request->postal_code;

        $obj->neighborhood = $request->neighborhood;
        $obj->latitude = $request->latitude;
        $obj->longitude = $request->longitude;
        $obj->featured = $request->featured;
        $obj->hot = $request->hot;
        $obj->agent_id = Auth::user()->id;

        if ($request->file('property_thumbnail')) {
            $image = $request->file('property_thumbnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_url = 'upload/property/thumbnail/'.$name_gen;

            if ($obj->property_thumbnail) {
                unlink(public_path($obj->property_thumbnail));
                $obj->property_thumbnail = '';
            }

            Image::make($image)->resize(370,250)->save($save_url);
            $obj->property_thumbnail = $save_url;
        }

        $obj->update();

        $notif = array(
            'message' => 'Propriété actualisée avec succès.',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.property.all')->with($notif);

    } // fin de la fonction


    public function agentDeleteProperty ($id) {

        $obj = Property::find($id);
        $multiImg = MultiImage::where('property_id', $id)->get();
        $facilities = Facility::where('property_id', $id)->get();

        if ($obj->property_thumbnail) {
            unlink(public_path($obj->property_thumbnail));
        }

        if ($multiImg != NULL) {
            foreach ($multiImg as $img) {
                unlink(public_path($img->photo_name));
                $img->delete();
            }
        }

        if ($facilities != NULL) {
            foreach ($facilities as $item) {
                $item->delete();
            }
        }

        $obj->delete();

        $notif = array(
            'message' => 'Propriété supprimée avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    public function agentManagePropertyStatus (Request $request) {

        $prop_id = $request->id;

        $obj = Property::find($prop_id);

        if ($obj->status == 1) {
            Property::findOrFail($prop_id)->update([
                'status' => 0,
            ]);

            $notif = array(
                'message' => 'Propriété désactivée avec succès',
                'alert-type' => 'success'
            );
        } else {
            Property::findOrFail($prop_id)->update([
                'status' => 1,
            ]);

            $notif = array(
                'message' => 'Propriété activée avec succès',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('agent.property.all')->with($notif);

    } // fin de la fonction


    public function agentUpdatePropertyThumbnail (Request $request) {

            $prop_id = $request->id;
            $propData = Property::find($prop_id);

            if (isset($propData->property_thumbnail)) {
                unlink(public_path($propData->property_thumbnail));
                $propData->property_thumbnail = '';
            }

            $ext = $request->file('property_thumbnail')->getClientOriginalExtension();
            $filename = hexdec(uniqid()).'.'.$ext;

            $filePath ='upload/property/'.$filename;

            Image::make($request->property_thumbnail)->resize(100, 100)->save($filePath);

            Property::findOrFail($prop_id)->update([
                'property_thumbnail' => $filePath,
                'updated_at' => Carbon::now(),
            ]);

            $notif = array(
                'message' => 'Image principale modifiée avec succès.',
                'alert-type' => 'success'
            );

            return back()->with($notif);

    } // fin de la fonction


    // ******************** gestion des images multiples ********************
    public function agentUpdateMultiImg (Request $request) {

        $imgs = $request->multi_img;

        if ($imgs != NULL) {
            foreach ($imgs as $id => $img) {

                $imgDel = MultiImage::findOrFail($id);

                if ($imgDel->photo_name) {
                    unlink($imgDel->photo_name);
                    $imgDel->photo_name = '';
                }

                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $uploadPath = 'upload/property/multiImg/'.$make_name;
                Image::make($img)->resize(770, 520)->save($uploadPath);

                MultiImage::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);
            }

            $notif = array(
                'message' => 'Les images de la propriété ont été actualisées',
                'alert-type' => 'success'
            );

        } else {
            $notif = array(
                'message' => 'Vous devez charger une nouvelle image.',
                'alert-type' => 'warning'
            );
        }

        return back()->with($notif);

    } // fin de la fonction


    public function agentDeleteMultiImg ($id) {

        $image = MultiImage::findOrFail($id);

        if ($image->photo_name) {
            unlink($image->photo_name);
        }

        $image->delete();

        $notif = array(
            'message' => 'Image supprimée avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    public function agentStoreMultiImg (Request $request) {

        $prop_id = $request->id;
        $images = $request->multi_img;

        foreach ($images as $img) {
            $ext = $img->getClientOriginalExtension();
            $name = hexdec(uniqid()).'.'.$ext;
            $save_url = 'upload/property/multiImg/'.$name;

            Image::make($img)->resize(770, 520)->save($save_url);

            MultiImage::insert([
                'property_id' => $prop_id,
                'photo_name' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        $notif = array(
            'message' => 'Images ajoutés avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    // ************* gestion des facilities (portée/avantage) *************
    public function updateFacilities (Request $request) {

        $prop_id = $request->id;

        if ($request->facility_name == NULL) {
            return back();
        } else {
            Facility::where('property_id', $prop_id)->delete();

            $facilities = Count($request->facility_name);

            for ($i=0; $i < $facilities; $i++) {
                $fcount = new Facility();

                $fcount->property_id = $prop_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];

                $fcount->save();
            }

            $notif = array(
                'message' => 'Avantages actualisés avec succès.',
                'alert-type' => 'success'
            );

            return back()->with($notif);
        }

    } // fin de la fonction



    // *********************** Achat de forfait ***********************
    public function buyPackage () {
        return view('agent.package.buy_package');
    } // fin de la fonction


    public function buyBusinessPlan () {
        $ag_id = Auth::user()->id;
        $agent = User::where('id', $ag_id)->first();
        return view('agent.package.business_plan', compact('agent'));
    } // fin de la fonction


    // ---------------------- forfait business ----------------------
    public function storeBusinessPlan (Request $request) {

        $ag_id = Auth::user()->id;
        $agent = User::findOrFail($ag_id);
        $pcount = $agent->credit;

        PackagePlan::insert([
            'user_id' => $ag_id,
            'package_name' => 'Business',
            'invoice' => 'MR'.mt_rand(1000000000, 99999999999),
            'package_credits' => '3',
            'package_amount' => '20',
            'created_at' => Carbon::now(),
        ]);

        User::where('id', $ag_id)->update([
            'credit' => DB::raw('3 + '.$pcount),
        ]);

        $notif = array(
            'message' => 'Vous avez acheté le forfait de base avec succès.',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.property.all')->with($notif);

    } // fin de la fonction


    // ---------------------- forfait professionnel ----------------------
    public function buyProfessionalPlan () {
        $ag_id = Auth::user()->id;
        $agent = User::where('id', $ag_id)->first();
        return view('agent.package.professional_plan', compact('agent'));
    } // fin de la fonction


    public function storeProfessionalPlan (Request $request) {

        $ag_id = Auth::user()->id;
        $agent = User::findOrFail($ag_id);
        $pcount = $agent->credit;

        PackagePlan::insert([
            'user_id' => $ag_id,
            'package_name' => 'Professional',
            'invoice' => 'MR'.mt_rand(1000000000, 99999999999),
            'package_credits' => '10',
            'package_amount' => '50',
            'created_at' => Carbon::now(),
        ]);

        User::where('id', $ag_id)->update([
            'credit' => DB::raw('10 + '.$pcount),
        ]);

        $notif = array(
            'message' => 'Vous avez acheté le forfait professionnel avec succès.',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.property.all')->with($notif);

    } // fin de la fonction


    // *************** Historique d'achat de forfait par l'agent ***************
    public function packageHistory () {

        $ag_id = Auth::user()->id;
        $packages = PackagePlan::where('user_id', $ag_id)->get();

        return view('agent.package.package_history', compact('packages'));

    } // fin de la fonction


    public function packageInvoice ($id) {
        $packageData = PackagePlan::where('id', $id)->first();

        $pdf = PDF::loadView('agent.package.package_history_invoice', compact('packageData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('facture.pdf');
    } // fin de la fonction


    // ********************** envoie de message à l'agent **********************
    public function agentPropertyMessage () {
        $ag_id = Auth::user()->id;

        // tous les messages
        $messages = PropertyMessage::where('agent_id', $ag_id)
                                    ->orderBy('msg_status', 'ASC')->latest()->get();

        // messages non lus
        $newMsgs = PropertyMessage::where(['agent_id' => $ag_id, 'msg_status' => 0])->get();

        return view('agent.message.message_all', compact('messages', 'newMsgs'));
    } // fin de la fonction


    public function agentPropertyNewMessages () {
        $ag_id = Auth::id();
        $newMsgs = PropertyMessage::where(['agent_id' => $ag_id, 'msg_status' => 0])
                                    ->latest()->get();
        $messages = PropertyMessage::where('agent_id', $ag_id)->get();
        return view('agent.message.new_messages', compact('newMsgs', 'messages'));
    } // fin de la fonction


    public function agentPropertyMessageDetail ($id) {

        $ag_id = Auth::user()->id;
        $msgData = PropertyMessage::where('id', $id)->first();

        // tous les messages
        $messages = PropertyMessage::where('agent_id', $ag_id)
                                    ->orderBy('msg_status', 'ASC')->latest()->get();

        // messages non lus
        $newMsgs = PropertyMessage::where(['agent_id' => $ag_id, 'msg_status' => 0])->get();

        // marquer le message comme lu
        PropertyMessage::findOrFail($msgData->id)->update([
            'msg_status' => 1,
        ]);

        return view('agent.message.message_detail', compact('msgData', 'messages', 'newMsgs'));

    } // fin de la fonction


    public function agentScheduleRequest () {
        $id = Auth::user()->id;
        $userMsg = Schedule::where('agent_id', $id)->orderBy('status', 'asc')->get();
        return view('agent.schedule.schedule_request', compact('userMsg'));
    } // fin de la fonction


    public function agentScheduleDetails ($id) {
        $schedule = Schedule::findOrFail($id);
        // dd($schedule->users->email);
        return view('agent.schedule.schedule_detail', compact('schedule'));
    } // fin de la fonction


    public function agentScheduleUpdate (Request $request) {

        $sch_id = $request->id;

        Schedule::findOrFail($sch_id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        
        // Envoi d'email à l'expéditeur de la requête (start)
        $sendmail = Schedule::findOrFail($sch_id);

        $data = [
            'tour_date' => $sendmail->tour_date,
            'tour_time' => $sendmail->tour_time,
        ];

        Mail::to($request->email)->send(new ScheduleMail($data));
        // Envoi d'email à l'expéditeur de la requête (end)

        $notif = array('message' => 'Visite confirmée avec succès.', 'alert-type' => 'success');

        return redirect()->route('agent.property.schedule.request')->with($notif);

    } // fin de la fonction

}


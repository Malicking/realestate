<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenitie;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Compare;
use App\Models\PropertyMessage;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\Schedule;

class FrontEndController extends Controller
{
    public function propertyDetail ($id, $slug) {
        $propData = Property::where(['id' => $id, 'property_slug' => $slug])->first();
        $multiImgs = MultiImage::where('property_id', $propData->id)->get();

        $amenities = explode(',', $propData->amenities_id);

        $facilities = Facility::where('property_id', $propData->id)->get();

        $t_id = $propData->ptype_id;
        $ag_id = $propData->agent_id;
        $similarProps = Property::where('ptype_id', $t_id)
                                ->orWhere('agent_id', $ag_id)
                                ->having('id', '!=', $id)
                                ->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.properties.property_detail', compact('propData', 'multiImgs', 'amenities', 'similarProps', 'facilities'));
    } // fin de la fonction propertyDetail



    // ********************************** Wishlist **********************************
    // public function addToWishList (Request $request, $property_id) {

    //     if (Auth::check()) {
    //         $exists = Wishlist::where('user_id', Auth::id())
    //                             ->where('property_id', $property_id)->first();

    //         if (!$exists) {
    //             Wishlist::insert([
    //                 'user_id' => Auth::id(),
    //                 'property_id' => $property_id,
    //                 'created_at' => Carbon::now(),
    //             ]);

    //             return response()->json(['success' => 'Propriété ajoutée dans votre liste de souhaits.']);
    //         } else {
    //             return response()->json(['error' => 'Vous avez déjà ajouté cette propriété dans votre liste de souhaits.']);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Vous devez vous connecter d\'abord.']);
    //     }

    // } // fin de la fonction


    public function addToWishlist (Request $request, $p_id) {

        if (Auth::check()) {
            $u_id = Auth::id();

            $exists = Wishlist::where(['user_id' => $u_id, 'property_id' => $p_id])->first();

            if (isset($exists)) {

                $notif = array(
                    'message' => 'Vous avez déjà ajouté cette propriété à votre liste.', 'alert-type' => 'info'
                );
                return back()->with($notif);

            } else {
                Wishlist::insert([
                    'user_id' => $u_id,
                    'property_id' => $p_id,
                    'created_at' => Carbon::now(),
                ]);

                $notif = array(
                    'message' => 'Propriété ajoutée avec succès, à votre liste de souhaits',
                    'alert-type' => 'success'
                );
                return back()->with($notif);
            }
        } else {
            $notif = array(
                'message' => 'Vous devez être connecté d\'abord.',
                'alert-type' => 'error'
            );
            return back()->with($notif);
        }

    } // fin de la fonction


    public function removeFromWishlist ($p_id) {
        if (Auth::check()) {
            $u_id = Auth::user()->id;

            $wishData = Wishlist::where(['user_id' => $u_id, 'property_id' => $p_id])->first();
            $wishData->delete();

            $notification = array(
                'messge' => 'Propriété supprimé avec succès, de votre wishlist.',
                'alert-type' => 'success'
            );

            return back()->with($notification);

        } else {
            $notification = array(
                'message' => 'Veuillez vous connecter.',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }

    } // fin de la fonction


    public function userWishlist () {

        if (Auth::check()) {
            $id = Auth::user()->id;
            $wishlist = Wishlist::with('Properties')->where('user_id', $id)->latest()->get();
            return view('frontend.dashboard.wishlist', compact('wishlist'));

        } else {

            $notification = array(
                'message' => 'Vous devez être connecté.',
                'alert-type' => 'warning',
            );
            return back()->with($notification);
        }

    } // fin de la fonction


    // ****************************** Comparaison ******************************
    public function addCompare ($p_id) {
        if (Auth::id()) {

            $u_id = Auth::id();
            $exists = Compare::where(['user_id' => $u_id, 'property_id' => $p_id])->first();

            if (isset($exists)) {
                $notif = array(
                    'message' => 'Cette comparaison existe déjà.',
                    'alert-type' => 'warning'
                );
                return back()->with($notif);

            } else {
                // ajouter à la table Compare
                Compare::insert([
                    'user_id' => $u_id,
                    'property_id' => $p_id,
                    'created_at' => Carbon::now(),
                ]);

                $notif = array(
                    'message' => 'Propriété ajoutée avec succès, dans votre liste de comparaison.',
                    'alert-type' => 'success'
                );

                return back()->with($notif);
            }

        } else {
            $notif = array('message' => 'Vous devez être connecté.', 'alert-type' => 'warning');
            return back()->with($notif);
        }

    } // fin de la fonction


    public function removeCompare ($id) {
        if (Auth::id()) {
            $u_id = Auth::id();
            $compare = Compare::where(['user_id' => $u_id, 'id' => $id])->delete();

            $notif = array(
                'message' => 'Comparaison supprimée avec succès.',
                'alert-type' => 'success'
            );

            return back()->with($notif);

        } else {
            $notification = array(
                'message' => 'Vous devez être connecté.', 'alert-type' => 'success'
            );
            return back()->with($notification);
        }

    } // fin de la fonction


    public function userCompare () {
        $u_id = Auth::id();
        $compare = Compare::with('property')->where('user_id', $u_id)->latest()->limit(3)->get();
        return view('frontend.dashboard.compare');
    } // fin de la fonction



    // Envoie de message à partir de la page de détail d'un propriété
    public function propertyMessage (Request $request) {

        $request->validate([
            'msg_name' => 'required',
            'message' => 'required',
        ], [
            'msg_name.required' => 'Veuillez donnez l\'intitulé de votre message',
            'message.required' => 'Veuillez entrer votre message',
        ]);

        if (!Auth::id()) {
            $notif = array(
                'message' => 'Vous devez avoir un compte, pour envoyé de message.',
                'alert-type' => 'warning'
            );
            return back()->with($notif);

        } else {
            PropertyMessage::insert([
                'user_id' => Auth::id(),
                'agent_id' => $request->agent_id,
                'property_id' => $request->property_id,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'msg_status' => 0,
                'created_at' => Carbon::now(),
            ]);

            $notif = array(
                'message' => 'Message envoyé avec succès.',
                'alert-type' => 'success'
            );
            return back()->with($notif);
        }

    } // fin de la fonction


    // ********************* Détails sur un agent *********************
    public function agentDetails ($id) {

        $agent = User::find($id);
        $agentProperties = Property::where('agent_id', $id)->latest()->get();
        $rentProps = Property::where('property_status', 'A louer')->get();
        $buyProps = Property::where('property_status', 'A vendre')->get();

        return view('frontend.agents.agent_detail',compact('agent', 'agentProperties', 'rentProps', 'buyProps'));

    } // fin de la fonction


    public function agentDetailsMessage (Request $request) {

        $request->validate([
            'msg_name' => 'required',
            'message' => 'required',
        ], [
            'msg_name.required' => 'Veuillez donnez l\'intitulé de votre message',
            'message.required' => 'Veuillez entrer votre message',
        ]);

        $ag_id = $request->agent_id;

        if (Auth::check()) {
            PropertyMessage::insert([
                'user_id' => Auth::user()->id,
                'agent_id' => $ag_id,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            $notif = array(
                'message' => 'Message envoyé avec succès.',
                'alert-type' => 'success'
            );
            return back()->with($notif);
        }

    } // fin de la fonction


    public function rentProperties () {
        $rentProps = Property::where(['status' => 1, 'property_status' => 'A louer'])
                            ->latest()->paginate(2);
        return view('frontend.properties.property_rent', compact('rentProps'));
    } // fin de la fonction


    public function buyProperties () {
        $buyProps = Property::where(['status' => 1, 'property_status' => 'A vendre'])
                            ->latest()->paginate(2);
        return view('frontend.properties.property_buy', compact('buyProps'));
    } // fin de la fonction


    // l'ensemble des propriétés d'un type donné*
    public function propertyType ($id) {
        $propsType = Property::where(['ptype_id' => $id, 'status' => 1])->paginate(2);
        return view('frontend.properties.property_type', compact('propsType'));
    } // fin de la fonction


    // l'ensemble des propriétés d'une région donnée
    public function stateDetails ($id) {
        $propsState = Property::where(['status' => 1, 'state_id' => $id])->paginate(2);
        return view('frontend.properties.state_details', compact('propsState'));
    } // fin de la fonction


    public function buyPropertySearch (Request $request) {

        $request->validate([
            'search' => 'required'
        ], [
            'search.required' => 'Renseignez le champ ci-dessus',
        ]);

        $item = $request->search;
        $sstate = $request->state_id;
        $sptype = $request->ptype_id;

        $property = Property::where('property_name', 'like', '%'.$item.'%')
                            ->where('property_status', 'A vendre')->with('Types', 'States')
                            ->whereHas('States', function ($q) use ($sstate) {
                                $q->where('state_name', 'like', '%'.$sstate.'%');
                            })->whereHas('Types', function ($q) use ($sptype) {
                                $q->where('type_name', 'like', '%'.$sptype.'%');
                            })->get();

        return view('frontend.properties.property_search', compact('property'));

    } // fin de la fonction


    public function rentPropertySearch (Request $request) {

        $request->validate([
            'search' => 'required',
        ], [
            'search.required' => 'Renseignez le champ ci-dessus',
        ]);

        $item = $request->search;
        $sstate = $request->state_id;
        $sptype = $request->ptype_id;

        $property = Property::where('property_name', 'like', '%'.$item.'%')
                            ->where('property_status', 'A louer')->with('Types', 'States')
                            ->whereHas('States', function ($q) use ($sstate) {
                                $q->where('state_name', 'like', '%'.$sstate.'%');
                            })->whereHas('Types', function ($q) use ($sptype) {
                                $q->where('type_name', 'like', '%'.$sptype.'%');
                            })->get();

        return view('frontend.properties.property_search', compact('property'));

    } // fin de la fonction


    public function allPropertySearch (Request $request) {

        $spstatus = $request->property_status;
        $sptype = $request->ptype_id;
        $sstate = $request->state_id;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;

        $property = Property::where('status', 1)->where('property_status', $spstatus)
                            ->where('bedrooms', 'like', '%'.$bedrooms.'%')
                            ->where('bathrooms', 'like', '%'.$bathrooms.'%')
                            ->with('Types', 'States')
                            ->whereHas('States', function ($q) use ($sstate) {
                                $q->where('state_name', 'like', '%'.$sstate.'%');
                            })->whereHas('Types', function ($q) use ($sptype) {
                                $q->where('type_name', 'like', '%'.$sptype.'%');
                            })->get();

        return view('frontend.properties.property_search', compact('property'));

    } // fin de la fonction



    // ********************************** blog **********************************
    public function postAll () {
        $posts = BlogPost::latest()->paginate(6);
        $categories = BlogCategory::orderBy('category_name', 'asc')->get();
        $lastPosts = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.post_all', compact('posts', 'categories', 'lastPosts'));
    } // fin de la fonction


    public function postDetail ($slug) {

        $postData = BlogPost::where('post_slug', $slug)->first();
        $categories = BlogCategory::orderBy('category_name', 'asc')->get();
        $tags = explode(',', $postData->post_tags);
        $lastPosts = BlogPost::latest()->limit(3)->get();

        // dd($responses);

        return view('frontend.blog.post_detail', compact('postData', 'tags', 'categories', 'lastPosts'));

    } // fin de la fonction


    public function postCategory ($id) {
        $posts = BlogPost::where('blogcat_id', $id)->latest()->paginate(6);
        $categories = BlogCategory::orderBy('category_name', 'asc')->get();
        $lastPosts = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.post_category', compact('posts','categories', 'lastPosts'));
    } // fin de la fonction


    public function blogStoreComment (Request $request) {

        $p_id = $request->post_id;
        $u_id = Auth::user()->id;

        Comment::insert([
            'user_id' => $u_id,
            'post_id' => $p_id,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notif = array(
            'message' => 'Votre commentaire a été posté avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    public function storeSchedule (Request $request) {

        $ag_id = $request->agent_id;
        $p_id = $request->property_id;

        if (Auth::check()) {

            Schedule::insert([
                'user_id' => Auth::user()->id,
                'property_id' => $p_id,
                'agent_id' => $ag_id,
                'tour_date' => $request->tour_date,
                'tour_time' => $request->tour_time,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            $notif = array(
                'message' => 'Visite programmée avec succès.',
                'alert-type' => 'success'
            );

            return back()->with($notif);

        } else {
            $notif = array('message' => 'Veuillez vous connecter.', 'alert-type' => 'error');
            return back()->with($notif);
        }

    } // fin de la fonction
}



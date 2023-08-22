<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenitie;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function allPropertiesType () {
        $types = PropertyType::latest()->get();
        return view('backend.property_types.type_all', compact('types'));
    } // fin de la fonction 


    public function addPropertyType () {
        return view('backend.property_types.type_add');
    } // fin de la fonction 

    
    public function storePropertyType (Request $request) {
        
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ], [
            'type_name.required' => 'Entrez le type de propriété',
            'type_name.unique' => 'Ce type existe déjà',
            'type_name.max' => 'Le type ne peut contenir au maximum 200 que caractères',
            'type_icon.required' => 'Entrez une icône illustrative du type',
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notif = array(
            'message' => 'Type de propriété ajouté avec succès', 
            'alert-type' => 'success'
        );

        return redirect()->route('property.type.all')->with($notif);

    } // fin de la fonction 


    public function editPropertyType ($id) {
        $typeData = PropertyType::findOrFail($id);
        return view('backend.property_types.type_edit', compact('typeData'));
    } // fin de la fonction 


    public function updatePropertyType (Request $request) {
        
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ], [
            'type_name.required' => 'Entrez le type de propriété',
            'type_name.unique' => 'Ce type existe déjà',
            'type_name.max' => 'Le type ne peut contenir au maximum 200 que caractères',
            'type_icon.required' => 'Entrez une icône illustrative du type',
        ]);

        $id = $request->id;

        PropertyType::findOrFail($id)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notif = array(
            'message' => 'Type de propriété édité avec succès', 
            'alert-type' => 'success'
        );

        return redirect()->route('property.type.all')->with($notif);

    } // fin de la fonction
    
    
    public function deletePropertyType ($id) {

        PropertyType::find($id)->delete();

        $notif = array(
            'message' => 'Type supprimé avec succès', 
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    // ************************ Aminities ************************
    public function allAmenities () {
        $amenities = Amenitie::latest()->get();
        return view('backend.amenities.amenities_all', compact('amenities'));
    } // fin de la fonction


    public function addAmenities () {
        return view('backend.amenities.amenities_add');
    } // fin de la fonction 


    public function storeAmenities (Request $request) {
        
        $request->validate([
            'amenitie_name' => 'required|unique:amenities|max:100',
        ], [
            'amenitie_name.required' => 'Entrez le nom de l\'aménité',
            'amenitie_name.unique' => 'Cette aménité est déjà listée',
            'amenitie_name.max' => 'La taille de l\'aménité ne doit pas dépasser 100 caractères',
        ]);

        Amenitie::insert([
            'amenitie_name' => $request->amenitie_name,
        ]);

        $notif = array(
            'message' => 'Amenitie ajoutée avec succès', 
            'alert-type' => 'success'
        );
        
        return redirect()->route('amenities.all')->with($notif);
        
    } // fin de la fonction 


    public function editAmenities ($id) {
        $amenitieData = Amenitie::find($id);
        return view('backend.amenities.amenities_edit', compact('amenitieData'));
    } // fin de la fonction


    public function updateAmenities (Request $request) {
        
        $request->validate([
            'amenitie_name' => 'required|unique:amenities|max:100',
        ], [
            'amenitie_name.required' => 'Entrez le nom de l\'aménité',
            'amenitie_name.unique' => 'Cette aménité est déjà listée',
            'amenitie_name.max' => 'La taille de l\'aménité ne doit pas dépasser 100 caractères',
        ]);
        
        $id = $request->id;

        Amenitie::find($id)->update([
            'amenitie_name' => $request->amenitie_name,
        ]);

        $notif = array(
            'message' => 'Amenitie éditée avec succès', 
            'alert-type' => 'success'
        );
        
        return redirect()->route('amenities.all')->with($notif);

    } // fin de la fonction

    
    public function deleteAmenities ($id) {
        
        Amenitie::find($id)->delete();

        $notif = array(
            'message' => 'Amenitie supprimée avec succès', 
            'alert-type' => 'success'
        );

        return back()->with($notif);
    } // fin de la fonction
}


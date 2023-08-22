<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

use App\Models\SmtpSetting;
use App\Models\SiteSetting;

class SettingController extends Controller
{
    // ------****---- paramètrage du SMTP ------****----
    public function smtpSetting () {
        $setting = SmtpSetting::first();
        return view('backend.settings.smtp_update', compact('setting'));
    } // fin de la fonction


    public function smtpUpdate (Request $request) {

        $smtp_id = $request->id;

        SmtpSetting::findOrFail($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
            'updated_at' => Carbon::now(),
        ]);

        $notif = array(
            'message' => 'Paramètres SMTP actualisés avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction


    // ------****----- paramètrage des infos générales ------****-----
    public function siteSetting () {
        $setting = SiteSetting::first();
        return view('backend.settings.site_update', compact('setting'));
    } // fin de la fonction


    public function siteUpdate (Request $request) {

        $site_id = $request->id;

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$logo->getClientOriginalExtension();
            $save_url = 'upload/site/'.$name_gen;

            Image::make($logo)->resize(370, 275)->save($save_url);

            SiteSetting::findOrFail($site_id)->update([
                'logo' => $save_url,
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'updated_at' => Carbon::now(),
            ]);

        } else {
            SiteSetting::findOrFail($site_id)->update([
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'updated_at' => Carbon::now(),
            ]);
        }
        
        $notif = array(
            'message' => 'Infos du site mises à jour avec succès.',
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction
}


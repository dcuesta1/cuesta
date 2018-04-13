<?php

namespace Api\Http\Controllers;

use Api\Exceptions\{ModelNotFoundException, BadInputException};
use Api\{Settings, User};
use Illuminate\Http\Request;
use Input, Validator;

class SettingsController extends Controller
{
    public function all()
    {
        $allSettings = Settings::all();

        return $allSettings;
    }

    public function get(Settings $settings)
    {
        return $settings;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'business_name' => 'required|max:191',
            'business_email' => 'required|unique:settings|email',
            'business_phone' => 'required|max:191',
            'plan' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'fee' => 'nullable|numeric',
        ]);

        #TODO: make sure that plan types cannot be manipulated
        $settings = new Settings($request->all());
        $settings->save();

        return $settings;
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Settings $settings)
    {
        return ['success' => $settings->delete()];
    }

}
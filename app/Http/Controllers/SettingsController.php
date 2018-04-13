<?php

namespace App\Http\Controllers;

use App\Exceptions\{ModelNotFoundException, BadInputException};
use App\{Settings, User};
use Illuminate\Http\Request;
use Input, Validator;

class SettingsController extends Controller
{
    public function all()
    {
        $allSettings = Settings::all();

        return $allSettings;
    }

    public function get(User $user)
    {
        $user = $this->user()->isSuperuser() ? $user : $this->user();
        $settings = $user->settings;

        return $settings;
    }

    public function store(Request $request, User $user)
    {
    }

    public function update(Request $request, User $user)
    {
        $user = $this->user()->isSuperuser() ? $user : $this->user();

        $this->validate($request, [
            'business_name' => 'required|max:191',
            'business_email' => 'required|unique:settings|email',
            'business_phone' => 'required|max:191',
            'plan' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'fee' => 'nullable|numeric',
        ]);

        $settings = $user->settings;
        $settings->update($request->all());
        $settings->save();

        return $settings;
    }

    public function destroy(Settings $settings)
    {
        return ['success' => $settings->delete()];
    }

}
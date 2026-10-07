<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function profile()
    {
        return view('seller-profile');
    }

    public function listings()
    {
        return view('seller-listings');
    }

    public function createListing()
    {
        return view('create-listings');
    }

    public function messages()
    {
        return view('seller-messages');
    }

    public function settings()
    {
        return view('seller-settings');
    }

    public function settingsContact()
    {
        return view('seller-settings-contact');
    }

    public function settingsSecurity()
    {
        return view('seller-settings-security');
    }

    public function settingsNotifications()
    {
        return view('seller-settings-notifications');
    }

    public function settingsAccount()
    {
        return view('seller-settings-account');
    }

    public function favorites()
    {
        return view('favorites');
    }
}

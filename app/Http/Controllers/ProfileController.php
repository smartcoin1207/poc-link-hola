<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Symfony\Component\VarDumper\VarDumper;

class ProfileController extends Controller
{
    /**
     * ユーザーのプロフィールフォームを表示します。
     */
    public function edit(Request $request): View
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $exist_detailed_account = false;
        if ($user->userProfile()->exists()) {
            $exist_detailed_account = true;
        }

        $detailed_account = $user->userProfile()->first();
        
        return view('profile.edit', [
            'user' => $request->user(),
            'exist_detailed_account' => $exist_detailed_account,
            'detailed_account' => $detailed_account
        ]);
    }

    /**
     * ユーザーのプロフィール情報を更新します。
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ];

        if ($user->email !== $request->email) {
            $data['email_verified_at'] = null;
        }

        $user->update($data);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * ユーザーのプロフィール情報を更新します。
     */
    public function updateDetailed(Request $request):RedirectResponse
    {
        $request->validate([ 
            'project_implemented_type' => ['array'],
            'project_implemented_type.*' => ['string', 'in:project_bike,project_solar'],
            'coporate_type' => ['required', 'string', 'in:application,credit'],
            'corporate_number' => ['required', 'string', 'max:255'],
            'corporate_name' => ['required', 'string', 'max:255'],
            'representative_title' => ['required', 'string', 'max:255'],
            'representative_name' => ['required', 'string', 'max:255'],
            'main_phone_number' => ['required', 'string', 'max:15'],
            'postal_code' => ['required', 'string', 'max:10'],
            'prefecture' => ['required', 'string', 'max:255'],
            'city_town' => ['required', 'string', 'max:255'],
            'address_beyond_city_town' => ['required', 'string', 'max:255'],
            'other_credit_history' => ['nullable', 'string'],
            'corporate_account_registration_date' => ['required', 'date'],
            'department_name' => ['required', 'string', 'max:255'],
            'personal_title' => ['required', 'string', 'max:255'],
            'personal_name' => ['required', 'string', 'max:255'],
            'contact_phone_number' => ['required', 'string', 'max:15'],
            'email_address' => ['required', 'string', 'email', 'max:255'],
        ]);

        $AuthUser = Auth::user();
        $userId = $AuthUser->id;
        $user = User::find($userId);

        if (!$user->userProfile()->exists()) {
            // ユーザーに関連付けられたユーザー情報を作成する
            $user->userProfile()->create([
                'project_implemented_type' => $request->project_implemented_type ? json_encode($request->project_implemented_type) : json_encode([]),
                'coporate_type' => $request->coporate_type,
                'corporate_number' => $request->corporate_number,
                'corporate_name' => $request->corporate_name,
                'representative_title' => $request->representative_title,
                'representative_name' => $request->representative_name,
                'main_phone_number' => $request->main_phone_number,
                'postal_code' => $request->postal_code,
                'prefecture' => $request->prefecture,
                'city_town' => $request->city_town,
                'address_beyond_city_town' => $request->address_beyond_city_town,
                'other_credit_history' => $request->other_credit_history ?: "",
                'corporate_account_registration_date' => $request->corporate_account_registration_date,
                'department_name' => $request->department_name,
                'personal_title' => $request->personal_title,
                'personal_name' => $request->personal_name,
                'contact_phone_number' => $request->contact_phone_number,
                'email_address' => $request->email_address,
                'project_history' => $request->project_history ?: "",
            ]);
        } else {
            // ユーザーに関連付けられたユーザー情報を作成する
            $user->userProfile()->update([
                'project_implemented_type' => $request->project_implemented_type ? json_encode($request->project_implemented_type) : json_encode([]),
                'coporate_type' => $request->coporate_type,
                'corporate_number' => $request->corporate_number,
                'corporate_name' => $request->corporate_name,
                'representative_title' => $request->representative_title,
                'representative_name' => $request->representative_name,
                'main_phone_number' => $request->main_phone_number,
                'postal_code' => $request->postal_code,
                'prefecture' => $request->prefecture,
                'city_town' => $request->city_town,
                'address_beyond_city_town' => $request->address_beyond_city_town,
                'other_credit_history' => $request->other_credit_history ?: "",
                'corporate_account_registration_date' => $request->corporate_account_registration_date,
                'department_name' => $request->department_name,
                'personal_title' => $request->personal_title,
                'personal_name' => $request->personal_name,
                'contact_phone_number' => $request->contact_phone_number,
                'email_address' => $request->email_address,
                'project_history' => $request->project_history ?: "",
            ]);
        }

        return Redirect::route('profile.edit')->with('detailed_status', 'profile-detailed-updated');
    }


    /**
     * ユーザーのアカウントを削除します。
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

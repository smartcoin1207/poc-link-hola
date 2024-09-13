<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Helpers\AuthHelper;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

use function PHPSTORM_META\elementType;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">ユーザー登録</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('users.create_form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $password = self::generateStrongPassword(8);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($password),
            'first_name' => '',
            'last_name' => '',
            'email_verified_at' => now()
        ]);

        // storeMediaFile($user,$request->profile_image, 'profile_image');

        $user->assignRole('user');

        // Save user Profile data...
        // $user->userProfile()->create($request->userProfile);

        $mail_view = view('email.user-registration', [
            'url' => route('login'), 
            'username' => $user->username, 
            'password' => $password                 
        ])->render(); 
        
        return redirect()->route('users.index')->with('success', $mail_view);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.profile', compact('data', 'profileImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;

        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        $profileImage = getSingleMedia($data, 'profile_image');
        
        return view('users.form', compact('data','id', 'roles', 'profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'username' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        // dd($request->all());
        $user = User::with('userProfile')->findOrFail($id);

        $role = Role::find($request->user_role);
        if(env('IS_DEMO')) {
            if($role->name === 'admin'&& $user->user_type === 'admin') {
                return redirect()->back()->with('error', 'Permission denied');
            }
        }
        $user->assignRole($role->name);

        $userProfile = $user->userProfile();
        
        $data = [
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
        ];

        if (!$user->userProfile()->exists()) {
            $userProfile->create($data);
        } else {
            $userProfile->update($data);
        }

        $user->update([
            'username' => $request->username,
            // 'password' => bcrypt($request->password),
            'user_type' => $role->name ?? 'user',
            'first_name' => $request->first_name ?? '',
            'last_name' => $request->last_name ?? ''
        ]);

        // // Save user image...
        // if (isset($request->profile_image) && $request->profile_image != null) {
        //     $user->clearMediaCollection('profile_image');
        //     $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        // }

        // user profile data....

        if(auth()->check()){
            return redirect()->route('users.index')->withSuccess(__('message.msg_updated',['name' => __('message.user')]));
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message= __('global-message.delete_form', ['form' => __('users.title')]);

        if($user!='') {
            $user->delete();
            $status = 'success';
            $message= __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if(request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status,$message);

    }

    function generateStrongPassword($length = 12) {
        $lowercase = Str::random($length / 4);
        $uppercase = Str::upper(Str::random($length / 4));
        $numbers = Str::random($length / 4, '1234567890');
        $symbols = '@$!%*#?&';
        $randomSymbols = substr(str_shuffle($symbols), 0, $length / 4);
    
        $password = str_shuffle($lowercase . $uppercase . $numbers . $randomSymbols);
    
        return substr($password, 0, $length);
    }
}

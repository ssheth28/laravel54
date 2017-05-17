<?php

namespace App\Http\Controllers;

use App\Events\ChangePassword;
use App\Jobs\SendInvitationMail;
use App\Jobs\SendVerificationEmail;
use App\Jobs\SendPasswordChangedNotificationEmail;
use App\Models\CompanyUser;
use App\Models\Person;
use App\Models\User;
use App\Models\UserInvite;
use Auth;
use Carbon\Carbon as Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Landlord;
use Spatie\Permission\Models\Role;
use View;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'User';
        $this->request = $request;
        View::share('title', $this->title);
        parent::__construct();
    }

    public function __destruct()
    {
        unset($this->title);
    }

    public function init()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('users.index');
    }

    public function validateEmail(Request $request)
    {
        $email = $request->email;
        if ($email !== null && !empty($email)) {
            $userQuery = User::where('email', $email);
            if ($request->id) {
                $userQuery->where('id', '!=', $request->id);
            }
            $user = $userQuery->first();

            if ($user) {
                return 'false';
            }
        }

        return 'true';
    }

    public function validateUsername(Request $request)
    {
        $username = $request->username;
        if ($username !== null && !empty($username)) {
            $userQuery = User::where('username', $username);
            if ($request->id) {
                $userQuery->where('id', '!=', $request->id);
            }
            $user = $userQuery->first();

            if ($user) {
                return 'false';
            }
        }

        return 'true';
    }

    public function checkCompanyUser(Request $request)
    {
        $email = $request->email;
        $companyId = Landlord::getTenants()['company']->id;
        if ($email !== null && !empty($email)) {
            $userQuery = User::where('email', $email);
            if ($request->id) {
                $userQuery->where('id', '!=', $request->id);
            }
            $user = $userQuery->first();
            if ($user) {
                $companyUser = CompanyUser::where('user_id', $user->id)->where('company_id', $companyId)->first();
                if ($companyUser) {
                    return 'false';
                }
            }
        }

        return 'true';
    }

    public function getUserData()
    {
        $request = $this->request->all();
        $companyId = Landlord::getTenants()['company']->id;

        $users = DB::table('users')
                    ->join('company_user', 'company_user.user_id', 'users.id')
                    ->join('people', 'users.person_id', 'people.id')
                    ->where('company_user.company_id', $companyId)
                    ->select('*', DB::raw('DATE_FORMAT(users.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'), DB::raw('users.id as user_id'), DB::raw('company_user.settings as settings'));

        $sortby = 'users.id';
        $sorttype = 'desc';
        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        // $users->where('users.deleted_at', '=', null);
        if (isset($request['name']) && trim($request['name']) !== '') {
            $users->where('people.first_name', 'like', '%'.$request['name'].'%');
        }

        if (isset($request['email']) && trim($request['email']) !== '') {
            $users->where('users.email', 'like', '%'.$request['email'].'%');
        }

        if (isset($request['not_accepted_invitation']) && trim($request['not_accepted_invitation']) == '1') {
            if (!isset($request['sortby'])) {
                $users->orderBy('company_user.settings->is_invitation_accepted', 'asc');
            }
        } else {
            $users->where('company_user.settings->is_invitation_accepted', '=', 1);
        }

        if (isset($request['not_accepted_invitation']) && (trim($request['not_accepted_invitation']) == '0' || (isset($request['sortby']) && trim($request['not_accepted_invitation']) == '1'))) {
            $users->orderBy($sortby, $sorttype);
        }

        $usersList = [];

        if (!array_key_exists('pagination', $request)) {
            $users = $users->paginate($request['pagination_length']);
            $usersList = $users;
        } else {
            $usersList['total'] = $users->count();
            $usersList['data'] = $users->get();
        }

        $response = $usersList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $roles = Role::where('name', 'LIKE', $companyId.'%')->pluck('display_name', 'name');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->init();
        $checkUserExists = User::where('email', $request->email)->first();
        $companyId = Landlord::getTenants()['company']->id;
        $userId = 0;

        if (!$checkUserExists) {
            $person = new Person();
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->save();

            $user = new User();
            $user->person_id = $person->id;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make('password');
            $user->verification_token = md5(uniqid(mt_rand(), true));
            $user->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
            $user->save();
            $user->assignRole($request->get('roles'));

            $userId = $user->id;

            dispatch(new SendVerificationEmail($user));
        } else {
            $userId = $checkUserExists->id;

            $userInvite = new UserInvite();
            $userInvite->user_id = Auth::user()->id;
            $userInvite->company_id = $companyId;
            $userInvite->invited_user_id = $userId;
            $userInvite->accept_token = md5(uniqid(mt_rand(), true));
            $userInvite->save();

            dispatch(new SendInvitationMail($userInvite, $checkUserExists));
        }

        $companyUser = new CompanyUser();
        $companyUser->company_id = $companyId;
        $companyUser->user_id = $userId;
        $companyUser->settings = ['is_invitation_accepted' => ($checkUserExists ? 0 : 1)];
        $companyUser->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('users.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $userId
     *
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $userId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $userId)
    {
        $user = User::find($userId);
        $companyId = Landlord::getTenants()['company']->id;
        $roles = Role::where('name', 'LIKE', $companyId.'%')->pluck('display_name', 'name');

        $userRoles = $user->roles;

        $companyWiseRoles = $userRoles->filter(function ($value, $key) {
            $companyId = Landlord::getTenants()['company']->id;
            if (explode('.', $value->name)[0] == $companyId) {
                return $value;
            }
        })->values()->pluck('name')->toArray();

        return view('users.edit', compact('user', 'roles', 'companyWiseRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $userId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $userId)
    {
        $this->init();
        $user = User::findOrFail($userId);
        $person = Person::findOrFail($user->person_id);

        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->save();

        $user->email = $request->email;
        $user->username = $request->username;
        $user->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
        $user->save();
        $user->syncRoles();
        $user->assignRole($request->get('roles'));
        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('users.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $userId)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        $user = User::find($userId);
        $user->syncRoles();
        if (!$user->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('users.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    public function acceptInvitation($company, $token = null)
    {
        if (isset($token)) {
            $userInvites = UserInvite::where('accept_token', $token)->first();
            if ($userInvites) {
                $companyUser = DB::table('company_user')
                                    ->where('user_id', $userInvites->invited_user_id)
                                    ->where('company_id', $userInvites->company_id)
                                    ->update(['settings->is_invitation_accepted' => 1]);

                return view('users.accpet_invitation');
            } else {
                return $this->response()->array(['error' => 'not found'])->statusCode(404);
            }
        }
    }

    public function resendInvitation(Request $request, $company, $userId)
    {
        $user = User::find($userId);
        $companyId = Landlord::getTenants()['company']->id;

        $existedUserInvite = UserInvite::where('invited_user_id', $userId)
                                        ->where('company_id', $companyId)
                                        ->delete();
        $userInvite = new UserInvite();
        $userInvite->user_id = Auth::user()->id;
        $userInvite->company_id = $companyId;
        $userInvite->invited_user_id = $userId;
        $userInvite->accept_token = md5(uniqid(mt_rand(), true));
        $userInvite->save();

        dispatch(new SendInvitationMail($userInvite, $user));

        flash()->success(config('config-variables.flash_messages.invitationSent'));

        $parameters = ['domain' => app('request')->route()->parameter('company')];
        if (isset($request->show_pending)) {
            $parameters['show_pending'] = 1;
        }

        return redirect()->route('users.index', $parameters);
    }

    public function profile()
    {
        $user = Auth::user();
        View::share('user', $user);

        return view('users.profile');
    }

    public function saveGeneralInfo(Request $request)
    {
        $user = User::with('person')->where('id', Auth::user()->id)->first();
        $user->person->first_name = $request->general_first_name;
        $user->person->last_name = $request->general_last_name;
        $address = [];
        $address['address1'] = $request->general_address1;
        $address['city'] = $request->general_city;
        $address['state'] = $request->general_state;
        $address['pin'] = $request->general_pin;
        $user->person->address = $address;
        $user->person->primary_email = $request->general_primary_email;
        $user->person->secondary_email = $request->general_secondary_email;
        $user->person->mobile_number = $request->general_mobile_number;
        $user->person->home_phone = $request->general_home_phone;
        $user->person->work_phone = $request->general_work_phone;
        $user->person->dob = Carbon::parse($request->dob)->format('Y-m-d H:i:s');
        $user->person->gender = $request->general_gender;
        $user->person->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('users.profile', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Check whether requested password of user get match or not
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function checkPassword(Request $request)
    {
        $password=$request->change_password_current_password;
        $userId=$request->change_password_user_id;

        if (!empty($password) && !empty($userId)) {
            $user = User::where("id", $userId)->first();
            if ($user && Hash::check($password, $user->password)) {
                return "true";
            }
        }
        return "false";
    }

    /**
     * Change password of logged in user
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function changePassword(Request $request)
    {   
        $user_data = $request->all();
        $userId = $user_data['change_password_user_id'];
        $user = User::where("id", $userId)->first();
        if($user_data['change_password_new_password'] && $user_data['change_password_retype_new_password']) {
            $user->password=Hash::make($user_data['change_password_new_password']);
            $user->save();
        }
        dispatch(new SendPasswordChangedNotificationEmail($user));

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('users.profile', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Invite team mate
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function inviteTeamMate(Request $request)
    {
        return redirect()->route('users.create', ['domain' => app('request')->route()->parameter('company'), 'email' => $request->invite_team_mate_email]);
    }
}

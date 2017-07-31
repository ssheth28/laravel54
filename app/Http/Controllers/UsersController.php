<?php

namespace App\Http\Controllers;

use App\Events\ChangePassword;
use App\Jobs\SendInvitationMail;
use App\Jobs\SendPasswordChangedNotificationEmail;
use App\Jobs\SendVerificationEmail;
use App\Models\CompanyUser;
use App\Models\Person;
use App\Models\User;
use App\Models\Department;
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
    public $title;

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
        $companyId = Landlord::getTenants()['company']->id;        
        $departments = Department::all()->pluck('name', 'id');
        $roles = Role::where('name', 'LIKE', $companyId.'%')->pluck('display_name', 'name');
        return view('users.index', compact('departments', 'roles'));
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
                    ->select('*', DB::raw('DATE_FORMAT(users.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'),
                                  DB::raw('users.id as user_id'),
                                  DB::raw('company_user.settings as settings'));

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

        if (isset($request['department']) && trim($request['department']) !== '') {
            $users->where('company_user.settings->department', $request['department']);
        }

        if (isset($request['role']) && trim($request['role']) !== '') {
            $users->where('company_user.settings->department', $request['role']);
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
        $departments = Department::all()->pluck('name', 'id');

        return view('users.create', compact('roles', 'departments'));
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
            // $person->department = $request->department;
            $person->middle_name = $request->middle_name;
            $person->mobile_number = $request->contact_no;
            $person->home_phone = $request->landline_no;
            $person->parent_contact_number = $request->parent_contact_no;
            $person->driving_licence_number = $request->driving_licence_no;
            $person->aadhar_card_number = $request->aadhar_card_no;
            $person->voter_id_number = $request->voter_id_no;
            $person->blood_group = $request->blood_group;
            $person->dob = Carbon::parse($request->birth_date)->format('Y-m-d H:i:s');
            $address = [];
            $address['current_address'] = $request->current_address;
            $person->address = $address;
            $person->permanent_address = $request->permanent_address;
            $person->gender = $request->gender;
            $person->status = $request->status;
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

            $userAvatar = $request->file('user_image');

            if ($userAvatar) {
                $user->clearMediaCollection('User');
                $media = $user->addMedia($userAvatar)
                            ->preservingOriginal()
                            ->toMediaLibrary('User');
            }

            $userId = $user->id;
            // dd($userId);

            dispatch(new SendVerificationEmail($user));
        } else {
            $userId = $checkUserExists->id;

            $userInvite = new UserInvite();
            $userInvite->user_id = Auth::user()->id;
            $userInvite->company_id = $companyId;
            $userInvite->invited_user_id = $userId;
            $userInvite->accept_token = md5(uniqid(mt_rand(), true));
            $userInvite->save();

            $checkUserExists->assignRole($request->get('roles'));

            dispatch(new SendInvitationMail($userInvite, $checkUserExists));
        }

        $companyUser = new CompanyUser();
        $companyUser->company_id = $companyId;
        $companyUser->user_id = $userId;
        $companyUser->settings = ['is_invitation_accepted' => ($checkUserExists ? 0 : 1)];
        $settings = [];
        $settings['department'] = $request->department;
        $settings['doj'] = Carbon::parse($request->joining_date)->format('Y-m-d H:i:s');
        $companyUser->settings = $settings;
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
    public function show($company, $userId)
    {
        $this->init();
        $user = User::find($userId);
        $userDetailHtml = view('users.user_detail_show', ['user' => $user])->render();

        return array('userDetailHtml' => $userDetailHtml);
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
        $companyUser = CompanyUser::where('user_id', $user->id)->where('company_id', $companyId)->first();
        $departments = Department::all()->pluck('name', 'id');

        $userRoles = $user->roles;

        $companyWiseRoles = $userRoles->filter(function ($value, $key) {
            $companyId = Landlord::getTenants()['company']->id;
            if (explode('.', $value->name)[0] == $companyId) {
                return $value;
            }
        })->values()->pluck('name')->toArray();

        return view('users.edit', compact('user', 'roles', 'companyWiseRoles', 'companyUser', 'departments'));
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
        $userRoles = $user->roles;
        $companyId = Landlord::getTenants()['company']->id;
        
        $companyWiseRoles = $userRoles->filter(function ($value, $key) {
            $companyId = Landlord::getTenants()['company']->id;
            if (explode('.', $value->name)[0] == $companyId) {
                return $value;
            }
        })->values()->pluck('id')->toArray();

        $person = Person::findOrFail($user->person_id);

        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        // $person->department = $request->department;
        $person->middle_name = $request->middle_name;
        $person->mobile_number = $request->contact_no;
        $person->home_phone = $request->landline_no;
        $person->parent_contact_number = $request->parent_contact_no;
        $person->driving_licence_number = $request->driving_licence_no;
        $person->aadhar_card_number = $request->aadhar_card_no;
        $person->voter_id_number = $request->voter_id_no;
        $person->blood_group = $request->blood_group;
        $person->dob = Carbon::parse($request->birth_date)->format('Y-m-d H:i:s');
        // $person->date_of_joining = Carbon::parse($request->joining_date)->format('Y-m-d H:i:s');
        
        $address = [];
        $address['current_address'] = $request->current_address;
        $person->address = $address;        
        
        $person->permanent_address = $request->permanent_address;
        $person->save();

        $companyUser = CompanyUser::where('user_id', $user->id)->where('company_id', $companyId)->first();
        $settings = $companyUser->settings;
        $settings['department'] = $request->department;
        $settings['doj'] = Carbon::parse($request->joining_date)->format('Y-m-d H:i:s');
        $companyUser->settings = $settings;
        $companyUser->save();

        $user->email = $request->email;
        $user->username = $request->username;
        $user->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
        $user->save();
        $user->roles()->detach($companyWiseRoles);
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
    public function destroy(Request $request, $company, $userId)
    {
        $successMessage = config('config-variables.flash_messages.dataDeleted');
        $errorMessage = config('config-variables.flash_messages.dataNotDeleted');
        
        if($this->deleteUser($userId)) {
            flash()->message($successMessage, 'success');
        } else {
            flash()->message($errorMessage, 'danger');    
        }
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
        $userMedia = $user->getMedia('User');

        if (count($userMedia) > 0) {
            $avatar = $user->getMedia('User')[0]->getUrl();
        } else {
            $avatar = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
        }

        View::share('user', $user);

        return view('users.profile', compact('avatar'));
    }

    public function saveGeneralInfo(Request $request)
    {
        $user = User::with('person')->where('id', Auth::user()->id)->first();
        $user->person->first_name = $request->general_first_name;
        $user->person->last_name = $request->general_last_name;
        $address = [];
        $address['address1'] = $request->general_address1;
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
     * Check whether requested password of user get match or not.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function checkPassword(Request $request)
    {
        $password = $request->change_password_current_password;
        $userId = $request->change_password_user_id;

        if (!empty($password) && !empty($userId)) {
            $user = User::where('id', $userId)->first();
            if ($user && Hash::check($password, $user->password)) {
                return 'true';
            }
        }

        return 'false';
    }

    /**
     * Change password of logged in user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function changePassword(Request $request)
    {
        $user_data = $request->all();
        $userId = $user_data['change_password_user_id'];
        $user = User::where('id', $userId)->first();
        if ($user_data['change_password_new_password'] && $user_data['change_password_retype_new_password']) {
            $user->password = Hash::make($user_data['change_password_new_password']);
            $user->save();
        }
        dispatch(new SendPasswordChangedNotificationEmail($user));

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('user.profile', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Invite team mate.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function inviteTeamMate(Request $request)
    {
        return redirect()->route('users.create', ['domain' => app('request')->route()->parameter('company'), 'email' => $request->invite_team_mate_email]);
    }

    public function userProfile()
    {
        $user = Auth::user();
        return view('users.user_overview', compact('user'));
    }

    public function editUserProfile()
    {
        $user = User::with('person')->where('id', Auth::user()->id)->first();
        $companyId = Landlord::getTenants()['company']->id;
        $companyUser = CompanyUser::where('user_id', $user->id)->where('company_id', $companyId)->first();
        $departments = Department::all()->pluck('name', 'id');
        return view('users.edit_profile', compact('user', 'companyUser', 'departments'));
    }

    public function viewChangePaswordPage()
    {
        $user = Auth::user();
        return view('users.change_password', compact('user'));
    }

    public function updateUserProfile(Request $request, $company)
    {
        $companyId = Landlord::getTenants()['company']->id;
        $user = User::with('person')->where('id', Auth::user()->id)->first();
        $user->email = $request->email;
        $user->save();     

        $person = Person::findOrFail($user->person_id);
        $person->first_name = $request->name;
        $person->dob = $request->dob;
        $person->blood_group = $request->blood_group;
        $person->secondary_email = $request->personal_email;
        $person->mobile_number = $request->mobile_no;
        $person->aadhar_card_number = $request->aadhar_no;

        $extraInfo = [];
        $extraInfo['emergency_contact_no'] = $request->emergency_contact_no;
        $extraInfo['pan_no'] = $request->pan_no;
        $extraInfo['passport_no'] = $request->passport_no;
        $extraInfo['marital_status'] = $request->marital_status;
        $extraInfo['spouse_name'] = $request->spouse_name;
        $person->extra_info = $extraInfo;

        $person->home_phone = $request->phone_no;
        $person->bio = $request->about_me;
        $address = [];
        $address['current_address'] = $request->current_address;
        $address['country'] = $request->country;
        $address['state'] = $request->state;
        $address['city'] = $request->city;
        $address['pincode'] = $request->pincode;
        $person->address = $address;
        $person->permanent_address = $request->permanent_address;
        $person->save();

        // saving account details and HR details here 
        $companyUser = CompanyUser::where('user_id', $user->id)->where('company_id', $companyId)->first();
        $settings = $companyUser->settings;
        $settings['department'] = $request->department;
        $settings['designation'] = $request->designation;
        $settings['doj'] = $request->joining_date;
        $settings['job_type'] = $request->job_type;
        $settings['bank_account_no'] = $request->bank_account_no;
        $settings['branch'] = $request->branch;
        $settings['ifsc'] = $request->ifsc_code;
        $settings['pf_no'] = $request->pf_no;
        $settings['esi_no'] = $request->esi_no;
        $settings['ctc'] = $request->annual_ctc;
        $settings['incremental_duration'] = $request->incremental_duration;
        $settings['salary_mode'] = $request->salary_mode;
        $companyUser->settings = $settings;
        $companyUser->save();

        $userAvatar = $request->file('user_avatar');

        if ($userAvatar) {
            $user->clearMediaCollection('User');
            $media = $user->addMedia($userAvatar)
                        ->preservingOriginal()
                        ->toMediaLibrary('User');
        }

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('user.edit.profile', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Common delete function for user delete and company profile user delete
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */    
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->syncRoles();
        if (!$user->delete()) {            
            return false;
        }
        return true;
    }

    public function removeUserFromCompanyProfile($company, $userId)
    {
        $successMessage = config('config-variables.flash_messages.dataDeleted');
        $errorMessage = config('config-variables.flash_messages.dataNotDeleted');

        if($this->deleteUser($userId)) {
            flash()->message($successMessage, 'success');
        } else {
            flash()->message($errorMessage, 'danger');    
        }

        return redirect()->route('company.members', ['domain' => app('request')->route()->parameter('company')]);
    }
}

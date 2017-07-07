<?php

Route::group(['domain' => '{company}.'.config('config-variables.app.domain')], function () {
    Route::group(
        [
            'prefix'     => LaravelLocalization::setLocale(),
            'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect'],
        ],
        function () {
            /*
            |--------------------------------------------------------------------------
            | Web Routes
            |--------------------------------------------------------------------------
            |
            | Here is where you can register web routes for your application. These
            | routes are loaded by the RouteServiceProvider within a group which
            | contains the "web" middleware group. Now create something great!
            |
            */
            Auth::routes();
            Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
            Route::get('/acceptinvitation/{token}', 'UsersController@acceptInvitation');

            Route::get('/home', 'HomeController@index');

            Route::get('/', function () {
                return view('index');
            })->name('front.index');

            Route::post('company/generateSlug', 'CompaniesController@generateSlug')->name('generate.company.slug');

            Route::get('admin/companyselect', 'CompaniesController@selectCompany')->name('company.select')->middleware('auth', 'verifycompany');

            Route::post('admin/companyselect', 'CompaniesController@redirectUserCompanyRole')->middleware('auth', 'verifycompany')->name('redirect.user.company.role');


            Route::group(
            [
                'prefix'     => UserRole::setUserRole(),
                'middleware' => ['roleSessionRedirect'],
            ],
            function () {
                Route::group(['middleware' => ['auth', 'verifycompany'], 'prefix' => 'admin'], function () {
                    Route::get('/home', 'HomeController@index')->name('admin.home');
                    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

                    /*
                     * Teamwork routes
                     */
                    Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function () {
                        Route::get('/', 'TeamController@index')->name('teams.index');
                        Route::get('create', 'TeamController@create')->name('teams.create');
                        Route::post('teams', 'TeamController@store')->name('teams.store');
                        Route::get('edit/{id}', 'TeamController@edit')->name('teams.edit');
                        Route::put('edit/{id}', 'TeamController@update')->name('teams.update');
                        Route::delete('destroy/{id}', 'TeamController@destroy')->name('teams.destroy');
                        Route::get('switch/{id}', 'TeamController@switchTeam')->name('teams.switch');

                        Route::get('members/{id}', 'TeamMemberController@show')->name('teams.members.show');
                        Route::get('members/resend/{invite_id}', 'TeamMemberController@resendInvite')->name('teams.members.resend_invite');
                        Route::post('members/{id}', 'TeamMemberController@invite')->name('teams.members.invite');
                        Route::delete('members/{id}/{user_id}', 'TeamMemberController@destroy')->name('teams.members.destroy');

                        Route::post('/getTeamData', 'TeamController@getTeamData');

                        Route::get('accept/{token}', 'AuthController@acceptInvite')->name('teams.accept_invite');
                    });

                    //Users Section
                    Route::resource('users', 'UsersController');
                    Route::post('/getUserData', 'UsersController@getUserData');
                    Route::post('/validateEmail', 'UsersController@validateEmail');
                    Route::post('/validateUsername', 'UsersController@validateUsername');
                    Route::post('/saveGeneralInfo', 'UsersController@saveGeneralInfo')->name('users.save.general.info');
                    Route::post('/checkPassword', 'UsersController@checkPassword')->name('users.check.password');
                    Route::post('/changePassword', 'UsersController@changePassword')->name('users.change.password');
                    Route::post('/inviteTeamMate', 'UsersController@inviteTeamMate')->name('users.invite.teammate');                
                    Route::post('/checkCompanyUser', 'UsersController@checkCompanyUser');
                    Route::get('/resendInvitation/{id}', 'UsersController@resendInvitation');            

                    // user profile routes
                    Route::get('user_profile','UsersController@userProfile')->name('user.profile');
                    Route::get('edit_user_profile','UsersController@editUserProfile')->name('user.edit.profile');
                    Route::get('change_password', 'UsersController@viewChangePaswordPage')->name('user.password');
                    Route::post('/update_user_profile','UsersController@updateUserProfile')->name('user.update.profile');

                    // group section routes
                    Route::resource('groups', 'GroupController');
                    Route::post('/getGroupData', 'GroupController@getGroupData');
                
                    // company profile routes
                    Route::get('company_profile','CompaniesController@companyProfile')->name('company.profile');
                    Route::get('/company_members','CompaniesController@viewMembers')->name('company.members');
                    Route::get('edit_company_profile','CompaniesController@editCompanyProfile')->name('company.edit.profile');
                    Route::post('edit_company_profile','CompaniesController@updateCompanyProfile')->name('company.update.profile');

                    // department section routes
                    Route::resource('departments', 'DepartmentController');
                    Route::post('/getDepartmentData', 'DepartmentController@getDepartmentData');

                    //project technologies section routes
                    Route::resource('technologies', 'TechnologiesController');
                    Route::post('/getTechnologyData', 'TechnologiesController@getTechnologyData');

                    // project section routes
                    Route::resource('projects', 'ProjectController');

                    // Clients section
                    Route::resource('clients', 'ClientsController');
                    Route::post('/getClientData', 'ClientsController@getClientData');

                    //Assets Section
                    Route::resource('assets', 'AssetsController');
                    Route::post('/getAssetData', 'AssetsController@getAssetData');

                    // Recruitments
                    Route::resource('recruitments', 'RecruitmentsController');
                });
            });
        }
    );
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});

// Local dev specific routes
if (App::environment('local')) {
    // Route::get('decompose', '\Lubusin\Decomposer\Controllers\DecomposerController@index');
}

<?php

namespace App\Http\Controllers;

use DB;
use View;
use Landlord;
use App\Models\Client;
use App\Models\Country;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClientsController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Client';
        $this->request = $request;
        View::share('title', $this->title);
        parent::__construct();        
    }

    public function __destruct()
    {
        unset($this->title);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$countries = Country::all()->pluck('name', 'id');
        return view('clients.index', compact('countries'));
    }

    public function getClientData()
    {
        $request = $this->request->all();
        $companyId = Landlord::getTenants()['company']->id;

        $clients = DB::table('clients')
        			->join('countries', 'clients.country_id', 'countries.id')
                    ->select('*', DB::raw('DATE_FORMAT(clients.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'),
                    	DB::raw('countries.name as country'),
                    	DB::raw('clients.name as clientname'),
                    	DB::raw('clients.id as clientid'));

        $sortby = 'clients.id';
        $sorttype = 'desc';
        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        if (isset($request['name']) && trim($request['name']) !== '') {
            $clients->where('clients.name', 'like', '%'.$request['name'].'%');
        }

        if (isset($request['email']) && trim($request['email']) !== '') {
            $clients->where('clients.email', 'like', '%'.$request['email'].'%');
        }

        if (isset($request['skype']) && trim($request['skype']) !== '') {
            $clients->where('clients.skype_address', 'like', '%'.$request['skype'].'%');
        }

        if (isset($request['country']) && trim($request['country']) !== '') {
            $clients->where('clients.country_id', 'like', '%'.$request['country'].'%');
        }

        if (isset($request['industry']) && trim($request['industry']) !== '') {
            $clients->where('clients.industry', 'like', '%'.$request['industry'].'%');
        }

        $clientsList = [];

        if (!array_key_exists('pagination', $request)) {
            $clients = $clients->paginate($request['pagination_length']);
            $clientsList = $clients;
        } else {
            $clientsList['total'] = $clients->count();
            $clientsList['data'] = $clients->get();
        }
        $response = $clientsList;
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
    	$countries = Country::all()->pluck('name', 'id');
        $companyId = Landlord::getTenants()['company']->id;

        return view('clients.create', compact('countries'));
    }

    public function store(Request $request) 
    {
    	$companyId = Landlord::getTenants()['company']->id;
    	$client = new Client();
    	$client->name = $request->client_name;
    	$client->email = $request->client_email;
    	$client->country_id = $request->client_country;
    	$client->dob = Carbon::parse($request->client_dob)->format('Y-m-d H:i:s');
    	$client->contact_no = $request->client_contact_number;
    	$client->skype_address = $request->client_skype;
    	$client->company_email = $request->client_company_email;
    	$client->client_residence_address = $request->client_residence_address;
    	$client->client_company_name = $request->client_company_name;
    	$client->website = $request->client_website_url;
    	$client->industry = $request->client_industry;
    	$client->client_company_address = $request->client_company_address;
    	$client->other_details = $request->other_details;
    	$client->fb_id = $request->client_fb_id;
    	$client->linkedin_id = $request->client_linkedin_id;
    	$client->twitter_id = $request->client_twitter_id;
    	$client->save();

    	flash()->success(config('config-variables.flash_messages.dataSaved'));

    	return redirect()->route('clients.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $clientId
     *
     * @return \Illuminate\Http\Response
     */
    public function show($company, $clientId)
    {
        $client = Client::with('country')->find($clientId);
        $clientDetailHtml = view('clients.client_detail_show', ['client' => $client])->render();

        return array('clientDetailHtml' => $clientDetailHtml);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $clientId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $clientId)
    {
    	$countries = Country::all()->pluck('name', 'id');
        $companyId = Landlord::getTenants()['company']->id;
       	$client = Client::findOrFail($clientId);

        return view('clients.edit', compact('countries', 'client'));
    }

    public function update(Request $request, $company, $clientId) 
    {
    	$companyId = Landlord::getTenants()['company']->id;
    	$client = Client::findOrFail($clientId);
    	$client->name = $request->client_name;
    	$client->email = $request->client_email;
    	$client->country_id = $request->client_country;
    	$client->dob = Carbon::parse($request->client_dob)->format('Y-m-d H:i:s');
    	$client->contact_no = $request->client_contact_number;
    	$client->skype_address = $request->client_skype;
    	$client->company_email = $request->client_company_email;
    	$client->client_residence_address = $request->client_residence_address;
    	$client->client_company_name = $request->client_company_name;
    	$client->website = $request->client_website_url;
    	$client->industry = $request->client_industry;
    	$client->client_company_address = $request->client_company_address;
    	$client->other_details = $request->other_details;
    	$client->fb_id = $request->client_fb_id;
    	$client->linkedin_id = $request->client_linkedin_id;
    	$client->twitter_id = $request->client_twitter_id;
    	$client->save();

    	flash()->success(config('config-variables.flash_messages.dataSaved'));

    	return redirect()->route('clients.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $clientId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $company, $clientId)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        $client = Client::find($clientId);
        if (!$client->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('clients.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}

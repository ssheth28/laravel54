<?php

namespace App\Http\Controllers;
use View;
use Landlord;
use DB;
use Illuminate\Http\Request;
use App\Models\Assets;
use Spatie\Permission\Models\Role;

class AssetsController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Assets';
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
    public function index()
    {
        return view('assets.index');
    }

    public function getAssetData() {

        $request = $this->request->all();
        $asset=DB::table('assets')->select("*", DB::raw('DATE_FORMAT(assets.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'assets.id';
        $sorttype = 'desc';
        if(isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        } else {
            $sortby = 'assets.id';
            $sorttype = 'desc';
        }
        $asset->orderBy($sortby, $sorttype);

        if(isset($request['desk_name']) && trim($request['desk_name']) != '')
            $asset->where('assets.desk_name', 'like', "%" . $request['desk_name'] . "%");

        if(isset($request['ip_address']) && trim($request['ip_address']) != '')
            $asset->where('assets.ip_address', 'like', "%" . $request['ip_address'] . "%");

        if(isset($request['manufacture_name']) && trim($request['manufacture_name']) != '')
            $asset->where('assets.manufacture_name', 'like', "%" . $request['manufacture_name'] . "%");

        if(isset($request['asset_price']) && trim($request['asset_price']) != '')
            $asset->where('assets.asset_price', 'like', "%" . $request['asset_price'] . "%");

        $assetsList = [];

        if(!array_key_exists('pagination', $request)) {
            $asset = $asset->paginate($request['pagination_length']);
            $assetsList = $asset;
        } else {
            $assetsList['total'] = $asset->count();
            $assetsList['data'] = $asset->get();
        }
        
        $response = $assetsList; 
        return $response;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->init();
        $asset = new Assets();
        $asset->desk_name = $request->desk_name;
        $asset->ip_address = $request->ip_address;
        $asset->keyboard_name = $request->keyboard_name;
        $asset->mouse_name = $request->mouse_name;
        $asset->manufacture_name = $request->manufacture_name;
        $asset->asset_price = $request->asset_price;
        $asset->motherboard_model = $request->motherboard_model;
        $asset->processor = $request->processor;
        $asset->hdd = $request->hdd;
        $asset->os_version = $request->os_version;
        $asset->description = $request->description;
        $asset->save();

        $assetImage = $request->file('asset_image');

        if ($assetImage) {            
            $media = $asset->addMedia($assetImage)
                        ->preservingOriginal()
                        ->toMediaLibrary('Asset_image');
        }

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('assets.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company, $assetId)
    {
        $this->init();
        $asset = Assets::find($assetId);
        $assetDetailHtml = view('assets.asset_detail_show', ['asset' => $asset])->render();

        return array('assetDetailHtml' => $assetDetailHtml);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $assetId)
    {
        $asset = Assets::findOrFail($assetId);
        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $assetId)
    {
        $this->init();
        $asset = Assets::findOrFail($assetId);
        $asset->desk_name = $request->desk_name;
        $asset->ip_address = $request->ip_address;
        $asset->keyboard_name = $request->keyboard_name;
        $asset->mouse_name = $request->mouse_name;
        $asset->manufacture_name = $request->manufacture_name;
        $asset->asset_price = $request->asset_price;
        $asset->motherboard_model = $request->motherboard_model;
        $asset->processor = $request->processor;
        $asset->hdd = $request->hdd;
        $asset->os_version = $request->os_version;
        $asset->description = $request->description;
        $asset->save();

        $assetImage = $request->file('asset_image');

        if ($assetImage) {
            $asset->clearMediaCollection('Asset_image');       
            $media = $asset->addMedia($assetImage)
                        ->preservingOriginal()
                        ->toMediaLibrary('Asset_image');
        }
        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('assets.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $company, $assetId)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        $asset = Assets::find($assetId);
        if (!$asset->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('assets.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}

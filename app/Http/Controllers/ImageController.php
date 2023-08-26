<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\Pipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usr = \Auth::user();
        if($usr->default_pipeline)
        {
            $pipeline = Pipeline::where('created_by', '=', $usr->creatorId())->where('id', '=', $usr->default_pipeline)->first();
            if(!$pipeline)
            {
                $pipeline = Pipeline::where('created_by', '=', $usr->creatorId())->first();
            }
        }
        else
        {
            $pipeline = Pipeline::where('created_by', '=', $usr->creatorId())->first();
        }

        $pipelines = Pipeline::where('created_by', '=', $usr->creatorId())->get()->pluck('name', 'id');
        $images = Image::all();
        return view('image.index' ,compact('pipelines','pipeline','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('create lead'))
        {
            $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            $users->prepend(__('Select User'), '');

            return view('image.create', compact('users'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usr       = \Auth::user();
        $validator = Validator::make(
            $request->all(), [
                            'name' => 'required|max:120',
                          
                        ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $image                 = new Image();
        $image->name           = $request->name;
     
        if(!empty($request->image))
        {
            // $image = $request->file('image');
            // $image_name = $image->getClientOriginalName();
            // $image->save(public_path('/formulaimages'),$image_name);
            // $image_path = "/formulaimages/" . $image_name;
            
            // $images        = $request->file('image');
            // $extension    = $images->getClientOriginalExtension();
            // $filename     = time() . '.'.$extension;
            // $image_resize = \Image::make($images->getRealPath());
            // $image_resize->resize(351,351);
            // $image_resize->save(public_path('formulaimages/'.$filename));
            // $url = 'formulaimages/'.$filename;
            
                $fileName = time() . "_" . $request->image->getClientOriginalName();
             $path =    $request->image->storeAs('uploads/windows', $fileName);
                $image->image = $fileName;
                $image->url = $path;

           
        }

        // $image['image'] = $filename;
        // $image['url']   = $url;
        $insert = $image->save();
        if ($insert){

        return redirect()->back()->with('success', __('Expense added successfully.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}

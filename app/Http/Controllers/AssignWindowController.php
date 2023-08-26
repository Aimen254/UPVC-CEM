<?php

namespace App\Http\Controllers;

use App\Models\AssignWindow;
use App\Models\Frame;
use App\Models\Utility;
use Illuminate\Http\Request;

class AssignWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = AssignWindow::all();
        return view('assignwindow.index' ,compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(\Auth::user()->can('create product & service'))
        {
            $access          = Frame::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('assignwindow.create', compact('access'));
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
      
        $image                 = new AssignWindow();
        $image->profile           = $request->profile;
          $image->type           = $request->type;
            $image->company           = $request->company;
                $image->created_by           = \Auth::user()->creatorId();
        $image->frame_id         = !empty($request->frame_id) ? implode(',', $request->frame_id) : '';
        $frames=Utility::frame($image->frame_id);
        foreach($frames as $frame){
        $data[] = $frame->name;
     }
     $image->frame =   implode(',', $data);
        if(!empty($request->image))
        {
          
                $fileName = time() . "_" . $request->image->getClientOriginalName();
             $path =    $request->image->storeAs('uploads/payment', $fileName);
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
     * @param  \App\Models\AssignWindow  $assignWindow
     * @return \Illuminate\Http\Response
     */
    public function show(AssignWindow $assignWindow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignWindow  $assignWindow
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if(\Auth::user()->can('edit lead'))
        {
            $milestone = AssignWindow::find($id);

             if($milestone->type == "sliding"){
                return view('assignwindow.addprice', compact('milestone'));
             }else if($milestone->type == "fix"){
                return view('assignwindow.fixaddprice', compact('milestone')); 
            }else if($milestone->type == "openable"){
                return view('assignwindow.openaddprice', compact('milestone')); 
            }else{
                return view('assignwindow.dooraddprice', compact('milestone')); 
            }
          
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignWindow  $assignWindow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $assign = AssignWindow::find($id);
        $assign->outerprice = $request->outerprice;
        $assign->slideprice = $request->slideprice;
        $assign->netprice = $request->netprice;
        $assign->slidebeedprice = $request->slidebeedprice;
        $assign->interlockprice = $request->interlockprice;
        $assign->outersteelprice = $request->outersteelprice;
        $assign->netsteelprice = $request->netsteelprice;
        $assign->slidesteelprice = $request->slidesteelprice;
        $assign->gaskitprice = $request->gaskitprice;
          $assign->xgaskitprice = $request->xgaskitprice;
        $assign->gaskitbeedprice = $request->gaskitbeedprice;
         $assign->cockspurprice = $request->cockspurprice;
        $assign->nettprice = $request->nettprice;
        $assign->netgaskitprice = $request->netgaskitprice;
            $assign->flyscreen = $request->flyscreen;
        $assign->slidingbrushprice = $request->slidingbrushprice;
        $assign->aluminiumrailprice = $request->aluminiumrailprice;
        $assign->gearprice = $request->gearprice;
        $assign->latchlockprice = $request->latchlockprice;
        
             $assign->fixpanelprice = $request->fixpanelprice;
        
           $assign->outerw = $request->outerw;
        $assign->slidew = $request->slidew;
        $assign->beedingw = $request->beedingw;
          $assign->fixpanelw = $request->fixpanelw;
  
        $insert = $assign->update();
        if($insert){
            return redirect()->back()->with('success', __('Prices added successfully.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignWindow  $assignWindow
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignWindow $assignWindow)
    {
        //
    }
}

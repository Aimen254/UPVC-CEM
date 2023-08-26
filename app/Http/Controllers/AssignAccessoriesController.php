<?php

namespace App\Http\Controllers;

use App\Models\AssignWindow;
use App\Models\OpenAssignAccess;
use App\Models\AssignAccessories;
use Illuminate\Http\Request;

class AssignAccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       
        if(\Auth::user()->can('create product & service'))
        {
           
          $milestone = AssignWindow::find($id);
             if($milestone->type == "sliding"){
            return view('assignwindow.accesscreate', compact('milestone'));
             }else if($milestone->type == "fix"){
                return view('assignwindow.fixaccesscreate', compact('milestone')); 
            }else if($milestone->type == "openale"){
                return view('assignwindow.openaccesscreate', compact('milestone')); 
            }else{
                return view('assignwindow.dooraccesscreate', compact('milestone')); 
            }
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
    public function store(Request $request, $id)
    {
        $win = AssignWindow::find($id);
        $access =new  AssignAccessories();
        $access->window_id = $id;
        $access->window = $win->frame;
        $access->sashroll = $request->sashroll; 
        $access->sashrollqty = $request->sashrollqty; 
        $access->sashrollrate = $request->sashrollrate; 

        $access->flathandle = $request->flathandle; 
        $access->flathandleqty = $request->flathandleqty; 
        $access->flathandlerate = $request->flathandlerate;
        
        $access->slidekeep= $request->slidekeep; 
        $access->slidekeepqty= $request->slidekeepqty; 
        $access->slidekeeprate= $request->slidekeeprate; 

        $access->dummywheel= $request->dummywheel; 
        $access->dummywheelqty= $request->dummywheelqty; 
        $access->dummywheelrate= $request->dummywheelrate; 

        $access->netwheel= $request->netwheel; 
        $access->netwheelqty= $request->netwheelqty;
        $access->netwheelrate= $request->netwheelrate;

        $access->silicon= $request->silicon;
        $access->siliconqty= $request->siliconqty;
        $access->siliconrate= $request->siliconrate;

        $access->fixer= $request->fixer;
        $access->fixerqty= $request->fixerqty;
        $access->fixerrate= $request->fixerrate;

        $access->windbreak= $request->windbreak;
        $access->windbreakqty= $request->windbreakqty;
        $access->windbreakrate= $request->windbreakrate;

        $access->stopper= $request->stopper;
        $access->stopperqty= $request->stopperqty;
        $access->stopperrate= $request->stopperrate;

        $access->bumperblock= $request->bumperblock;
        $access->bumperblockqty= $request->bumperblockqty;
        $access->bumperblockrate= $request->bumperblockqty;
        
         $access->steeltap= $request->steeltap;
        $access->steeltapqty= $request->steeltapqty;
        $access->steeltaprate= $request->steeltapqty;
        
          $access->conscrew= $request->conscrew;
        $access->conscrewqty= $request->conscrewqty;
        $access->conscrewrate= $request->conscrewrate;
        
        $insert = $access->save();
        if ($insert){

            return redirect()->back()->with('success', __('Expense added successfully.'));
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignAccessories  $assignAccessories
     * @return \Illuminate\Http\Response
     */
    public function show(AssignAccessories $assignAccessories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignAccessories  $assignAccessories
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignAccessories $assignAccessories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignAccessories  $assignAccessories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignAccessories $assignAccessories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignAccessories  $assignAccessories
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignAccessories $assignAccessories)
    {
        //
    }
      public function openstore(Request $request, $id)
    {
        $win = AssignWindow::find($id);
        $access =new  OpenAssignAccess();
        $access->window_id = $id;
        $access->window = $win->frame;
        $access->twoDhindges= $request->twoDhindges; 
        $access->twoDhindgesqty = $request->twoDhindgesqty; 
        $access->twoDhindgesrate = $request->twoDhindgesrate; 

        $access->thDhindges = $request->thDhindges; 
        $access->thDhindgesqty = $request->thDhindgesqty; 
        $access->thDhindgesrate = $request->thDhindgesrate;
        
        $access->openablekeep= $request->openablekeep; 
        $access->openablekeepqty= $request->openablekeepqty; 
        $access->openablekeeprate= $request->openablekeeprate; 

        $access->Tlock= $request->Tlock; 
        $access->Tlockqty= $request->Tlockqty; 
        $access->Tlockrate= $request->Tlockrate; 

        $access->cockspur= $request->cockspur; 
        $access->cockspurqty= $request->cockspurqty;
        $access->cockspurrate= $request->cockspurrate;

        $access->silicon= $request->silicon;
        $access->siliconqty= $request->siliconqty;
        $access->siliconrate= $request->siliconrate;

        $access->outwardcase= $request->outwardcase;
        $access->outwardcaseqty= $request->outwardcaseqty;
        $access->outwardcaserate= $request->outwardcaserate;

        $access->windowstay= $request->windowstay;
        $access->windowstayqty= $request->windowstayqty;
        $access->windowstayrate= $request->windowstayrate;

        $access->frictionstay= $request->frictionstay;
        $access->frictionstayqty= $request->frictionstayqty;
        $access->frictionstayrate= $request->frictionstayrate;

        $access->pencilhindge= $request->pencilhindge;
        $access->pencilhindgeqty= $request->pencilhindgeqty;
        $access->pencilhindgerate= $request->pencilhindgerate;

        $access->flathandle= $request->flathandle;
        $access->flathandleqty= $request->flathandleqty;
        $access->flathandlerate= $request->flathandlerate;
        $insert = $access->save();
        if ($insert){

            return redirect()->back()->with('success', __('Expense added successfully.'));
            }

    }
      public function doorstore(Request $request, $id)
    {
        $win = AssignWindow::find($id);
        $access =new  OpenAssignAccess();
        $access->window_id = $id;
        $access->window = $win->frame;
        $access->twoDhindges= $request->twoDhindges; 
        $access->twoDhindgesqty = $request->twoDhindgesqty; 
        $access->twoDhindgesrate = $request->twoDhindgesrate; 

        $access->thDhindges = $request->thDhindges; 
        $access->thDhindgesqty = $request->thDhindgesqty; 
        $access->thDhindgesrate = $request->thDhindgesrate;

        $access->Tlock= $request->Tlock; 
        $access->Tlockqty= $request->Tlockqty; 
        $access->Tlockrate= $request->Tlockrate; 

        $access->cockspur= $request->cockspur; 
        $access->cockspurqty= $request->cockspurqty;
        $access->cockspurrate= $request->cockspurrate;

        $access->silicon= $request->silicon;
        $access->siliconqty= $request->siliconqty;
        $access->siliconrate= $request->siliconrate;

        $access->imphandlesp= $request->imphandlesp;
        $access->imphandlespqty= $request->imphandlespqty;
        $access->imphandlesprate= $request->imphandlesprate;

        $access->imphandlecyl= $request->imphandlecyl;
        $access->imphandlecylqty= $request->imphandlecylqty;
        $access->imphandlecylrate= $request->imphandlecylrate;

        $access->imphandle= $request->imphandle;
        $access->imphandleqty= $request->imphandleqty;
        $access->imphandlerate= $request->imphandlerate;
        $insert = $access->save();
        if ($insert){

            return redirect()->back()->with('success', __('Expense added successfully.'));
            }

    }
}

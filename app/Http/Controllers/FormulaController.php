<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\User;
use App\Models\Pipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormulaController extends Controller
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
        $formulas = Formula::all();
        return view('formula.index' ,compact('pipelines','pipeline','formulas'));
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

            return view('formula.create', compact('users'));
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

        $formula                 = new Formula();
        $formula ->name           = $request->name;
        $formula ->size           = $request->size;
        $formula ->type           = $request->type;
       $insert = $formula->save();
       if($insert){
        return redirect()->back()->with('success', __('Expense added successfully.'));
       }
else{
    redirect()->back()->with('error', $messages->first());
}
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function show(Formula $formula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function edit(Formula $formula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formula $formula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formula  $formula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formula $formula)
    {
        //
    }
}

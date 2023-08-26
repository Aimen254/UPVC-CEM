<?php

namespace App\Http\Controllers;

use App\Models\FormulAssign;
use App\Models\ImageFormula;
use App\Models\Image;
use App\Models\Formula;
use App\Models\User;
use App\Models\Accessories;
use Illuminate\Http\Request;

class FormulAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        $formulas = Formula::all();

        return view('assignformulas.allimages' ,compact('images','formulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Image $image)
    {
        
        $formulas = Formula::get()->pluck('type', 'id');;
        $access          = Accessories::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
         $slidingaccess          = Accessories::where('typename','Sliding Windows')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
         $openabledooraccess          = Accessories::where('typename','Openable Doors')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
      
          $openablewindaccess          = Accessories::where('typename','Openable Windows')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        if(\Auth::user()->can('create lead'))
        {
            $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            $users->prepend(__('Select User'), '');

            return view('assignformulas.create', compact('users',  'image','formulas','access','slidingaccess', 'openabledooraccess', 'openablewindaccess'));
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
      
        try {
            $formula = $request->get('formula_id');
            $forms =Formula::whereIn('id', $formula)->get();
            foreach( $forms as $form)
            {
                $data[] = $form->type;
            }
            $formasign                = new FormulAssign();
            $formasign->image_id           = $request->id;
            $formasign->imagename           = $request->name;
            $formasign->formula_id         = !empty($request->formula_id) ? implode(',', $request->formula_id) : '';
            $formasign->acess_id         = !empty($request->acess_id) ? implode(',', $request->acess_id) : '';
            $formasign->formula_type       = json_encode($data);
            $formasign->created_by     = \Auth::user()->creatorId();
            $insert = $formasign->save();
                    if ($insert){
                       return redirect()->back()->with('success', __('Formulas successfully Assigned!'));
                        
                    }
        
                    // Test
        } catch (\Exception $e) {
                    return $e->getMessage();
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormulAssign  $formulAssign
     * @return \Illuminate\Http\Response
     */
    public function show(FormulAssign $formulAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormulAssign  $formulAssign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $formulas = Formula::get()->pluck('type', 'id');
        $image = Image::where('id', $id)->first();
      
        $form = FormulAssign::where('image_id', $id)->first();
       
        $access          = Accessories::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $slidingaccess          = Accessories::where('typename','Sliding Windows')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
         $openabledooraccess          = Accessories::where('typename','Openable Doors')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
           $openablewindaccess          = Accessories::where('typename','Openable Windows')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
      
        if(\Auth::user()->can('create lead'))
        {
             $form->acess_id      = explode(',', $form->acess_id);
                $form->formula_id      = explode(',', $form->formula_id);
            $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            $users->prepend(__('Select User'), '');

            return view('assignformulas.edit', compact('users', 'image','formulas','access','form','slidingaccess', 'openabledooraccess','openablewindaccess'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormulAssign  $formulAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        if(\Auth::user()->can('edit product & service'))
        {
            $formasign = FormulAssign::find($id);
            if($formasign->created_by == \Auth::user()->creatorId())
            {

           

                try {
                    $formula = $request->get('formula_id');
                    $forms =Formula::whereIn('id', $formula)->get();
                    foreach( $forms as $form)
                    {
                        $data[] = $form->type;
                    }
                 
                    $formasign->image_id           = $request->image_id;
                    $formasign->imagename           = $request->imagename;
                    $formasign->formula_id         = !empty($request->formula_id) ? implode(',', $request->formula_id) : '';
                    $formasign->acess_id         = !empty($request->acess_id) ? implode(',', $request->acess_id) : '';
                    $formasign->formula_type       = json_encode($data);
                    $formasign->created_by     = \Auth::user()->creatorId();
                    $insert = $formasign->save();
                            if ($insert){
                               return redirect()->back()->with('success', __('Formulas Assign successfully updated!'));
                                
                            }
                
                            // Test
                } catch (\Exception $e) {
                            return $e->getMessage();
                        }
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormulAssign  $formulAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormulAssign $formulAssign)
    {
        //
    }
}

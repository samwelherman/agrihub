<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmer;
use App\Models\User;
use App\Models\Group;
class FarmerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id)->farmer;
        $group=USer::find($user_id)->group;
        //return view('agrihub.dashboard');
        return view('agrihub.manage-farmer')->with('farmer',$user)->with('group',$group);
        //print_r($user->farmer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]); 
        
        //$data=$this->request();
        //$data['user_id'] =auth()->user()->id;
        //$farmer= Farmer::create($data);
      
        $farmer= new Farmer();

        $farmer->firstname=$request->input('firstname');
        $farmer->lastname=$request->input('lastname');
        //$farmer= Farmer::create($this->request());input('lastname');
        $farmer->phone=$request->input('phone');
        $farmer->email=$request->input('email');
        $farmer->region=$request->input('region');
        $farmer->address=$request->input('address');
        $farmer->group_id=$request->input('group');
        $farmer->user_id=$user_id=auth()->user()->id;
        $farmer->save();
        if($farmer)
        {
            $messagev="New Farmer registered successful'";
            return redirect('/farmer')->with('messagev',$messagev);
        }
        else
        {
            $messager="Failed to register new Farmer'";
            return redirect('/farmer')->with('messager',$messager);
        }

        //return view('manage-farmer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        $farmer=Farmer::find($id);
    
        $group=User::find($user_id)->group;
        if(empty($farmer))
        {
        
    
        //return view('agrihub.dashboard');
        return view('agrihub.manage-profile')->with('farmer',$user->farmer);

        }
        else
        {
            return view('agrihub.profile')->with('farmer',$farmer)->with('group',$group);
        }
        //return view('agrihub.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $farmer=Farmer::find($id);
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        //return view('agrihub.dashboard');
        $group=User::find($user_id)->group;
        if(empty($farmer))
        {
       
        return view('agrihub.manage-farmer')->with('farmer',$user->farmer);

        }
        else
        {
            return view('agrihub.farmer-edit')->with('farmer',$farmer)->with('group',$group);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $data=Farmer::find($id);
         $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]); 
       
        $result=$request->all();
        //print_r($result);
        $result['user_id']=auth()->user()->id;
        
        $data->update($result);
         //retrieve data for manage user page
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        //Validate update of data 
        if($data)
        {
            $messagev="Success Updated'";
            return redirect('/farmer')->with('messagev',$messagev);
        }
        else
        {
            return view('agrihub.manage-farmer')->with('farmer',$user->farmer);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Farmer::find($id);
        $data->delete();
        if($data)
        {
            $messagev="Success Deleted'";
            return redirect('/farmer')->with('messagev',$messagev);
        }
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;
use App\Invoice;
use App\Ticket;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::FindOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user=User::FindOrFail($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->country=$request->country;
        $user->status=$request->status;
        $user->role=$request->role;
        $user->save();
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        $user=User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                return response()->json(['userData'=>$user]);
            }
        }
        return response()->json('Email Or Password Invalid');
    }

    public function getStatist(){
        $owners=User::where('role','owner')->count();
        $pendingOwners=User::where('role','owner')->where('status','pending')->count();
        $invoices=Invoice::count();
        $tickets=Ticket::count();
        $statics=['owners'=>$owners,'pendingOwners'=>$pendingOwners,'invoices'=>$invoices,'tickets'=>intval($tickets)];

        
        $month_owners=DB::select(
            "SELECT MONTH(created_at) as month, COUNT(id) AS TOTALCOUNT 
            FROM users
            where role='owner' AND status='active' AND YEAR(created_at)=YEAR(CURRENT_TIMESTAMP)
            GROUP BY MONTH(created_at)
            ORDER BY YEAR(created_at), MONTH(created_at)");

        $owners_month_active=[0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($month_owners as $key => $month_owner){
            $owners_month_active[$month_owner->month-1]=$month_owner->TOTALCOUNT;
        }

        $month_owners=DB::select(
            "SELECT MONTH(created_at) as month, COUNT(id) AS TOTALCOUNT 
            FROM users
            where role='owner' AND status='trial' AND YEAR(created_at)=YEAR(CURRENT_TIMESTAMP)
            GROUP BY MONTH(created_at)
            ORDER BY YEAR(created_at), MONTH(created_at)");

        $owners_month_trial=[0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($month_owners as $key => $month_owner){
            $owners_month_trial[$month_owner->month-1]=-1*$month_owner->TOTALCOUNT;
        }

        $ownerVStrial=[
            [
                'name' => 'Active Owners',
                'data' => $owners_month_active
            ],
            [
                'name' => 'Trial Owners',
                'data' => $owners_month_trial
            ]
        ];


        //PIE_CHART
        $trial_owner=User::where('role','owner')->where('status','trial')->count();
        $piechart_data=['analyticsData' => [
                [
                    'device' => 'Total Owners',
                    'icon' => 'MonitorIcon',
                    'color' => 'primary',
                    'sessionsPercentage' => $owners
        ],
                [
                    'device' => 'Pending Owners',
                    'icon' => 'SmartphoneIcon',
                    'color' => 'warning',
                    'sessionsPercentage' => $pendingOwners
                ],
                [
                    'device' => 'Trial Owners',
                    'icon' => 'TabletIcon',
                    'color' => 'danger',
                    'sessionsPercentage' => $trial_owner
                ],
            ],
            'series' => array($owners, $pendingOwners, $trial_owner)];


        // subscribers_gained: {
        //     analyticsData: [
        //       {
        //         device: 'Dekstop',
        //         icon: 'MonitorIcon',
        //         color: 'primary',
        //         sessionsPercentage: 58.6,
        //         comparedResultPercentage: 2
        //       },
        //       {
        //         device: 'Mobile',
        //         icon: 'SmartphoneIcon',
        //         color: 'warning',
        //         sessionsPercentage: 34.9,
        //         comparedResultPercentage: 8
        //       },
        //       {
        //         device: 'Tablet',
        //         icon: 'TabletIcon',
        //         color: 'danger',
        //         sessionsPercentage: 6.5,
        //         comparedResultPercentage: -5
        //       }
        //     ],
        //     series: [58.6, 34.9, 6.5]
        //   },

        // return $ownerVStrial;

        return response()->json(['statics'=>$statics, 'ownerVStrial'=>$ownerVStrial, 'pie_chart' =>$piechart_data] );
    }

    public function owners(){
      $owners=User::where('role','owner')->get();
      return response()->json($owners);
    }

    public function ownerDestroy($owner_id){
        User::destroy($owner_id);
        return response()->json('200');
    }

    public function fetch_owner($owner_id){
        $owner=User::FindOrFail($owner_id);
        return response()->json($owner);
    }

    public function countries(){
        $pre_countries=User::where('country','!=','')->pluck('country','country');
        $countries=[[
            'label' => 'All',
            'value' => 'all'
        ]];
        foreach($pre_countries as $key=> $db_country){
            // $country = new User();
            // $country->label=$key;
            // $country->value=$db_country;
            $country=[
                'label' => $key,
                'value' => $db_country
            ];
            array_push($countries, $country);
        }
        return response()->json($countries);
    }
}

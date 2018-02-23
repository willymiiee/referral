<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\Earning;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $network = Network::whereNull('left_child_id')
            ->orWhereNull('right_child_id')
            ->get();
        return view('home', compact('network'));
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
        $upline = Network::find($request->get('upline_id'));
        $newMember = Network::create([
            'upline_id' => $upline->id
        ]);

        if ($upline->left_child_id) {
            $upline->right_child_id = $newMember->id;
        } else {
            $upline->left_child_id = $newMember->id;
        }

        $upline->save();

        if ($upline->left_child_id && $upline->right_child_id) {
            $tempUpline = $upline;

            do {
                Earning::create([
                    'member_id' => $tempUpline->id,
                    'bonus' => 5000,
                    'type' => 'pair'
                ]);

                $tempUpline = Network::find($tempUpline->upline_id);
            } while (isset($tempUpline));
        };

        do {
            Earning::create([
                'member_id' => $upline->id,
                'bonus' => 10000,
                'type' => 'sponsor'
            ]);

            $upline = Network::find($upline->upline_id);
        } while (isset($upline));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
}

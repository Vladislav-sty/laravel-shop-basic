<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BlockUser;
use App\Models\Block_list;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MongoDB\Driver\Session;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get()->where('is_admin', '0');
        return view('admin.block_list.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::get()->where('id', $request['id'])->first();
        return view('admin.block_list.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            ['user_id' => 'required',
             'cause' => 'required' ],
            ['cause.required' => "Обов'язково заповняти"]

        );

        $user = User::where('id', $validated['user_id'])->first();
        Mail::to($user['email'])->send(new BlockUser($user, $validated['cause']));

        Block_list::create($validated);

        Session()->flash('success', 'Аккаунт заблоковано');
        return redirect()->route('block.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::get()->where('id', $id)->first();
        return view('admin.block_list.show', compact('user'));
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
        $user = Block_list::get()->where('user_id', $id)->first();
        Block_list::destroy($user->id);
        session()->flash('success', 'Аккаунт розблоковано');
        return redirect()->route('block.index');
    }
}

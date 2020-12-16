<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getAllUsers();

        $data = [
            'users' => $users
        ];
        return view('user.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->validate($request, [
            'nama' => 'required|string',
            'nip' => 'required|digits:18|unique:users,nip',
        ]);

        // make default password
        $form['password'] = '12345678';
        $form['is_aktif'] = $request->is_aktif ? true : false;
        $user = User::create($form);

        return redirect()
            ->route('user.index')
            ->withSuccess('Berhasil menambah data guru!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $form = $this->validate($request, [
            'nama' => 'required|string',
            'nip' => 'required|digits:18|unique:users,nip,' . $user->id,
        ]);

        $form['is_aktif'] = $request->is_aktif ? true : false;
        $user->update($form);

        return redirect()
            ->route('user.index')
            ->withSuccess('Berhasil mengubah data guru!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('user.index')
            ->withSuccess('Berhasil menghapus data guru!');
    }
}

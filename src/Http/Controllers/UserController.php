<?php

namespace Modul\userModul\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modul\userModul\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware("web");  
        $this->middleware("auth");
        $this->middleware('role:Admin', ['only' => ['index','save','form','delete','update']]);
    }



    public function index()
    {
        //  $list=User::orderBy('name','desc');
        $list = DB::table('management')->get()->all();
        $active ="user";
        //  dd($data);

        return view('user::user.index', compact('list','active'));
    }

    public function form($id = 0)
    {
        $active ="user";
        $entry = new User;
        if ($id > 0) {
            $entry = User::find($id);
        }
        return view('user::user.form', compact('entry','active'));
    }

    public function save($id = 0)
    {
        //  return request()->only('password');

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $data = request()->only('name', 'email');

        if (request()->filled('password')) {
            $data['password'] = Hash::make(request('password'));
        }
        if ($id > 0) {
            $entry = User::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else {
            $entry = User::create($data);
        }

        return redirect()
            ->route('management.user.edit', $entry->id)
            ->with('status', 'Successfully xd')
            ->with('status_type', 'success');

    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->route('management.user');
    }

}

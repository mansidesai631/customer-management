<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::whereNotIn('id', [auth()->id()]);

        if ($request->zip != null) {
            $data = $data->where('zip', '=', $request->zip);
        }
        if ($request->gender == '0' || $request->gender == '1') {
            $data = $data->where('gender', '=', $request->gender);
        }
        $data = $data->orderBy('id','DESC')->paginate(5);
        return view('index')
            ->with('users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:10',
            'address' => 'nullable|min:10|max:150|regex:/(^[a-zA-Z0-9\s,.-]*$)/',
            'zip' => 'nullable|min:6|max:16',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'gender' => 'required|boolean',

        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 2;

        $user = User::create($input);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('edit',compact('user'));
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
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'nullable|max:10',
            'address' => 'nullable|min:10|max:150|regex:/(^[a-zA-Z0-9\s,.-]*$)/',
            'zip' => 'nullable|min:6|max:16',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'gender' => 'required|boolean',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);


        // $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function getUserProduct($id)
    {
        $products = Product::where('user_id', $id)->paginate(5);
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function countCustomer(Request $request)
    {
        $customerCount = User::whereNotIn('id', [auth()->id()]);

        if ($request->zip != null) {
            $customerCount = $customerCount->where('zip', '=', $request->storesData);
        }
        if ($request->gender) {
            $customerCount = $customerCount->where('gender', '=', $request->employeeId);
        }

        $customerCount = $customerCount->count();

        return view('index')
            ->with('count', $customerCount);
    }
}

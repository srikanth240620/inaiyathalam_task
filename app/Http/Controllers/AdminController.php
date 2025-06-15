<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    public function index(Request $request)
    {

        if ($request->user()->type == 'admin') {


            $query = User::where('id', '!=', $request->user()->id)->orderby('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value']) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                    }
                })
                ->make(true);
        }
        return response()->json([
            'code' => 400,
            'message' => "Invalid user",
        ]);
    }

    public function update(Request $request, $id)
    {

        if ($request->user()->type == 'admin') {



            $user = User::find($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6',
                'type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->errors()->first()
                ]);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = $request->type;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json([
                'code' => 200,
                'message' => 'User updated successfully.',
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => "Invalid user",
        ]);
    }

    public function store(Request $request)
    {

        if ($request->user()->type == 'admin') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->errors()->first()
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->type,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'User created successfully.',
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => "Invalid user",
        ]);
    }

    public function destroy(Request $request, $id)
    {

        if ($request->user()->type == 'admin') {

            $user = User::where('id', $id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'User deleted successfully.',
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => "Invalid user",
        ]);
    }
}
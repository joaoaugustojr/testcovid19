<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       try {
            DB::beginTransaction();

            $data = $request->all();
            $data['name'] = mb_strtoupper($data['name']);

            if ($request->has('photo')) {
                $path = $request->file('photo')->store('photos', 'public');
                $data['photo_url'] = $path;
            }

            User::create($data);

            DB::commit();
            return response()->json(['message' => 'success'], 200);
       } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 404);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return new UserResource(User::findOrFail($id));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_method');
            $data['name'] = mb_strtoupper($data['name']);
            $user = User::findOrFail($id);

            if ($request->has('photo')) {
                Storage::delete('public/'.$user->photo_url);
                $path = $request->file('photo')->store('photos', 'public');
                $data['photo_url'] = $path;
            }
            
            $user->update($data);

            DB::commit();
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 404);
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
        try {

            DB::beginTransaction();
            $user = User::findOrFail($id);
            if (!is_null($user->photo_url)) {
                Storage::delete('public/' . $user->photo_url);
            }
            $user->delete();
            DB::commit();

            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

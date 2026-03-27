<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class UserController extends Controller
{
    use ApiResponser;
    
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * GET ALL USERS
     * URL: GET http://localhost:8000/users
     */
    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    /**
     * CREATE NEW USER (This will trigger the "Required" errors)
     * URL: POST http://localhost:8000/users
     */
    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender'   => 'required|in:Male,Female',
        ];

        // If any of these are missing in Postman, it shows the error list you wanted
        $this->validate($request, $rules);
        
        $user = User::create($request->all());
        
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * SHOW ONE USER
     * URL: GET http://localhost:8000/users/{id}
     */
    public function show($id)
    {
        $user = User::findOrFail($id); 
        return $this->successResponse($user);
    }

    /**
     * UPDATE EXISTING USER
     * URL: PUT/PATCH http://localhost:8000/users/{id}
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender'   => 'in:Male,Female',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($id);
        
        // Fill the model with the new data
        $user->fill($request->all());

        // Check if anything actually changed
        if ($user->isClean()) {
            return $this->errorResponse(
                'At least one value must change', 
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user->save();
        return $this->successResponse($user);
    }

    /**
     * DELETE A USER
     * URL: DELETE http://localhost:8000/users/{id}
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->successResponse($user);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminCreateRequest; // Import the new request class
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Info(
 *     title="Your API Title",
 *     version="1.0",
 *     description="Description of your API",
 * )
 * @OA\Tag(
 *     name="Admin",
 *     description="Admin management"
 * )
 */
class AdminController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/admin/create",
     *     summary="Create a new admin account",
     *     tags={"Admin"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="address", type="string"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */

     // Create a new admin account
    public function create(AdminCreateRequest $request)
    {
        // Create a new admin user
        $admin = new User();
        $admin->uuid = Uuid::uuid4()->toString();
        $admin->name = $request->input('name');
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->address = $request->input('address');
        $admin->phone_number = $request->input('phone_number');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->is_admin = true;
        $admin->save();

        return response()->json(['message' => 'Admin created successfully']);
    }

        // Admin login
    public function login(Request $request)
    {
        // Implement admin login logic here and generate a JWT token
    }

        // Admin logout
    public function logout(Request $request)
    {
        // Implement admin logout logic here
    }

        // Get user listing (non-admins)
    public function userListing(Request $request)
    {
        // Implement user listing logic here
    }

        // Edit user account by UUID
    public function editUser(Request $request, $uuid)
    {
        // Implement user editing logic here
    }

        // Delete user account by UUID
    public function deleteUser(Request $request, $uuid)
    {
        // Implement user deletion logic here
    }
}

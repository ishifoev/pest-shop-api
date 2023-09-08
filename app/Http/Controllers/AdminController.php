<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use App\Services\TokenService;

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
     *     ),
     *     @OA\SecurityScheme(
     *         securityScheme="bearerAuth",
     *         in="header",
     *         name="Authorization",
     *         type="http",
     *         scheme="bearer",
     *         bearerFormat="JWT",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
     // Create a new admin account
    public function create(AdminCreateRequest $request)
    {
        $admin = new User([
            'uuid' => Str::uuid(),
            'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_admin' => true,
        ]);
    
        $admin->save();
        // Generate a JWT token for the new admin
        $userUuid = $admin->uuid;

       
        $token = TokenService::generateToken($userUuid);

        return response()->json(['token' => $token, 'message' => 'Admin registered successfully']);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/login",
     *     summary="Admin Login",
     *     tags={"Admin"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", example="adminpassword"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="your_jwt_token_here")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid email or password")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        // Validate the incoming request data (e.g., email, password, etc.)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the provided credentials match an admin account
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_admin' => true])) {
            // Generate and return a JWT token
            $userUuid = Uuid::uuid4()->toString();

            $token = TokenService::generateToken($userUuid);

            return response()->json(['token' => (string) $token]);
        } else {
            // Return a validation error response
            return response()->json(['message' => 'Invalid email or password'], 422);
        }
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

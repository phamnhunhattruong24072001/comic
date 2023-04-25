<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\PersonalAccessToken;
use App\Services\Admin\ClientService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;

class AuthController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function register(ClientRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->clientService->storeModel($data);
        return $this->sendResult(Response::HTTP_OK, 'Register', '');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['username', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->sendError(Response::HTTP_UNAUTHORIZED, 'Error');
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = explode('|', $tokenResult->plainTextToken);
            return $this->sendResult(Response::HTTP_OK, 'Login Success', [
                'access_token' => $token[1],
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'avatar' => $user->avatar,
                    'name' => $user->name,
                    'email' => $user->email,
                    'birthday' => $user->birth_day,
                    'gender' => $user->gender,
                ],
            ], true);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        $token = $request->header('Authorization');
        $tokenColumn = PersonalAccessToken::findToken($token);
        $tokenColumn->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Success'
        ]);
    }
}

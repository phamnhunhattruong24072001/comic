<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
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
        $this->data['success'] = 200;
        return $this->sendResult(Response::HTTP_OK, 'Register', $this->data);
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
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now('Asia/Ho_Chi_Minh')->addWeeks(1);
            }
            $token->expires_at = Carbon::now('Asia/Ho_Chi_Minh')->addDays(2);
            $token->save();
            return $this->sendResult(Response::HTTP_OK, 'Login Success', [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
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
}

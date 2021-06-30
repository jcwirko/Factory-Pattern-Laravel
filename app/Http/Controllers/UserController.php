<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\CountryGetterService;
use App\Repositories\FileUploaderService;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $countryGetterService;
    private $fileUploaderService;

    public function __construct(UserRepository $userRepository, CountryGetterService $countryGetterService, FileUploaderService $fileUploaderService)
    {
        $this->userRepository = $userRepository;
        $this->countryGetterService = $countryGetterService;
        $this->fileUploaderService = $fileUploaderService;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }

    public function show(int $id)
    {
        $user = $this->userRepository->get($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User($request->all());
        $user = $this->userRepository->save($user);

        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user = $this->userRepository->save($user);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user = $this->userRepository->delete($user);

        return response()->json($user);
    }
}

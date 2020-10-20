<?php
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function show(string $slug, Request $request)
    {
        $user = $this->userRepository->findBySlug($slug);

        return view('pages.user.users.show', [
            'user' => $user,
        ]);
    }

    public function edit(string $slug, Request $request)
    {
        $user = $this->userRepository->findBySlug($slug);

        $this->authorize('user-user-can-edit', $user);

        return view('pages.user.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(string $slug, Request $request)
    {
        $user = $this->userRepository->findBySlug($slug);

        $this->authorize('user-user-can-edit', $user);

        $input = $request->only($this->userRepository->getBlankModel()->getFillable());
        $user  = $this->userRepository->update($user, $input);

        return redirect(route('user.users.show', $slug))->with([
            'toast' => [
                'status'  => 'success',
                'message' => '編集しました',
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Swipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $auth = User::find(Auth::id());

        $swipedUserIds = $auth->from_users()->get()->pluck('id');
        
        $user = User::where('id', '<>', $auth->id)->whereNotIn('id', $swipedUserIds)->first();

        return view('users.index', compact('user'));
    }

    public function store(Request $request, User $user)
    {

        $swipes = $user->from_users();
        //updateOrCreate()
        $swipes->syncWithoutDetaching([$request->except('_token')]);
        $is_like_auth = $swipes->wherePivot('to_user_id', Auth::id())->wherePivot('is_like', true)->exists();

        //auth
        if ($request->is_like) {
            //is_like true
            if ($is_like_auth) {
                //true
                return redirect()->route('users.index')->with('flash_message', 'Matched');
            }
        }
        //false
        return redirect()->route('users.index');
    }

    public function matches()
    {
        $auth = User::find(Auth::id());
        //matches()
        $users = $auth->matches()->orderBy('id','asc')->get();

        return view('users.matches', compact('users'));
    }

    public function matches_show($num)
    {
        $auth = User::find(Auth::id());
        $match_users = $auth->matches()->orderBy('id', 'asc')->get()->collect();
        $main_user = $match_users[$num];
        $count = $match_users->count();
        $prev = $num - 1 < 0 ? $num : $num - 1;
        $next = $num + 1 > $count - 1 ? $num : $num + 1;

        return view('users.matches_show', compact('match_users', 'main_user', 'prev', 'next', 'num'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\UserAccount;
use App\Profile;

class TestController extends Controller
{
    public function get(Request $request) {
        self::processing();

        $users = User::with(['profile'])
            ->get();
        return response()->json([
            'status' => 'OK',
            'users' => $users
        ], 200);
    }

    public function processing () {
        self::createUsers(true, true, 1, 20);   
    }

    public function createUsers ($run = false, $first = false, $from = 1, $to = 10) {
        if ($run) {
            if ($first) {
                DB::table('users')->truncate();
                DB::table('user_accounts')->truncate();
                DB::table('profiles')->truncate();
            }

            $i = $from;
            while ($i <= $to)
            {
                // New user
                $newUser = new User();
                $newUser->email = 'innova'.$i.'@mail.ru';
                $newUser->save();

                // New profile
                $newProfile = new Profile();
                $newProfile->user_id = $newUser->id;
                $newProfile->nickname = 'User #'.$i++;
                $newProfile->save();

                // New user account

                // - Real - //
                $newAccount = new UserAccount();
                $newAccount->user_id = $newUser->id;
                $newAccount->type = UserAccount::REAL;
                $newAccount->save();

                // - IG Gold - //
                $newAccount = new UserAccount();
                $newAccount->user_id = $newUser->id;
                $newAccount->type = UserAccount::IG_GOLD;
                $newAccount->save();
            }
        }
    }

    public function addPartner($from, $to) {
        if (($from > 0) && ($to > 0)) {
            Partner::where('from', $from)
            ->where('to', $to)
            ->firstOrCreate([
                'from' => $from,
                'to' => $to
            ]);
        }
    }







}
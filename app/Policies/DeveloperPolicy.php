<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeveloperPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // assign team             
    public function assignTeam(User $user, array $attributes)
    {
        Log::info('checking if can');
        Log::info($user);
        // TODO: practical use base on user (add role to user?)
        // TODO: only if, that developers_team (by team_id && developer_id does not exists)
        $developer_team =  DB::table('developers_team')
            ->where(
                [
                    'team_id', $attributes['team_id'],
                    'developer_id', $attributes['id']
                ]
            )
            ->get();
        Log::info($developer_team);   
        return $developer_team;
    }
}

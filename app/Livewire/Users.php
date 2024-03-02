<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;

class Users extends Migrator
{
    public function render()
    {
        return view('livewire.users');
    }

    protected function clean()
    {
        DB::connection('new')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // truncate tables

        \App\Models\New\User::truncate();
        \App\Models\New\UserGroup::truncate();
        \App\Models\New\UserSettings::truncate();

        DB::connection('new')->statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function migrar()
    {

        $this->clean();

        // Migrate all the users
        $rolesMap = [
            1 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18], // Admin
            16 => [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18], // Revista manager
            17 => [17], // Lector
            256 => [14, 17], // Revisor
            512 => [14, 17], // Author
            4096 => [16, 14, 17], // Revisor, author y lector
            65536 => [14, 17], // Author
            1048576 => [17], // Lector
        ];

        $defaultGroup = [17];

        $total = [
            'users' => 0,
            'user_settings' => 0,
            'user_user_groups' => 0,

            'authors' => 0,
            'author_settings' => 0
        ];

        foreach (\App\Models\Old\User::with(['roles'])->cursor() as $old_user) {

            $groups = [];

            foreach ($old_user->roles as $role) {
                if (isset($rolesMap[$role->role_id])) {
                    $groups = array_merge($rolesMap[$role->role_id], $groups);
                    break;
                }
            }

            if (empty($groups)) {
                $groups = $defaultGroup;
            }

            $newUserData = [
                'user_id' => $old_user->user_id,
                'username' => $this->cleanStrings($old_user->username),
                'email' => $this->cleanStrings($old_user->email),
                'url' => $old_user->url,
                'phone' => $old_user->phone,
                'mailing_address' => $old_user->mailing_address,
                'billing_address' => $old_user->billing_address,
                'country' => $old_user->country,
                'locales' => $old_user->locales,
                'gossip' => '',
                'date_last_email' => $old_user->date_last_email,
                'date_registered' => $old_user->date_registered,
                'date_validated' => $old_user->date_validated,
                'date_last_login' => $old_user->date_last_login,
                'auth_id' => $old_user->auth_id,
                'auth_str' => $old_user->auth_str,
                'disabled' => $old_user->disabled,
                'disabled_reason' => $old_user->disabled_reason,
                'inline_help' => $old_user->inline_help,

                'must_change_password' => 1,
                'password' => bcrypt($this->cleanStrings($old_user->email))
            ];

            $newUser = \App\Models\New\User::create($newUserData);

            $total['users']++;

            sort($groups);

            foreach (array_unique($groups) as $group) {
                $newUser->roles()->create(['user_group_id' => $group]);

                $total['user_user_groups']++;
            }

            $settings = [
                [
                    'setting_name' => 'familyName',
                    'setting_value' => $this->cleanStrings($old_user->last_name)
                ],
                [
                    'setting_name' => 'givenName',
                    'setting_value' => $this->cleanStrings($old_user->first_name . ' ' . $old_user->middle_name)
                ]
            ];

            foreach ($settings as $setting) {
                $newUser->settings()->create(
                    [
                        ...$setting,
                        'locale' => 'es_Es',
                        'assoc_type' => 0,
                        'assoc_id' => 0,
                        'setting_type' => 'string'
                    ]
                );
            }

            $total['user_settings'] += 2;

            foreach ($old_user->settings as $settings) {

                $setting = $settings->toArray();

                if ($setting['setting_name'] == 'gossip') {
                    continue;
                }

                $settings['setting_value'] = $this->cleanStrings($setting['setting_value']);

                $newUser->settings()->create($setting);

                $total['user_settings']++;
            }
        }

        $this->total = $total;
    }
}

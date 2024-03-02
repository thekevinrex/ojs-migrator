<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;

class Authors extends Migrator
{
    public function render()
    {
        return view('livewire.authors');
    }

    protected function clean()
    {
        DB::connection('new')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // truncate tables

        \App\Models\New\Authors::truncate();
        \App\Models\New\AuthorsSettings::truncate();

        DB::connection('new')->statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function migrar()
    {

        $this->clean();

        $total = [
            'authors' => 0,
            'author_settings' => 0
        ];

        // Migrate all the authors info

        foreach (\App\Models\Old\Authors::with('settings')->cursor() as $old_author) {

            $user_group = 14;

            $newAuthorData = [
                'author_id' => $old_author->author_id,
                'publication_id' => $old_author->submission_id,
                'email' => $old_author->email,
                'include_in_browse' => 1,
                'seq' => $old_author->seq,
                'user_group_id' => $user_group
            ];

            $newAuthor = \App\Models\New\Authors::create($newAuthorData);

            $total['authors']++;

            $settings = [
                [
                    'locale' => 'en_US',
                    'setting_name' => 'familyName',
                    'setting_value' => $this->cleanStrings($old_author->first_name . ' ' . $old_author->middle_name),
                ],
                [
                    'locale' => 'es_ES',
                    'setting_name' => 'familyName',
                    'setting_value' => $this->cleanStrings($old_author->first_name . ' ' . $old_author->middle_name),
                ],
                [
                    'locale' => 'es_ES',
                    'setting_name' => 'givenName',
                    'setting_value' => $this->cleanStrings($old_author->last_name),
                ],
                [
                    'locale' => 'en_US',
                    'setting_name' => 'givenName',
                    'setting_value' => $this->cleanStrings($old_author->last_name),
                ],
            ];

            foreach ($settings as $setting) {
                $newAuthor->settings()->create($setting);
            }

            $total['author_settings'] += 4;

            foreach ($old_author->settings as $setting) {

                $settingData = [
                    'locale' => $setting->locale,
                    'setting_name' => $setting->setting_name,
                    'setting_value' => $this->cleanStrings($setting->setting_value),
                ];

                $newAuthor->settings()->create($settingData);

                $total['author_settings']++;
            }
        }

        $this->total = $total;
    }
}

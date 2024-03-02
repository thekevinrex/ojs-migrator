<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;

class Publications extends Migrator
{
    public function render()
    {
        return view('livewire.publications');
    }

    protected function clean()
    {
        DB::connection('new')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // truncate tables

        // Truncate all the publications tables
        \App\Models\New\Files::truncate();

        \App\Models\New\Submission::truncate();
        \App\Models\New\Publication::truncate();

        \App\Models\New\SubmissionFiles::truncate();
        \App\Models\New\SubmissionFileSettings::truncate();
        \App\Models\New\PublicationGalleys::truncate();

        \App\Models\New\PublicationSettings::truncate();

        DB::connection('new')->statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function migrar()
    {

        $this->clean();

        $total = [
            'submissions' => 0,
            'submission_files' => 0,
            'submission_file_settings' => 0,

            'publications' => 0,
            'publication_settings' => 0,
            'publication_galleys' => 0,

            'files' => 0,
        ];

        // Migrate all the articles info
        foreach (\App\Models\Old\PublishedArticles::with([
            'article' => [
                'settings', 'galleys' => ['file']
            ]
        ])->cursor() as $publishedArticle) {

            $newSubmisionData = [
                'submission_id' => $publishedArticle->article_id,
                'context_id' => 1,
                'current_publication_id' => $publishedArticle->article_id,

                'date_last_activity' => $publishedArticle->date_published,
                'date_submitted' => $publishedArticle->date_published,
                'last_modified' => $publishedArticle->date_published,

                'stage_id' => 5,
                'locale' => $publishedArticle->article->locale,
                'status' => 3,
                'submission_progress' => 0,
                'work_type' => 0
            ];

            $submission = \App\Models\New\Submission::create($newSubmisionData);

            $total['submissions']++;

            $newPublicationData = [
                'publication_id' => $publishedArticle->article_id,
                'date_published' => $publishedArticle->date_published,
                'access_status' => 0,
                'primary_contact_id' => null,

                'section_id' => $publishedArticle->article->section_id, // change

                'status' => 3,
                'seq' => $publishedArticle->seq,
                'url_path' => null,
                'version' => 1,

                'last_modified' => $publishedArticle->article->last_modified,
                'locale' => $publishedArticle->article->locale,
            ];

            $publication = $submission->publications()->create($newPublicationData);

            $total['publications']++;

            $settings = [
                [
                    'setting_name' => 'categoryIds',
                    'setting_value' => '',
                ],
                [
                    'setting_name' => 'issueId',
                    'setting_value' => $publishedArticle->issue_id,
                ],
                // [
                //     'setting_name' => 'issueId',
                //     'setting_value' => $publishedArticle->issue_id,
                // ],
                // [
                // 'setting_name' => 'copyrightYear',
                // // Get the year from the published article date_published
                // // 'setting_value' => date('Y', strtotime($publishedArticle->date_published)),
                // 'setting_value' => 2021,
                // ],
                [
                    'setting_name' => 'copyrightHolder',
                    'setting_value' => 'rcci',
                ],
            ];

            foreach ($settings as $setting) {
                $publication->settings()->create([
                    'publication_id' => $publication->publication_id,
                    'locale' => $publication->locale,
                    ...$setting
                ]);
            }

            $total['publication_settings'] += 3;


            foreach ($publishedArticle->article->settings as $setting) {

                if (in_array(
                    $setting['setting_name'],
                    array_map(fn ($setting) => $setting['setting_name'], $settings)
                )) {
                    continue;
                }

                if (!in_array($setting['setting_name'], ['abstract', 'cleanTitle', 'title'])) {
                    continue;
                }

                $settingData = [
                    'locale' => $setting->locale,
                    'setting_name' => $setting->setting_name,
                    'setting_value' => $this->cleanStrings($setting->setting_value),
                ];

                if ($setting->setting_name === 'cleanTitle') {
                    $settingData['setting_name'] = 'subtitle';
                }

                $publication->settings()->create($settingData);

                $total['publication_settings']++;
            }

            foreach ($publishedArticle->article->galleys as $galley) {

                if (!isset($galley->file)) {
                    continue;
                }

                $fileData = [
                    'path' => 'journals/1/articles/' . $publishedArticle->article_id . '/public/' . $galley->file->file_name,
                    'mimetype' => $galley->file->file_type
                ];

                $file = \App\Models\New\Files::create($fileData);

                $total['files']++;

                $submissionFileData = [
                    'file_id' => $file->file_id,
                    'uploader_user_id' => $publishedArticle->article->user_id,

                    'genre_id' => 1,
                    'file_stage' => 2,

                    'source_submission_file_id' => null,
                    'direct_sales_price' => null,
                    'sales_type' => null,
                    'viewable' => null,

                    'assoc_type' => null,
                    'assoc_id' => null,
                ];

                $submissionFile = $submission->files()->create($submissionFileData);

                $submissionFile->settings()->create([
                    'locale' => $submission->locale,
                    'setting_name' => 'name',
                    'setting_value' => $galley->file->file_name,
                    'setting_type' => 'string',
                ]);

                $total['submission_files']++;
                $total['submission_file_settings']++;

                $galleyData = [
                    'label' => $galley->label,
                    'locale' => $galley->locale,
                    'seq' => $galley->seq,
                    'remote_url' => $galley->remote_url,

                    'is_approved' => 1,
                    'url_path'  => null,

                    'submission_file_id' => $file->file_id,
                ];

                $publication->galleys()->create($galleyData);

                $total['publication_galleys']++;
            }
        }

        $this->total = $total;
    }
}

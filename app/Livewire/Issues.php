<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;

class Issues extends Migrator
{
    public function render()
    {
        return view('livewire.issues');
    }

    protected function clean()
    {
        // Clean data
        \App\Models\New\Issues::truncate();
        \App\Models\New\IssueSettings::truncate();
        \App\Models\New\Section::truncate();
        \App\Models\New\SectionSettings::truncate();
    }

    public function migrar()
    {

        $this->clean();

        $total = [
            'issues' => 0,
            'issues_settings' => 0,

            'sections' => 0,
            'section_settings' => 0,
        ];

        foreach (\App\Models\Old\Section::with('settings')->cursor() as $section) {

            \App\Models\New\Section::create([
                'section_id' => $section->section_id,
                'journal_id' => $section->journal_id,
                'review_form_id' => $section->review_form_id,
                'seq' => $section->seq,
                'editor_restricted' => $section->editor_restricted,
                'meta_indexed' => $section->meta_indexed,
                'meta_reviewed' => $section->meta_reviewed,
                'abstracts_not_required' => $section->abstracts_not_required,
                'hide_title' => $section->hide_title,
                'hide_author' => $section->hide_author,
                'is_inactive' => 0,
                'abstract_word_count' => $section->abstract_word_count,
            ]);

            $total['sections']++;

            foreach ($section->settings as $setting) {

                $setting->setting_value = $this->cleanStrings($setting->setting_value);

                $total['section_settings']++;

                \App\Models\New\SectionSettings::create($setting->toArray());
            }
        }

        // Migrate all the issues info

        foreach (\App\Models\Old\Issues::with('issueSettings')->orderBy('issue_id', 'asc')->cursor() as $old_issue) {

            $old_issue->last_modified = Carbon::now();

            $newIssue = \App\Models\New\Issues::create($old_issue->toArray());

            $total['issues']++;

            foreach ($old_issue->issueSettings as $settings) {

                $settings->setting_value = $this->cleanStrings($settings->setting_value);

                $newIssue->issueSettings()->create($settings->toArray());

                $total['issues_settings']++;
            }
        }

        $this->total = $total;
    }
}

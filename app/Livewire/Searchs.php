<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Searchs extends Migrator
{
    public function render()
    {
        return view('livewire.searchs');
    }

    protected function clean()
    {
        \App\Models\New\SubmissionSearchKeywords::truncate();
        \App\Models\New\SubmissionSearchObjects::truncate();
        // \App\Models\New\SubmissionSearchObjectsKeywords::truncate();
    }

    public function migrar()
    {

        $this->clean();

        $total = [
            'submission_search_keyword_list' => 0,
            'submission_search_objects' => 0,
            'submission_search_object_keywords' => 0
        ];

        $new_search_keywords = 'submission_search_keyword_list';
        $new_search_objects = 'submission_search_objects';
        $new_search_objects_keywords = 'submission_search_object_keywords';

        // keywords

        $query = 'insert into ' . $new_search_keywords . ' (keyword_id, keyword_text) values ';

        $keywords = [];

        foreach (\App\Models\Old\ArticleSearchKeywords::cursor() as $keyword) {

            $keyword_id = $keyword->keyword_id;
            $keyword_text = $keyword->keyword_text;

            $keywords[] = "({$keyword_id},'{$keyword_text}')";
        }

        $query .= implode(',', $keywords) . ';';

        $total['submission_search_keyword_list'] = count($keywords);

        DB::connection('new')->insert($query);

        // objects

        $query = 'insert into ' . $new_search_objects . ' (`object_id`, `submission_id`, `type`, `assoc_id`) values ';
        $objects = [];

        foreach (\App\Models\Old\ArticleSearchObjects::cursor() as $object) {

            $object_id = $object->object_id;
            $article_id = $object->article_id;
            $type = $object->type;
            $assoc = $object->assoc_id;

            $objects[] = "({$object_id},{$article_id},{$type},{$assoc})";
        }

        $query .= implode(',', $objects) . ';';

        $total['submission_search_objects'] = count($objects);

        DB::connection('new')->insert($query);

        // objects keywords


        // $query = 'insert into ' . $new_search_objects_keywords . ' (`object_id`, `keyword_id`, `pos`) values ';
        // $objects_keywords = [];

        // foreach (\App\Models\Old\ArticleSearchObjectsKeywords::cursor() as $object) {

        //     $object_id = $object->object_id;
        //     $keyword_id = $object->keyword_id;
        //     $pos = $object->pos;

        //     $objects_keywords[] = "({$object_id},{$keyword_id},{$pos})";
        // }

        // $query .= implode(',', $objects_keywords) . ';';

        // $total['submission_search_object_keywords'] = count($objects_keywords);

        // DB::connection('new')->insert($query);



        $this->total = $total;
    }
}

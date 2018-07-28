<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'art_access',],
            ['id' => 18, 'title' => 'art_create',],
            ['id' => 19, 'title' => 'art_edit',],
            ['id' => 20, 'title' => 'art_view',],
            ['id' => 21, 'title' => 'art_delete',],
            ['id' => 22, 'title' => 'paper_access',],
            ['id' => 23, 'title' => 'paper_create',],
            ['id' => 24, 'title' => 'paper_edit',],
            ['id' => 25, 'title' => 'paper_view',],
            ['id' => 26, 'title' => 'paper_delete',],
            ['id' => 32, 'title' => 'judgement_access',],
            ['id' => 33, 'title' => 'judgement_create',],
            ['id' => 34, 'title' => 'judgement_edit',],
            ['id' => 35, 'title' => 'judgement_view',],
            ['id' => 36, 'title' => 'judgement_delete',],
            ['id' => 37, 'title' => 'content_management_access',],
            ['id' => 38, 'title' => 'content_management_create',],
            ['id' => 39, 'title' => 'content_management_edit',],
            ['id' => 40, 'title' => 'content_management_view',],
            ['id' => 41, 'title' => 'content_management_delete',],
            ['id' => 42, 'title' => 'content_category_access',],
            ['id' => 43, 'title' => 'content_category_create',],
            ['id' => 44, 'title' => 'content_category_edit',],
            ['id' => 45, 'title' => 'content_category_view',],
            ['id' => 46, 'title' => 'content_category_delete',],
            ['id' => 47, 'title' => 'content_tag_access',],
            ['id' => 48, 'title' => 'content_tag_create',],
            ['id' => 49, 'title' => 'content_tag_edit',],
            ['id' => 50, 'title' => 'content_tag_view',],
            ['id' => 51, 'title' => 'content_tag_delete',],
            ['id' => 52, 'title' => 'content_page_access',],
            ['id' => 53, 'title' => 'content_page_create',],
            ['id' => 54, 'title' => 'content_page_edit',],
            ['id' => 55, 'title' => 'content_page_view',],
            ['id' => 56, 'title' => 'content_page_delete',],
            ['id' => 57, 'title' => 'user_action_access',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}

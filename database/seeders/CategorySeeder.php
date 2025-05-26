<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'category_name'=>'Techology',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Health',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Lifestyle',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Travel',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Food',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Education',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Entertainment',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Finance',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Sports',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Fashion',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Business',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Science',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Politics',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'History',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Art',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Music',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'category_name'=>'Gaming',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ];
        DB::table('categories')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Blogs;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Blogs::factory()->count(3)->sequence(
            ['title' => 'Lập Trình JavaScript Cơ Bản',
            'videoID' => '0SJE9dYdpps',
            ],
            ['title' => 'Lập Trình JavaScript Nâng Cao',
             'videoID' => 'MGhw6XliFgo',
            ],
            ['title' => 'HTML CSS từ Zero đến Hero',
             'videoID' => 'R6plN3FvzFY',
            ],
        )->forUser([
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'role_id' => 0
        ])
        ->create();
    }
}

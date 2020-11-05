<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels= Channel::create([
            'name'=>'Laravel version',
            'slug'=> Str::slug('Laravel version','-')
        ]);

        $channels= Channel::create([
            'name'=>'Vue js',
            'slug'=> Str::slug('Vue js','-')
        ]);

        $channels= Channel::create([
            'name'=>'Angular',
            'slug'=> Str::slug('Angular','-')
        ]);

        $channels= Channel::create([
            'name'=>'Node js',
            'slug'=> Str::slug('Node js','-')
        ]);
    }
}

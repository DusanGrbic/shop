<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'image_path' => 'https://tctechcrunch2011.files.wordpress.com/2014/06/firefly.jpg',
            'title' => 'Firefly',
            'description' => 'Best TV show in the \'verse. Five hundred years in the future, a renegade crew aboard a small spacecraft tries to survive as they travel the unknown parts of the galaxy.',
            'price' => 10
        ]);
        
        Product::create([
        'image_path' => 'http://www.theportlygazelle.com/wp-content/uploads/2015/09/gematruna.jpg',
        'title' => 'Game of Thrones',
        'description' => 'HBO\'s epic. Nine noble families fight for control over the lands of Westeros, while a forgotten race returns after being dormant for thousands of years.',
        'price' => 11
        ]);
        
        Product::create([
        'image_path' => 'https://coedmagazine.files.wordpress.com/2016/12/westworld-post-credits-scene-finale-hidden-ending.jpg',
        'title' => 'Westworld',
        'description' => 'Another HBO masterpiece. Set at the intersection of the near future and the reimagined past, explore a world in which every human appetite, can be indulged without consequence.',
        'price' => 12
        ]);
        
        Product::create([
        'image_path' => 'http://redcarpetrefs.com/wp-content/uploads/2016/06/strangerthingsposter-1.jpg',
        'title' => 'Stranger Things',
        'description' => 'Some strange brought to you by Netflix! When a young boy disappears, his mother, a police chief, and his friends, must confront terrifying forces in order to get him back.',
        'price' => 13
        ]);
    }
}

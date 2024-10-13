<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    if (count(Category::all()) > 0) {
      return;
    }
    $categories = [
      [
        'name' => 'Chair',
        'img' =>
          'https://images.pexels.com/photos/116910/pexels-photo-116910.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
      ],
      [
        'name' => 'Dresser',
        'img' =>
          'https://images.pexels.com/photos/271711/pexels-photo-271711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
      ],
      [
        'name' => 'Table',
        'img' =>
          'https://images.pexels.com/photos/276651/pexels-photo-276651.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
      ],
      [
        'name' => 'Bed',
        'img' =>
          'https://images.pexels.com/photos/1571450/pexels-photo-1571450.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
      ],
    ];

    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}

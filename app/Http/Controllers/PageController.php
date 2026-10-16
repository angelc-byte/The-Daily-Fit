<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featuredProducts = [
            ['name' => 'Linen Day Dress', 'category' => 'Women', 'price' => 1499, 'image' => 'images/products/linen-day-dress.jpg'],
            ['name' => 'Classic Knit Top', 'category' => 'Women', 'price' => 899, 'image' => 'images/products/classic-knit-top.jpg'],
            ['name' => 'Everyday Overshirt', 'category' => 'Men', 'price' => 1299, 'image' => 'images/products/everyday-overshirt.jpg'],
            ['name' => 'Relaxed Trousers', 'category' => 'Essentials', 'price' => 1199, 'image' => 'images/products/relaxed-trousers.jpg'],
        ];

        return view('home', compact('featuredProducts'));
    }

    public function about(): View
    {
        return view('about');
    }
}

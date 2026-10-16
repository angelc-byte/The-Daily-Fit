@extends('layouts.app')

@section('title', 'About | The Daily Fit')

@section('content')
    <section class="page-hero page-hero-about">
        <p class="eyebrow">Our story</p>
        <h1>Clothing for the rhythm of everyday life.</h1>
        <p>The Daily Fit is a modern fashion store focused on approachable style, easy combinations, and pieces that feel good from morning to night.</p>
    </section>

    <section class="section story-grid">
        <div class="story-art">
            <span>The<br>Daily<br>Fit</span>
        </div>
        <div class="story-copy">
            <p class="eyebrow">Why we started</p>
            <h2>Getting dressed should feel simple.</h2>
            <p>We created The Daily Fit for people who want a reliable wardrobe without losing personality. Our collections combine clean lines, soft neutral colors, and practical silhouettes that work across different occasions.</p>
            <p>This Laravel application rebuilds the original POS concept while demonstrating clear routes, controller responsibilities, Blade templates, and data passed from controllers to views.</p>
            <div class="values-grid">
                <div><strong>Comfort</strong><span>Pieces you can move in</span></div>
                <div><strong>Versatility</strong><span>Looks that work together</span></div>
                <div><strong>Confidence</strong><span>Style that feels natural</span></div>
            </div>
        </div>
    </section>
@endsection

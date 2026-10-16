@extends('layouts.app')

@section('title', 'Home | The Daily Fit')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">New season essentials</p>
            <h1>Style that feels like you.</h1>
            <p>Discover effortless pieces made for workdays, weekends, and every moment in between.</p>
            <div class="hero-actions">
                <a class="button button-dark" href="#featured">Explore the collection</a>
                <a class="button button-light" href="{{ route('about') }}">Our story</a>
            </div>
        </div>
        <div class="hero-visual" aria-label="Abstract fashion display">
            <div class="fashion-shape shape-one"></div>
            <div class="fashion-shape shape-two"></div>
            <div class="fashion-shape shape-three"></div>
            <span>Daily essentials<br>with a refined fit.</span>
        </div>
    </section>

    <section class="section" id="featured">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Curated for you</p>
                <h2>Featured pieces</h2>
            </div>
            <p>Simple silhouettes, versatile colors, and comfortable materials for everyday wear.</p>
        </div>

        <div class="product-grid">
            @foreach ($featuredProducts as $product)
                <article class="product-card">
                    <div class="product-art">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product-details">
                        <div>
                            <p>{{ $product['category'] }}</p>
                            <h3>{{ $product['name'] }}</h3>
                        </div>
                        <strong>&#8369;{{ number_format($product['price'], 2) }}</strong>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="feature-strip">
        <div><strong>Thoughtful choices</strong><span>Versatile pieces selected with care</span></div>
        <div><strong>Easy shopping</strong><span>A clean and comfortable store experience</span></div>
        <div><strong>Everyday confidence</strong><span>Looks designed around real life</span></div>
    </section>
@endsection

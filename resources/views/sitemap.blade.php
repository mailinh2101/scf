<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    {{-- Homepage --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- About --}}
    <url>
        <loc>{{ url('/gioi-thieu') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- Products --}}
    <url>
        <loc>{{ url('/san-pham') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    @foreach (\App\Models\Product::where('published', true)->get() as $product)
        <url>
            <loc>{{ url('/san-pham?category=' . $product->category) }}</loc>
            <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
            @if ($product->image)
                <image:image>
                    <image:loc>{{ asset_url($product->image) }}</image:loc>
                    <image:title>{{ $product->title }}</image:title>
                </image:image>
            @endif
        </url>
    @endforeach

    {{-- Blog --}}
    <url>
        <loc>{{ url('/tin-tuc') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    @foreach (\App\Models\Post::whereNotNull('published_at')->get() as $post)
        <url>
            <loc>{{ url('/tin-tuc/' . $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
            @if ($post->featured_image)
                <image:image>
                    <image:loc>{{ asset_url($post->featured_image) }}</image:loc>
                    <image:title>{{ $post->title }}</image:title>
                </image:image>
            @endif
        </url>
    @endforeach

    {{-- Jobs --}}
    <url>
        <loc>{{ url('/tuyen-dung') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach (\App\Models\Job::where('published', true)->get() as $job)
        <url>
            <loc>{{ url('/tuyen-dung/' . $job->slug) }}</loc>
            <lastmod>{{ $job->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Contact --}}
    <url>
        <loc>{{ url('/lien-he') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

</urlset>

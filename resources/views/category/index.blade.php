@extends('layouts.main')

@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Categories</h1>
        <section class="featured-posts-section">
            <div class="row">
            <ul class="navbar-nav mt-2 mt-lg-0, border-ul ">
                @foreach($categories as $category)
                <li class="nav-item active"><a href="{{ route('category.post.index', $category->id) }}">{{ $category->title }}</a></li>
                @endforeach
            </ul>
            </div>
        </section>
    </div>

</main>
@endsection



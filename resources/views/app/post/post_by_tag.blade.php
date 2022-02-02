@extends('layouts.app')

@push('styles')
    <style>
        @media (min-width: 1100px){
            .blog_area {
                padding-top: 120px;
                padding-bottom: 120px;
            }
        }
        @media (min-width: 900px){
            .blog_area {
                padding-top: 80px;
                padding-bottom: 80px;
            }
        }
        .blog_area {
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>
@endpush

@section('content')
<section class="hero-banner hero-banner--sm mb-30px">
    <div class="container">
        <div class="hero-banner--sm__content">
            <h1>Postingan Berdasarkan Tag</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('app.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('app.post') }}">Postingan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $tag_posts->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="blog_area">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="blog_left_sidebar">
            @foreach ($post_by_tag as $post)
            <article class="row blog_item">
                <div class="col-md-6">
                  <img src="{{ $post->getBanner() }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                  <div class="blog_post">
                    <div class="blog_info">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="post_category d-flex">
                            <div class="icon">
                              <i class="fas fa-th-list mr-3" style="font-size: 18px;"></i>
                            </div>
                            <div>
                              <a class="active" href="{{ route('app.post.category', $post->category->slug) }}" target="_blank">{{ $post->category->name }}</a>
                            </div>
                          </div>
                          <div class="post_tag d-flex">
                            <div class="icon">
                              <i class="fas fa-tags mr-3"></i>
                            </div>
                            <div>
                                @foreach ($post->tags as $post_tags)
                                    <a class="active" href="{{ $post_tags->slug }}">#{{ $post_tags->name }}, </a>
                                @endforeach
                            </div>
  
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="post_meta">
                            <div>
                              <i class="fas fa-user mr-3" style="font-size: 18px;"></i>
                              <span>{{ $post->user->name }}</span>
                            </div>
                            <div>
                              <i class="fas fa-calendar-alt mr-3" style="font-size: 18px;"></i>
                              <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="blog_details">
                      <a href="{{ route('app.post.show', $post->slug) }}">
                        <h2>{{ $post->title }}</h2>
                      </a>
                      <p> {!! \Illuminate\Support\Str::limit($post->content, 80) !!} </p>
                      <a class="button button-blog" href="{{ route('app.post.show', $post->slug) }}">Lanjutkan</a>
                    </div>
                  </div>
                </div>
              </article>
            @endforeach
            {{ $post_by_tag->links() }}
          </div>
        </div>
        <div class="col-lg-4">
            <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Posts">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">
                        <i class="lnr lnr-magnifier"></i>
                      </button>
                    </span>
                  </div>
                  <!-- /input-group -->
                  <div class="br"></div>
                </aside>
                <aside class="single_sidebar_widget ads_widget">
                  <a href="#">
                    <img class="img-fluid" src="{{ asset('app/img/blog/add.jpg') }}" alt="">
                  </a>
                  <div class="br"></div>
                </aside>
                <aside class="single_sidebar_widget post_category_widget">
                  <h4 class="widget_title">Post Catgories</h4>
                  <ul class="list cat-list">
                    @foreach ($categories as $category)
                      <li>
                        <a href="{{ route('app.post.category', $category->slug) }}" class="d-flex justify-content-between">
                          <p>{{ $category->name }}</p>
                          <p>{{ $category->posts->where('status', '=', 1)->count() }}</p>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                  <div class="br"></div>
                </aside>
                <aside class="single-sidebar-widget tag_cloud_widget">
                  <h4 class="widget_title">Tag</h4>
                  <ul class="list">
                      @foreach ($tags as $tag)
                        <li>
                            <a href="{{ route('app.post.tag',$tag->slug) }}">#{{ $tag->name }}</a>
                        </li>
                      @endforeach   
                  </ul>
                </aside>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
    
@endpush
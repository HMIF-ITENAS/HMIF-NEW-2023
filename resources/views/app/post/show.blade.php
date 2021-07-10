@extends('layouts.app')

@push('styles')
    
@endpush

@section('content')
    <!--================ Hero sm Banner start =================-->
	<section class="hero-banner hero-banner--sm mb-30px">
		<div class="container">
			<div class="hero-banner--sm__content">
				<h1>Blog Details</h1>
				<nav aria-label="breadcrumb" class="banner-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Blog Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>
	<!--================ Hero sm Banner end =================-->


	<!--================Blog Area =================-->
	<section class="blog_area single-post-area section-margin--medium">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 posts-list">
					<div class="single-post row">
						<div class="col-lg-12">
							<div class="feature-img">
								<img class="img-fluid" src="{{ $post->getBanner() }}" alt="">
							</div>
						</div>
						<div class="col-lg-3  col-md-3">
							<div class="blog_info text-right">
                                <div class="post_category">
                                    <span>Kategori : </span>
                                    <a href="{{ route('app.post.category',$post->category->slug) }}" class="active">{{ $post->category->name }}</a>
                                </div>
								<div class="post_tag">
                                    <span>Tag : </span>
									@foreach ($post->tags as $post_tags)
                                        <a class="active" href="{{ route('app.post.tag',$post_tags->slug) }}">#{{ $post_tags->name }}, </a>
                                    @endforeach
								</div>
								<ul class="blog_meta list">
									<li>
										<a href="#">{{ $post->user->name }}
											<i class="lnr lnr-user"></i>
										</a>
									</li>
									<li>
										<a href="#">{{ $post->created_at->diffForHumans() }}
											<i class="lnr lnr-calendar-full"></i>
										</a>
									</li>
								</ul>
								<ul class="social-links">
									<li>
										<a href="#">
											<i class="fab fa-facebook-f"></i>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fab fa-twitter"></i>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fab fa-github"></i>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fab fa-behance"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 col-md-9 blog_details">
							<h2>{{ $post->title }}</h2>
							{!! $post->content!!}
						</div>
					</div>
					<div class="navigation-area">
						<div class="row">
							<div
								class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
								<div class="thumb">
									<a href="#">
										<img class="img-fluid" src="img/blog/prev.jpg" alt="">
									</a>
								</div>
								<div class="arrow">
									<a href="#">
										<span class="lnr text-white lnr-arrow-left"></span>
									</a>
								</div>
								<div class="detials">
									<p>Prev Post</p>
									<a href="#">
										<h4>Space The Final Frontier</h4>
									</a>
								</div>
							</div>
							<div
								class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
								<div class="detials">
									<p>Next Post</p>
									<a href="#">
										<h4>Telescopes 101</h4>
									</a>
								</div>
								<div class="arrow">
									<a href="#">
										<span class="lnr text-white lnr-arrow-right"></span>
									</a>
								</div>
								<div class="thumb">
									<a href="#">
										<img class="img-fluid" src="img/blog/next.jpg" alt="">
									</a>
								</div>
							</div>
						</div>
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
                                  <p>{{ $category->posts->count() }}</p>
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
	<!--================Blog Area =================-->
@endsection

@push('scripts')
    
@endpush
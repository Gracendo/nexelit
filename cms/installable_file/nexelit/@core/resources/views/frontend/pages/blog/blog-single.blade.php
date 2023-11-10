@extends('frontend.frontend-page-master')
@php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($blog_post->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 @endphp

@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.blog.single',$blog_post->slug)}}" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="{{$blog_post->title}}" />
    <meta property="og:image" content="{{$post_img}}" />
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$blog_post->meta_description}}">
    <meta name="tags" content="{{$blog_post->meta_tag}}">
@endsection
@section('site-title')
    {{$blog_post->title}}
@endsection
@section('page-title')
    {{$blog_post->title}}
@endsection
@section('content')
    <section class="blog-details-content-area padding-top-100 padding-bottom-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-item">
                        <div class="thumb">
                            @if (!empty($blog_image))
                                <img src="{{$blog_image['img_url']}}" alt="{{__($blog_post->title)}}">
                            @endif
                            @if(!empty($blog_post->video_url))
                            <div class="popup-videos">
                                <a href="{{$blog_post->video_url}}" class="videos-play mfp-iframe" tabindex="0"> <i class="fas fa-play"></i> </a>
                            </div>
                            @endif
                        </div>
                        <div class="entry-content">
                            <ul class="post-meta">
                                <li><i class="fas fa-calendar-alt"></i> {{ date_format($blog_post->created_at,'d M Y')}}</li>
                                <li><i class="fas fa-user"></i> {{ $blog_post->author}}</li>
                                <li>
                                    <div class="cats">
                                        <i class="fas fa-folder"></i>
                                        {!! get_blog_category_by_id($blog_post->blog_categories_id,'link') !!}
                                    </div>
                                </li>
                            </ul>
                           <div class="content-area">
                               {!! $blog_post->content !!}
                           </div>
                        </div>
                        <div class="blog-details-footer">
                        @php
                            $all_tags = explode(',',$blog_post->tags);
                        @endphp
                        @if(count($all_tags) > 1) 
                            <div class="left">
                                <ul class="tags">
                                    <li class="title">{{get_static_option('blog_single_page_'.$user_select_lang_slug.'_tags_title')}}</li>
                                    @foreach($all_tags as $tag)
                                    @php 
                                    $slug = Str::slug($tag);
                                    @endphp 
                                    @if (!empty($slug))
                                        <li><a href="{{route('frontend.blog.tags.page',['name' => $slug])}}">{{$tag}}</a></li>
                                    @endif
                                        
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="right">
                                <ul class="social-share">
                                    <li class="title">{{get_static_option('blog_single_page_'.$user_select_lang_slug.'_share_title')}}</li>
                                    {!! single_post_share(route('frontend.blog.single',$blog_post->slug),$blog_post->title,$post_img) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(count($all_related_blog) > 1)
                    <div class="related-post-area margin-top-40">
                        <div class="section-title ">
                            <h4 class="title ">{{get_static_option('blog_single_page_'.$user_select_lang_slug.'_related_post_title')}}</h4>
                            <div class="related-news-carousel margin-top-30">
                                @foreach($all_related_blog as $data)
                                    @if($data->id === $blog_post->id) @continue @endif
                                    <div class="single-blog-grid-02">
                                        <div class="thumb">
                                            {!! render_image_markup_by_attachment_id($data->image,null,'grid') !!}
                                        </div>
                                        <div class="content">
                                            <h4 class="title"><a href="{{route('frontend.blog.single',$data->slug)}}">{{$data->title}}</a></h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="disqus-comment-area margin-top-40">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                   @include('frontend.pages.blog.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @if(!empty(get_static_option('site_disqus_key')))
    <script>
        var disqus_config = function () {
        this.page.url = "{{route('frontend.blog.single',$blog_post->slug)}}";
        this.page.identifier = "{{$blog_post->id}}";
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = "https://{{get_static_option('site_disqus_key')}}.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    @endif
@endsection

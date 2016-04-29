
<ul class="links-list-alt blog-sidebar">
    @foreach($posts as $other_posts)
    <li class="blog-link">
        <a class="@if (isset($post) && $other_posts->id == $post->id )
                active @endif" href="/posts/{{$other_posts->id}}">{!! $other_posts->title !!}</a>
    </li>
    @endforeach
</ul>

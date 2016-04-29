@foreach($posts as $post)
<div class="post">
    <div class="post-content">
        <div class="post-title">
            <h2>
                @if($post->active != 1)
                  <i class="icon icon-eye-close"></i>&nbsp;
                @endif
                @if(Auth::user())
                    {!! $post->id !!}
                  <a href="/posts/{{$post->id}}/edit">{!! $post->title !!}</a>
                @else
                  <a href="/posts/{{$post->id}}">{!! $post->title !!}</a>
                @endif
            </h2>
        </div>
        <div class="post-description">
            <p>
                @if ($post->rendered_body && $post->rendered_body != 'Not Done Yet')
                    {{ strip_tags(substr($post->rendered_body, 0, 200)) }}
                @else
                    {{ strip_tags(substr($post->body, 0, 200)) }}
                @endif
            </p>
        </div>
    </div>
</div>
@endforeach
@foreach($projects as $project)
<div class="{{$span}} item">
    <div class="picture">
        <a class="image" href="/projects/{{$project->id}}" title="{{$project->title}}">
            <img
                    data-original="{{ ImageToUse::exists($project->photo_file_name) }}"
                    class="lazy"
                    alt="" style="min-width:150px; min-height: 150px"/>
                    <!-- this just helps with the js script that allows lazy loading of images-->
        </a>
        <h4><strong>{{$project->title}}</strong></h4>
        <p>
            {{ strip_tags(substr($project->body, 0, 200)) }}
        </p>
        <div class="meta">
            <span><i class="fa-icon-tags"></i>
                @foreach($project->tags as $tag)
                    <a href="/tags/{{$tag->id}}">{{$tag->name}}</a>
                @endforeach
            </span>
        </div>
    </div>
</div>
@endforeach

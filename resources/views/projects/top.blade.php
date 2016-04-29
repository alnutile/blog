<div id="project-slide" class="media span12">
        <span id="slide1">
            <div class="media">
                <div class="span5 media-img">
                    <img src="{{ ImageToUse::exists($project->photo_file_name) }}" class="img-polaroid media-object">
                </div>
                <div class="span7 media-body">
                    <h3 class="media-heading">{{$project->title}}</h3>
                    <div class="starting">
                       {{$project->body}}
                    </div>
                    <div class="tags">
                        <h3>Tags:</h3>
                        @foreach($project->tags as $tag)
                            <a href="/tags/{{$tag->id}}">{{$tag->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </span>
</div>


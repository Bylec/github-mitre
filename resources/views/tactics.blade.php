<div class="col-3">
    <ul class="list-group">
        @foreach($tactics as $tactic)
            <a href="{{ url('/tactic/' . $tactic->x_mitre_shortname) }}" class="list-group-item list-group-item-action"
               aria-current="true">
                {{$tactic->name}}
            </a>
        @endforeach
    </ul>
</div>

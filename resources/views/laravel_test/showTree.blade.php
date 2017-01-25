<ul>
    @foreach($data as $item)
        <li>{{$item['name']}}
            @if(isset($item['groups']))
                @foreach($item['groups'] as $group)
                    <ul>
                        <li>
                            Group - {{$group['name']}}
                            @if(isset($group['users']))
                            @include('laravel_test.showTree', ['data' => $item['subordinates']])
                            @endif
                        </li>
                    </ul>
                @endforeach
            @endif
        @if(isset($item['subordinates']))
            @include('laravel_test.showTree', ['data' => $item['subordinates']])
        @endif
        </li>
    @endforeach
</ul>

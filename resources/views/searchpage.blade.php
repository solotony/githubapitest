@extends('layout')


@section('content')

{{--    total {{ $url }}<br>--}}
{{--    qry={{ old('qry') }}--}}
{{--    p={{ old('p') }}--}}
{{--    sort={{ old('sort') }}--}}

    @if ($res)
        total {{ $res->total_count  }}

        <table>
            <TR>
                <td>
                    <a href="{{ route('searchpage').'?'.http_build_query(['p'=>old('p'),'qry'=>old('qry'),'sort'=>'name']) }}">name</a>
                </td>
                <td>
                    author
                </td>
                <td>
                    description
                </td>
                <td>
                    <a href="{{ route('searchpage').'?'.http_build_query(['p'=>old('p'),'qry'=>old('qry'),'sort'=>'stars']) }}">stars</a>
                </td>
                <td>
                    contributors
                </td>
            </TR>
        @foreach($res->items as $r)
            <tr>
                <td>
                    <a href="{{ $r->html_url }}">{{ $r->full_name }}</a>
                </td>
                <td>

                    <img src="{{$r->owner->avatar_url}}" style="max-width: 30px" alt="{{$r->owner->login}}">
                    <a href="{{$r->owner->url}}">{{$r->owner->login}}</a><br>
                </td>
                <td>
                    {{ mb_strimwidth($r->description, 0, 300, "...") }}
                </td>
                <td>
                    {{ $r->stargazers_count }}
                </td>

                <td>
                    {{ $r->collaborators_url }}

    {{--                @php--}}
    {{--                    var_dump($r)--}}
    {{--                @endphp--}}
    {{--                @foreach($r->builtBy as $c)--}}
    {{--                    <img src="{{$c->avatar}}" style="max-width: 30px" alt="{{$c->username}}">--}}
    {{--                    <a href="{{$c->href}}">{{$c->username}}</a><br>--}}
    {{--                @endforeach--}}
                </td>
            </tr>
        @endforeach
        </table>
    @endif

@endsection

@section('footer')
    @if ($pg)
{{--        sp={{ $pg['start'] }}--}}
{{--        ep={{ $pg['end'] }}--}}
{{--        cur={{ $pg['cur'] }}--}}
{{--        last={{ $pg['last'] }}--}}
        <div>
            <ul>
                @for($i=$pg['start']; $i<=$pg['end']; $i++)
                    <li>
                        @if ($i==$pg['cur'])
                            <strong>page {{$i}}</strong>
                        @else
                            <a href="{{ route('searchpage').'?'.http_build_query(['p'=>$i,'qry'=>old('qry'),'sort'=>old('sort')]) }}">page {{$i}}</a>
                        @endif
                    </li>
                @endfor
            </ul>
        </div>
    @endif
@endsection

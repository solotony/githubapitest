@extends('layout')


@section('content')

    <table>
        <TR>
            <td>
                <a href="{{route('frontpage').'?s=name'}}">name</a>
            </td>
            <td>
                <a href="{{route('frontpage').'?s=author'}}">author</a>
            </td>
            <td>
                <a href="{{route('frontpage').'?s=stars'}}">stars</a>
            </td>
            <td>
                contributors
            </td>
            <td>
                description
            </td>
        </TR>
    @foreach($res as $r)
        <tr>
            <td>
                {{ $r->name }}
            </td>
            <td>
                {{ $r->author }}
            </td>
            <td>
                {{ $r->stars }}
            </td>
            <td>
                @foreach($r->builtBy as $c)
                    <img src="{{$c->avatar}}" style="max-width: 30px" alt="{{$c->username}}">
                    <a href="{{$c->href}}">{{$c->username}}</a><br>
                @endforeach
            </td>
            <td>
                {{ mb_strimwidth($r->description, 0, 300, "...") }}
            </td>
        </tr>
    @endforeach
    </table>

@endsection

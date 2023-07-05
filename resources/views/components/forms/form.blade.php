@props([
    'action',
    'id' => null,
    'put' => null,
    'delete' => null,
])

<form method="POST" action="{{$action}}" id="{{$id}}">
    @csrf

    @if($put)
        @method('PUT')
    @endif

    @if($delete)
        @method('DELETE')
    @endif

    {!! $slot !!}
</form>

@props([
    'action',
    'put' => null,
    'patch' => null,
    'delete' => null,
])

<form method="POST" action="{{$action}}" {{$attributes}}>
    @csrf

    @if($put)
        @method('PUT')
    @endif

    @if($patch)
        @method('PATCH')
    @endif

    @if($delete)
        @method('DELETE')
    @endif

    {!! $slot !!}
</form>

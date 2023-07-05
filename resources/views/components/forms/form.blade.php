@props([
    'action',
    'put' => null,
    'delete' => null,
])

<form method="POST" action="{{route('question.store')}}">
    @csrf

    @if($put)
        @method('PUT')
    @endif

    @if($delete)
        @method('DELETE')
    @endif

    {!! $slot !!}
</form>

<x-app-layout>
    <x-slot name="header">
        <x-header>{{ __('Dashboard') }}</x-header>
    </x-slot>

    <x-container>
        <div class="dark:text-gray-300 uppercase font-bold">List of questions</div>
        <div class="dark:text-gray-400 space-y-4">
            @foreach($questions as $item)
                <x-question :question="$item" />
            @endforeach

            {!! $questions->links() !!}
        </div>

    </x-container>
</x-app-layout>

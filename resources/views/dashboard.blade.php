<x-app-layout>
    <x-slot name="header">
        <x-header>{{ __('Dashboard') }}</x-header>
    </x-slot>

    <x-container>
        <div class="dark:text-gray-300 uppercase font-bold">List of questions</div>
        <div class="dark:text-gray-400 space-y-4">
            <form action="{{ route('dashboard') }}" method="get" class="flex items-center space-x-2">
                <x-text-input type="text" name="search" value="{{ request()->search }}" class="w-full"/>
                <x-btn.primary type="submit">Search</x-btn.primary>
            </form>

            @foreach($questions as $item)
                <x-question :question="$item" />
            @endforeach

            {!! $questions->appends(request()->except('_token'))->links() !!}
        </div>

    </x-container>
</x-app-layout>

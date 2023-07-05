<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form method="POST" action="{{route('question.store')}}">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4">
                    <textarea
                        name="question"
                        placeholder="{{ __("Ask me anything") }}..."
                        id="message"
                        rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{old('question')}}</textarea>
                    @error('question')
                          <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Cadastrar pergunta
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

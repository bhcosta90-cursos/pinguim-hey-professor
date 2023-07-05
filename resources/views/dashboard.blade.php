<x-app-layout>
    <x-slot name="header">
        <x-header>{{ __('Dashboard') }}</x-header>
    </x-slot>

    <x-container>
        <x-forms.form post :action="route('question.store')">
            <x-forms.textarea name="question" :place="__('Ask me anything')" />
            <x-forms.button.primary>Cadastrar pergunta</x-forms.button.primary>
            <x-forms.button.reset>Cancelar</x-forms.button.reset>
        </x-forms.form>

        <hr class="border-gray-600 border-dashed my-4" />

        <div class="dark:text-gray-300 uppercase font-bold">List of questions</div>
        <div class="dark:text-gray-400 space-y-4">
            @foreach($questions as $item)
                <x-question :question="$item" />
            @endforeach
        </div>

    </x-container>
</x-app-layout>

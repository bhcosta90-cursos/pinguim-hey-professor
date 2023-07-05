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
    </x-container>
</x-app-layout>

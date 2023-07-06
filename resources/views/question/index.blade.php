<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form :action="route('question.store')">
            <x-form.textarea label="Question" name="question"/>

            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            Drafts
        </div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th></x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions->where('draft', true) as $question)
                    <x-table.tr>
                        <x-table.td class='columns-11 px-6 py-4'>{{ $question->question }}</x-table.td>
                        <x-table.td class='columns-1 px-6 py-4'>
                            <div class="flex">
                                <x-form :action="route('question.publish', $question)" put>
                                    <button type="submit" class="hover:underline text-blue-500">
                                        <x-icons.publish />
                                    </button>
                                </x-form>

                                <a href="{{ route('question.edit', $question)}}" class="hover:underline text-green-500">
                                    <x-icons.edit />
                                </a>

                                <x-form :action="route('question.destroy', $question)" delete
                                    onsubmit="return confirm('Tem certeza?')">
                                    <button type="submit" class="hover:underline text-red-500 ml-5">
                                        <x-icons.delete />
                                    </button>
                                </x-form>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>

        </div>

        <hr class="border-gray-700 border-dashed my-4">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            My Questions
        </div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th></x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions->where('draft', false) as $question)
                    <x-table.tr>
                        <x-table.td class='columns-11 px-6 py-4'>{{ $question->question }}</x-table.td>
                        <x-table.td class='columns-1 px-6 py-4'>
                            <div class="flex">
                                <x-form :action="route('question.archive', $question)" patch>
                                    <button type="submit" class="hover:underline text-yellow-500">
                                        <x-icons.archive />
                                    </button>
                                </x-form>
                                <x-form :action="route('question.destroy', $question)" delete
                                        onsubmit="return confirm('Tem certeza?')">
                                    <button type="submit" class="hover:underline text-red-500 ml-5">
                                        <x-icons.delete />
                                    </button>
                                </x-form>
                            </div>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>

        </div>
    </x-container>
</x-app-layout>

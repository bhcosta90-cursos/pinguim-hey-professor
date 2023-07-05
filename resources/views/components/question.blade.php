@props([
    'question'
])

<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-400 flex justify-between items-center">
    <span>{{ $question->question }}</span>
    <div>
        <x-forms.form :action="route('question.like', $question)" :id="'question-like-' . $question->id">
            <button form="{{'question-like-' . $question->id}}" type="submit" href="{{ route('question.like', $question) }}" class="flex items-start space-x-1 text-green-500 hover:text-green-900">
                <x-icons.thumbs-up class="w-5 h-5" />
                {{ $question->likes }}
            </button>
        </x-forms.form>
        <x-forms.form :action="route('question.unlike', $question)" :id="'question-unlike-' . $question->id">
            <button form="{{'question-unlike-' . $question->id}}" type="submit" href="{{ route('question.like', $question) }}" class="flex items-start space-x-1 text-red-500 hover:text-red-900">
                <x-icons.thumbs-down class="w-5 h-5" />
                {{ $question->unlikes }}
            </button>
        </x-forms.form>
    </div>
</div>

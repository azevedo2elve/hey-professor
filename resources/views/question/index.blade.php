<x-app-layout>
    <x-slot name="header">

        <x-header>
            {{ __('My Question') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form :action="route('question.store')">
            <x-textarea label="Question" name="question"/>

            <x-btn.primary>
                Save
            </x-btn.primary>

            <x-btn.reset>
                Cancel
            </x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">

        {{-- DRAFT --}}
        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            Drafts
        </div>

        <div class="dark:text-gray-400 space-y-4">

            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach($questions->where('draft', true) as $question)
                        <x-table.tr>
                            <x-table.td> {{ $question->question }}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('question.destroy', $question)" delete
                                        onsubmit="return confirm('Tem certeza?')">
                                    <button class="hover:underline text-blue-500" type="submit">Deletar</button>
                                </x-form>

                                <x-form :action="route('question.publish', $question)" put>
                                    <button class="hover:underline text-blue-500" type="submit">Publicar</button>
                                </x-form>

                                <a href="{{ route('question.edit', $question) }}" class="hover:underline text-blue-500">
                                    Editar
                                </a>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>

        </div>

        {{-- My Questions --}}
        <hr class="border-gray-700 border-dashed my-4">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            My Questions
        </div>

        <div class="dark:text-gray-400 space-y-4">

            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions->where('draft', false) as $question)
                    <x-table.tr>
                        <x-table.td> {{ $question->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.destroy', $question)" delete
                                    onsubmit="return confirm('Tem certeza?')">
                                <button class="hover:underline text-blue-500" type="submit">
                                    Delete
                                </button>
                            </x-form>
                            <x-form :action="route('question.archive', $question)" patch>
                                <button type="submit" class="hover:underline text-blue-500">
                                    Archive
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>

        </div>

        <div class="dark:text-gray-400 uppercase font-bold mb-1 mt-8">
            Archived Questions
        </div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($archivedQuestions->where('draft', false) as $question)
                    <x-table.tr>
                        <x-table.td>{{ $question->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.restore', $question)" patch>
                                <button type="submit" class="hover:underline text-blue-500">
                                    Restore
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>

        </div>

    </x-container>
</x-app-layout>

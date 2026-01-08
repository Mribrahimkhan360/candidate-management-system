<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Second Interview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Candidates Passed First Interview</h3>
                    
                    @if($candidates->count() > 0)
                        <form action="{{ route('interviews.schedule') }}" method="POST">
                            @csrf
                            <input type="hidden" name="interview_type" value="second">

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Select Candidates
                                </label>
                                <div class="max-h-96 overflow-y-auto border rounded p-3">
                                    @foreach($candidates as $candidate)
                                        <label class="flex items-center mb-3 p-2 hover:bg-gray-50 rounded">
                                            <input type="checkbox" name="candidate_ids[]" value="{{ $candidate->id }}" class="mr-3">
                                            <div>
                                                <p class="font-semibold">{{ $candidate->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $candidate->email }} | {{ $candidate->phone }}</p>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('candidate_ids')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="scheduled_date_second">
                                    Interview Date & Time
                                </label>
                                <input type="datetime-local" name="scheduled_date" id="scheduled_date_second" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('scheduled_date')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex space-x-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Schedule Second Interview
                                </button>
                                <a href="{{ route('interviews.completed') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                                    Back
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600 mb-4">No candidates have passed the first interview yet.</p>
                            <a href="{{ route('interviews.completed') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                Go to Completed Interviews
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
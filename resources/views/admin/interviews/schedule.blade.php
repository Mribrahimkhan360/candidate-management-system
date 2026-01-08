<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Interviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Schedule by Selection -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Schedule by Selection</h3>
                        <form action="{{ route('interviews.schedule') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Select Candidates
                                </label>
                                <div class="max-h-64 overflow-y-auto border rounded p-3">
                                    @forelse($candidates as $candidate)
                                        <label class="flex items-center mb-2">
                                            <input type="checkbox" name="candidate_ids[]" value="{{ $candidate->id }}" class="mr-2">
                                            <span>{{ $candidate->name }} ({{ $candidate->email }})</span>
                                        </label>
                                    @empty
                                        <p class="text-gray-500">No pending candidates available.</p>
                                    @endforelse
                                </div>
                                @error('candidate_ids')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="scheduled_date">
                                    Interview Date & Time
                                </label>
                                <input type="datetime-local" name="scheduled_date" id="scheduled_date" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('scheduled_date')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="interview_type">
                                    Interview Type
                                </label>
                                <select name="interview_type" id="interview_type" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="first">First Interview</option>
                                    <option value="second">Second Interview</option>
                                </select>
                            </div>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                Schedule Selected
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Schedule by Range -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Schedule by Range</h3>
                        <form action="{{ route('interviews.schedule.range') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="start_range">
                                    Start Position
                                </label>
                                <input type="number" name="start_range" id="start_range" min="1" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="e.g., 1">
                                @error('start_range')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="end_range">
                                    End Position
                                </label>
                                <input type="number" name="end_range" id="end_range" min="1" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="e.g., 10">
                                @error('end_range')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="scheduled_date_range">
                                    Interview Date & Time
                                </label>
                                <input type="datetime-local" name="scheduled_date" id="scheduled_date_range" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="interview_type_range">
                                    Interview Type
                                </label>
                                <select name="interview_type" id="interview_type_range" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="first">First Interview</option>
                                    <option value="second">Second Interview</option>
                                </select>
                            </div>

                            <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                <p class="text-sm text-yellow-800">
                                    This will schedule interviews for candidates from position <strong>start</strong> to <strong>end</strong> in the pending list.
                                </p>
                            </div>

                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
                                Schedule Range
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
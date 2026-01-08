<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Completed Interviews') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('interviews.upcoming') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                    View Upcoming
                </a>
                <a href="{{ route('interviews.schedule.second') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    Schedule Second Interview
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interview Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scheduled Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    @if(auth()->user()->isAdmin())
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($interviews as $interview)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('candidates.show', $interview->candidate) }}" class="text-blue-600 hover:underline">
                                                {{ $interview->candidate->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $interview->candidate->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $interview->candidate->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ ucfirst($interview->interview_type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $interview->scheduled_date->format('M d, Y h:i A') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($interview->candidate->status == 'hired') bg-green-100 text-green-800
                                                @elseif(str_contains($interview->candidate->status, 'rejected')) bg-red-100 text-red-800
                                                @elseif(str_contains($interview->candidate->status, 'passed')) bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $interview->candidate->status)) }}
                                            </span>
                                        </td>
                                        @if(auth()->user()->isAdmin())
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($interview->candidate->status == 'first_interview_completed' || $interview->candidate->status == 'second_interview_completed')
                                                    <div class="flex space-x-2">
                                                        <!-- Pass Button -->
                                                        <form action="{{ route('interviews.mark.result', $interview) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" name="result" value="passed" 
                                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                                                onclick="return confirm('Are you sure you want to PASS this candidate?')">
                                                                Pass
                                                            </button>
                                                        </form>
                                                        
                                                        <!-- Reject Button -->
                                                        <form action="{{ route('interviews.mark.result', $interview) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" name="result" value="rejected" 
                                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                                onclick="return confirm('Are you sure you want to REJECT this candidate?')">
                                                                Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-gray-500">Already marked</span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="@if(auth()->user()->isAdmin()) 7 @else 6 @endif" class="px-6 py-4 text-center text-gray-500">
                                            No completed interviews found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination - এখানে সঠিক জায়গায় -->
                    <div class="mt-4">
                        {{ $interviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
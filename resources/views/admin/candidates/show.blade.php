<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidate Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 text-sm">Name</p>
                            <p class="font-semibold text-lg">{{ $candidate->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Email</p>
                            <p class="font-semibold">{{ $candidate->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Phone</p>
                            <p class="font-semibold">{{ $candidate->phone }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Age</p>
                            <p class="font-semibold">{{ $candidate->age }} years</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Years of Experience</p>
                            <p class="font-semibold">{{ $candidate->experience_years }} years</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Status</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                @if($candidate->status == 'hired') bg-green-100 text-green-800
                                @elseif(str_contains($candidate->status, 'rejected')) bg-red-100 text-red-800
                                @elseif(str_contains($candidate->status, 'passed')) bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $candidate->status)) }}
                            </span>
                        </div>
                    </div>

                    @if($candidate->previous_experience && count($candidate->previous_experience) > 0)
                        <div class="mt-6">
                            <p class="text-gray-600 text-sm mb-2">Previous Experience</p>
                            <div class="bg-gray-50 rounded p-4">
                                @foreach($candidate->previous_experience as $company => $position)
                                    <div class="mb-2">
                                        <p class="font-semibold">{{ $company }}</p>
                                        <p class="text-sm text-gray-600">{{ $position }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($candidate->interviews->count() > 0)
                        <div class="mt-6">
                            <h3 class="font-semibold text-lg mb-4">Interview History</h3>
                            <div class="space-y-3">
                                @foreach($candidate->interviews as $interview)
                                    <div class="border rounded p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-semibold">{{ ucfirst($interview->interview_type) }} Interview</p>
                                                <p class="text-sm text-gray-600">{{ $interview->scheduled_date->format('F d, Y h:i A') }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                                @if($interview->status == 'upcoming') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($interview->status) }}
                                            </span>
                                        </div>
                                        @if($interview->notes)
                                            <p class="mt-2 text-sm text-gray-600">{{ $interview->notes }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-6 flex space-x-4">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('candidates.edit', $candidate) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                Edit
                            </a>
                        @endif
                        <a href="{{ route('candidates.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Application Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($candidate)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Application Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600 text-sm">Name</p>
                                <p class="font-semibold">{{ $candidate->name }}</p>
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
                                <p class="text-gray-600 text-sm">Experience</p>
                                <p class="font-semibold">{{ $candidate->experience_years }} years</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-gray-600 text-sm">Current Status</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                @if($candidate->status == 'hired') bg-green-100 text-green-800
                                @elseif(str_contains($candidate->status, 'rejected')) bg-red-100 text-red-800
                                @elseif(str_contains($candidate->status, 'passed')) bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $candidate->status)) }}
                            </span>
                        </div>

                        @if($candidate->interviews->count() > 0)
                            <div class="mt-6">
                                <h4 class="font-semibold mb-2">Interview Schedule</h4>
                                <div class="space-y-2">
                                    @foreach($candidate->interviews as $interview)
                                        <div class="border rounded p-3">
                                            <p class="font-semibold">{{ ucfirst($interview->interview_type) }} Interview</p>
                                            <p class="text-sm text-gray-600">{{ $interview->scheduled_date->format('F d, Y h:i A') }}</p>
                                            <p class="text-sm">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                                    @if($interview->status == 'upcoming') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst($interview->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-gray-600">No candidate information found for your account.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
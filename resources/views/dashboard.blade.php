<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Candidates -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm uppercase">Total Candidates</div>
                        <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCandidates }}</div>
                    </div>
                </div>

                <!-- Pending Candidates -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm uppercase">Pending</div>
                        <div class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingCandidates }}</div>
                    </div>
                </div>

                <!-- Hired Candidates -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm uppercase">Hired</div>
                        <div class="text-3xl font-bold text-green-600 mt-2">{{ $hiredCandidates }}</div>
                    </div>
                </div>

                <!-- Rejected Candidates -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 text-sm uppercase">Rejected</div>
                        <div class="text-3xl font-bold text-red-600 mt-2">{{ $rejectedCandidates }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('candidates.upload.form') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg text-center">
                            Upload Excel File
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('interviews.schedule.form') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg text-center">
                                Schedule Interview
                            </a>
                            <a href="{{ route('candidates.create') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 px-6 rounded-lg text-center">
                                Add Candidate
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Upcoming Interviews</h3>
                    <div class="text-2xl font-bold text-blue-600">{{ $upcomingInterviews }}</div>
                    <a href="{{ route('interviews.upcoming') }}" class="text-blue-500 hover:underline mt-2 inline-block">
                        View All Upcoming Interviews →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
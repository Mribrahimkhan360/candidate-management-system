<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Candidates Excel File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('candidates.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
                                Select Excel File
                            </label>
                            <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('file')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <h3 class="font-semibold text-blue-800 mb-2">Excel File Format:</h3>
                            <p class="text-sm text-blue-700 mb-2">Your Excel file should have the following columns:</p>
                            <ul class="list-disc list-inside text-sm text-blue-700">
                                <li><strong>name</strong> - Candidate's full name</li>
                                <li><strong>email</strong> - Candidate's email address</li>
                                <li><strong>phone</strong> - Candidate's phone number</li>
                                <li><strong>experience_years</strong> - Number of years of experience</li>
                                <li><strong>previous_experience</strong> - Format: "Company1:Position1,Company2:Position2"</li>
                                <li><strong>age</strong> - Candidate's age</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Upload & Import
                            </button>
                            <a href="{{ route('candidates.index') }}" class="text-gray-600 hover:text-gray-800">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
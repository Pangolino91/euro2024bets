<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $fixture->home_team }} vs {{ $fixture->away_team }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form method="post" action="" class="p-6 w-full gap-3 flex text-gray-900">
                    @csrf
                    <div class="flex flex-col gap-1">
                        <label for="match_result" class="text-xs uppercase text-gray-600">Match Result</label>
                        <select name="match_result" required class="px-10 py-2 text-sm rounded" placeholder="" id="match_result">
                            <option disabled selected>Select match result</option>       
                            <option value="home">{{ $fixture->home_team }} Won</option>       
                            <option value="draw">Draw</option>       
                            <option value="away">{{ $fixture->away_team }} Won</option>       
                        </select>
                    </div>
                   
                    <div class="flex items-end gap-2">
                        <button type="submit" class="rounded bg-blue-700 text-white text-sm px-5 h-10 flex items-center justify-center text-center">
                            Update Fixture
                        </button>
                        <button type="reset" class="rounded bg-gray-700 text-white text-sm px-5 h-10 flex items-center justify-center text-center">
                            Clear
                        </button>
                    </div>
                </form>
            </div>
          
        </div>
    </div>
</x-app-layout>

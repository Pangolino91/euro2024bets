<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Euro 2024 Match Fixtures') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="" class="p-6 w-full gap-3 flex text-gray-900">
                    @csrf
                    <div class="flex flex-col gap-1">
                        <label for="kickoff_date" class="text-xs uppercase text-gray-600">Kickoff Date</label>
                        <input type="date" required name="kickoff_date" class="px-3 py-2 text-sm rounded" placeholder="" id="kickoff_date">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="kickoff_time" class="text-xs uppercase text-gray-600">Kickoff Time</label>
                        <input type="time" required name="kickoff_time" class="px-3 py-2 text-sm rounded" placeholder="" id="kickoff_time">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="home_team" class="text-xs uppercase text-gray-600">Home Team</label>
                        <input type="text" required name="home_team" class="px-3 py-2 text-sm rounded" placeholder="e.g Italy" id="home_team">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="away_team" class="text-xs uppercase text-gray-600">Away Team</label>
                        <input type="text" required name="away_team" class="px-3 py-2 text-sm rounded" placeholder="e.g Switzerland" id="away_team">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="rounded bg-blue-700 text-white text-sm px-5 h-10 flex items-center justify-center text-center">
                            Save
                        </button>
                        <button type="reset" class="rounded bg-gray-700 text-white text-sm px-5 h-10 flex items-center justify-center text-center">
                            Clear
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-white mt-3 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 px-0 text-gray-900">
                 

                 <ul class="w-full">
                 <li class="grid grid-cols-12 border-b py-3 px-2 text-gray-400">
                     <h1 class="col-span-2 font-bold text-sm uppercase items-center justify-center flex flex-col gap-1">
                     Kickoff Date
                     </h1>
                     <h1 class="col-span-2 font-bold text-sm uppercase items-center flex">
                     Kickoff Time
                     </h1>
                     <h1 class="col-span-5 font-bold text-sm uppercase flex items-center">
                        Match
                     </h1>
                     <h1 class="col-span-2 font-bold text-sm uppercase flex items-center">
                        Result
                     </h1>
                     
                 </li>
                     @foreach ($fixtures as $index => $fixture)
                             <li class="grid min-h-fit grid-cols-12 border-b hover:bg-gray-50">
                                 @csrf
                                 <input type="hidden" name="fixture_id" value="{{$fixture->id}}">
                                 <h1 class="col-span-2 py-1 items-center justify-center flex flex-col gap-1">
                                 @if ($index === 0 || $fixture->kickoff->format('Y-m-d') !== $fixtures[$index - 1]->kickoff->format('Y-m-d'))
                                 <div class="flex flex-col items-center">
                                     <p class="text-sm font-extrabold">{{ $fixture->kickoff->format('d/m, Y') }}</p>
                                 </div>
                                 @endif
                                     
                                 </h1>
                                 <h1 class="col-span-2 py-1 items-center flex">
                                    <p class="text-sm uppercase">{{ $fixture->kickoff->format('h:i a') }}</p>
                                </h2>
                                 <h1 class="col-span-5 flex items-center">
                                     <p class="text-base">
                                        <span class="@if ($fixture->result === 'home') font-bold underline @endif"> {{ $fixture->home_team }} </span>
                                       
                                        <span class="text-base @if ($fixture->result === 'draw') font-bold text-lg @endif">vs</span> 
                                        <span class="@if ($fixture->result === 'away') font-bold underline @endif">{{ $fixture->away_team }}
</span>
                                        </p>
                                 </h1>
                                  @if ($fixture->result === 'pending' || $fixture->result === null)
                                    <a href="{{ route('admin.set_results', ['fixture_id' => $fixture->id]) }}" class="col-span-1 justify-center  hover:bg-gray-400 hover:text-white transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                                Set Results 
                                        </a>
                                    @else

                                    <span class="text-sm">
                                    @if ($fixture->result === "home")
                                        {{$fixture->home_team}} Won
                                    @elseif ($fixture->result === "draw")
                                        Draw
                                    @else
                                        {{$fixture->away_team}} Won
                                    @endif
                                    </span>

                                  @endif
                         </li>
                     @endforeach
                 </ul>

             </div>
            </div>
        </div>
    </div>
</x-app-layout>

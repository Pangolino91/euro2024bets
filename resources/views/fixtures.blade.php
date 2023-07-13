@php
    use Carbon\Carbon;
    $now = Carbon::now();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold flex justify-between items-center text-xl text-gray-800 leading-tight">
            <span>{{ __('Euro 2024 Match Fixtures') }}</span>
            <span>Your points: {{ Auth::user()->points }}</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 px-0 text-gray-900">


                    <ul class="w-full">
                        <li class="grid grid-cols-12 border-b py-3 px-2 text-gray-400">
                            <h1
                                class="col-span-2 font-bold text-sm uppercase items-center justify-center flex flex-col gap-1">
                                Date
                            </h1>
                            <h1 class="col-span-7 font-bold text-sm uppercase flex items-center">
                                Match
                            </h1>
                            <a
                                class="col-span-3 justify-center text-sm font-bold uppercase cursor-pointer flex items-center">
                                Place your bets
                            </a>
                        </li>
                        @foreach ($fixtures as $index => $fixture)
                            @php
                                $kickoff = Carbon::parse($fixture->kickoff);
                                $existingPrediction = $fixture->in_user_bets;
                            @endphp

                            <li class="relative">
                                @if ($now->floatDiffInMinutes($kickoff, false) < 30 && !$kickoff->isPast())
                                    <div
                                        class="flex absolute items-center justify-center bg-green-50 bg-opacity-75 w-full h-full ">
                                        <div class="text-lg font-bold flex gap-2">
                                            <div>
                                            Match is about to start. Bets stopped!
                                            </div>
                                            <a href="{{ route('fixtures.details', ['fixture_id' => $fixture->id]) }}"
                                        class="col-span-7 flex text-lg font-bold items-center">
                                                Click here to view bets.
                                            </a>
                                        </div>
                                    </div>
                                @elseif ($now->floatDiffInMinutes($kickoff) <= 120 && $kickoff->isPast())
                                    <div
                                        class="flex absolute items-center justify-center bg-blue-50 bg-opacity-75 w-full h-full">
                                        <div class="text-lg font-bold flex gap-2">
                                            <div>
                                            Match in progress!
                                            </div>
                                            <a href="{{ route('fixtures.details', ['fixture_id' => $fixture->id]) }}"
                                        class="col-span-7 flex text-lg font-bold items-center">
                                                Click here to view bets.
                                            </a>
                                        </div>
                                    </div>
                                @elseif ($now->floatDiffInMinutes($kickoff) > 120 && $kickoff->isPast())
                                    <div
                                        class="flex absolute items-center justify-center bg-blue-50 bg-opacity-75 w-full h-full">
                                        <p class="text-lg font-bold flex gap-2">The game is over

                                        <a href="{{ route('fixtures.details', ['fixture_id' => $fixture->id]) }}"
                                        class="col-span-7 flex items-center text-lg font-bold">
                                                Click here to view results.
                                            </a>
                                        </p>
                                       
                                    </div>
                                @else
                                    <div class="hidden">
                                    </div>
                                @endif
                                <form action="" method="post"
                                    class="grid min-h-[72px] grid-cols-12 border-b hover:bg-gray-50">
                                    @csrf
                                    <input type="hidden" name="fixture_id" value="{{ $fixture->id }}">
                                    <h1 class="col-span-2 py-1 items-center justify-center flex flex-col gap-1">
                                        @if ($index === 0 || $fixture->kickoff->format('Y-m-d') !== $fixtures[$index - 1]->kickoff->format('Y-m-d'))
                                            <div class="flex flex-col items-center">
                                                <span class="text-xs text-gray-500">2023</span>
                                                <p class="text-xl font-extrabold">{{ $fixture->kickoff->format('d/m') }}
                                                </p>
                                            </div>
                                        @else
                                        @endif
                                        <p class="text-sm">{{ $fixture->kickoff->format('h:i a') }}</p>
                                    </h1>
                                    <a href="{{ route('fixtures.details', ['fixture_id' => $fixture->id]) }}"
                                        class="col-span-7 flex items-center">
                                        <p class="text-xl">{{ $fixture->home_team }} <span class="text-base">vs</span>
                                            {{ $fixture->away_team }}</p>
                                    </a>

                                    @if ($now->floatDiffInMinutes($kickoff, false) >= 30)
                                        <button type="submit" @if ($existingPrediction) disabled @endif
                                            name="prediction" value="home"
                                            class="col-span-1 justify-center @if ($existingPrediction && $existingPrediction->prediction === 'home') bg-green-600 text-white @endif @if (!$existingPrediction) hover:bg-green-600 hover:text-white @endif transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                            {{ $fixture->home_team }}
                                        </button>
                                        <button name="prediction" @if ($existingPrediction) disabled @endif
                                            value="draw" type="submit"
                                            class="col-span-1 justify-center @if ($existingPrediction && $existingPrediction->prediction === 'draw') bg-gray-500 text-white @endif 
                                             @if (!$existingPrediction) hover:bg-gray-500 hover:text-white @endif transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                            Draw
                                        </button>
                                        <button name="prediction" @if ($existingPrediction) disabled @endif
                                            value="away" type="submit"
                                            class="col-span-1 justify-center @if ($existingPrediction && $existingPrediction->prediction === 'away') bg-red-600 text-white @endif @if (!$existingPrediction) hover:bg-red-600 hover:text-white @endif transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                            {{ $fixture->away_team }}
                                        </button>
                                    @else
                                        <div
                                            class="col-span-1 justify-center @if ($existingPrediction && $existingPrediction->prediction === 'home') bg-green-600 text-white @endif  transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                            @if (
                                                $existingPrediction &&
                                                    $existingPrediction->prediction === 'home' &&
                                                    $existingPrediction->correct &&
                                                    $fixture->has_results())
                                                +1
                                            @else
                                                <svg width="24px" height="24px" stroke-width="1.5"
                                                    viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" color="currentColor">
                                                    <path
                                                        d="M16 12h1.4a.6.6 0 01.6.6v6.8a.6.6 0 01-.6.6H6.6a.6.6 0 01-.6-.6v-6.8a.6.6 0 01.6-.6H8m8 0V8c0-1.333-.8-4-4-4S8 6.667 8 8v4m8 0H8"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            @endif

                                        </div>
                                        <div
                                            class="col-span-1 justify-center @if ($existingPrediction && $existingPrediction->prediction === 'draw') bg-gray-400 text-white @endif transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                            @if (
                                                $existingPrediction &&
                                                    $existingPrediction->prediction === 'draw' &&
                                                    $existingPrediction->correct &&
                                                    $fixture->has_results())
                                                +1
                                            @else
                                                <svg width="24px" height="24px" stroke-width="1.5"
                                                    viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" color="currentColor">
                                                    <path
                                                        d="M16 12h1.4a.6.6 0 01.6.6v6.8a.6.6 0 01-.6.6H6.6a.6.6 0 01-.6-.6v-6.8a.6.6 0 01.6-.6H8m8 0V8c0-1.333-.8-4-4-4S8 6.667 8 8v4m8 0H8"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div
                                            class="col-span-1 justify-center @if ($existingPrediction && $existingPrediction->prediction === 'away') bg-red-600 text-white @endif transition-colors duration-300 text-xs font-bold cursor-pointer flex items-center">
                                            @if (
                                                $existingPrediction &&
                                                    $existingPrediction->prediction === 'away' &&
                                                    $existingPrediction->correct &&
                                                    $fixture->has_results())
                                                +1
                                            @else
                                                <svg width="24px" height="24px" stroke-width="1.5"
                                                    viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" color="currentColor">
                                                    <path
                                                        d="M16 12h1.4a.6.6 0 01.6.6v6.8a.6.6 0 01-.6.6H6.6a.6.6 0 01-.6-.6v-6.8a.6.6 0 01.6-.6H8m8 0V8c0-1.333-.8-4-4-4S8 6.667 8 8v4m8 0H8"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            @endif
                                        </div>
                                    @endif



                                </form>

                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

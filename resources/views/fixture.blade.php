@php
    use Carbon\Carbon;
    $kickoff = $fixture->kickoff;
    $kickoff = Carbon::parse($kickoff);
    $now = Carbon::now();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold flex justify-between items-center text-xl text-gray-800 leading-tight">
           <span> {{ $fixture->home_team }} vs {{ $fixture->away_team }}</span>
           
                @if ($now->floatDiffInMinutes($kickoff, false) >= 30)
                    <span class="text-sm px-3 bg-gray-500 py-2 text-white rounded">Kickoff {{ $kickoff->diffForHumans()}}</span>
                @else
                    @if ($fixture->result !== "pending" && $fixture->result !== null)
                        <span class="bg-green-700 text-sm text-white px-3 rounded py-2">
                        @if ($fixture->result === "home")
                            {{$fixture->home_team}} Won
                        @elseif ($fixture->result === "draw")
                            Draw
                        @else
                            {{$fixture->away_team}} Won
                        @endif
                        </span>
                    @else
                        Waiting for results.
                    @endif
                @endif
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 py-0 px-0 text-gray-900">
                 
                @if ($now->floatDiffInMinutes($kickoff, false) < 30)
                <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-left p-2 text-white bg-gray-800">User</th>
                                <th class="text-left p-2 text-white bg-gray-800">Prediction</th>
                                <th class="text-right p-2 text-white bg-gray-800">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fixture->bets as $bet)
                                <tr>
                                    <td class="text-left p-2 border-b">{{ $bet->user->name }} </td>
                                    <td class="text-left p-2 border-b">
                                        @if ($bet->prediction === "home")
                                            <span>{{ $fixture->home_team }} to win. </span>
                                        @elseif ($bet->prediction === "draw")
                                            <span>Teams to Draw </span>
                                        @else
                                            <span>{{ $fixture->away_team }} to win. </span>
                                        @endif
                                    </td>
                                    <td class="text-right font-bold border-b p-2">
                                        @if ($bet->prediction !== null)
                                            @if ($bet->correct)
                                                +1 Point
                                            @else
                                                lost
                                            @endif
                                        @else
                                            <span class="">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-left p-2 border-b">
                                        No bets.
                                    </td>
                                    
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <p class="p-6">
                        Betting in progress
                    </p>
                @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
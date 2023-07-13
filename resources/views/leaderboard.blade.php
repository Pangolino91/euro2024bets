<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Euro 2024 Bets Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-0 text-gray-900">
                  <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="text-center bg-gray-600 p-2 text-white">#</th>
                            <th class="text-left p-2 bg-gray-600 text-white">User</th>
                            <th class="text-right p-2 bg-gray-600 text-white">Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaderboard as $index => $user)
                        @php
                            $is_current_user = Auth::user()->id === $user->id;
                        @endphp
                        <tr>
                            <td class="text-center p-2">
                                {{ $index + 1}}
                            </td>
                            <td class="p-2 flex items-center gap-2 @if ($is_current_user) font-black @endif">
                                @if ($is_current_user)
                                    <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M2 20v-1a7 7 0 017-7v0" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.804 12.313a1.618 1.618 0 012.392 0v0c.325.357.79.55 1.272.527v0a1.618 1.618 0 011.692 1.692v0c-.023.481.17.947.526 1.272v0c.705.642.705 1.75 0 2.392v0c-.356.325-.549.79-.526 1.272v0a1.618 1.618 0 01-1.692 1.692v0a1.618 1.618 0 00-1.272.526v0a1.618 1.618 0 01-2.392 0v0a1.618 1.618 0 00-1.272-.526v0a1.618 1.618 0 01-1.692-1.692v0a1.618 1.618 0 00-.527-1.272v0a1.618 1.618 0 010-2.392v0c.357-.325.55-.79.527-1.272v0a1.618 1.618 0 011.692-1.692v0c.481.023.947-.17 1.272-.527v0z" stroke="#000000" stroke-width="1.5"></path><path d="M15.364 17l1.09 1.09 2.182-2.18M9 12a4 4 0 100-8 4 4 0 000 8z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                @endif
                                {{ $user->name  }}
                            </td>
                            <td class="text-right p-2">
                                {{$user->points}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center p-2">
                                Nothing to see here.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
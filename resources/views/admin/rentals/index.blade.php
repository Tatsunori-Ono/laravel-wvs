<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('rental.rental-log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('rental.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-8 text-base rounded">
                < {{__('rental.back-to-catalogue')}}
            </a><br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($rentals->count())
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                        {{__('rental.user')}}
                                    </th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        {{__('rental.item')}}
                                    </th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        {{__('rental.quantity')}}
                                    </th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        {{__('rental.borrowed-at')}}
                                    </th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        {{__('rental.return-by')}}
                                    </th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                        {{__('rental.actions')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rentals as $rental)
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-900 dark:text-gray-200">
                                            {{ $rental->user->name }}
                                        </td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-900 dark:text-gray-200">
                                            {{ $rental->equipmentItem->product_name }}
                                        </td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-900 dark:text-gray-200">
                                            {{ $rental->quantity }}
                                        </td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-900 dark:text-gray-200">
                                            {{ $rental->created_at->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-900 dark:text-gray-200">
                                            {{ $rental->return_by }}
                                        </td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3">
                                            <a href="{{ route('admin.rental.edit', $rental->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                                    {{ __('rental.edit') }}
                                                </button>
                                            </a>
                                            @if(now()->lessThan($rental->return_by))
                                                <form action="{{ route('admin.rental.cancel', $rental->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded">
                                                        {{ __('rental.cancel') }}
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.rental.destroy', $rental->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">
                                                        {{ __('rental.delete') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $rentals->links() }}
                        </div>
                    @else
                        <p>{{ __('rental.no-logs') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

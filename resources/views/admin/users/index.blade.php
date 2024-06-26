<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('user-control.management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- ユーザー管理テーブル -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                    {{ __('user-control.name') }}
                                </th>
                                <th scope="col" class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    {{ __('user-control.email') }}
                                </th>
                                <th scope="col" class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    {{ __('user-control.warwick-id') }}
                                </th>
                                <th scope="col" class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                    {{ __('user-control.role') }}
                                </th>
                                <th scope="col" class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                    {{ __('user-control.actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-900 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
                                    <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-500 dark:text-gray-300">
                                        {{ $user->email }}
                                    </td>
                                    <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-500 dark:text-gray-300">
                                        {{ $user->warwick_id ?? 'N/A' }}
                                    </td>
                                    <td class="border-t-2 border-gray-200 px-4 py-3 text-gray-500 dark:text-gray-300">
                                        {{ $user->role }}
                                    </td>
                                    <td class="border-t-2 border-gray-200 px-4 py-3">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                                {{ __('user-control.edit') }}
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">
                                                {{ __('user-control.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

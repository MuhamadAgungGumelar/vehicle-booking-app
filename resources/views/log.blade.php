<!-- resources/views/log.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="bg-red-500 text-white p-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table id="logsTable" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Timestamp</th>
                                <th>Action</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->timestamp }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td>{{ $log->user->name  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#logsTable').DataTable();
        });
    </script>
</x-app-layout>

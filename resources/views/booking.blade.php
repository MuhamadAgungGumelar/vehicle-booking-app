<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-row justify-end border-b">
                    <div class="p-4 bg-white border-gray-200">
                        <a href="{{ route('bookingForm') }}" class="btn btn-outline btn-info">Add Booking</a>
                    </div>
                    <div class="p-4 bg-white border-gray-200">
                        <a href="{{ route('booking.export') }}" class="btn btn-outline btn-success">Export Excel</a>
                    </div>
                </div>
                <div class="p-4">
                    <table id="bookingsTable" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee</th>
                                <th>Vehicle</th>
                                <th>Driver</th>
                                <th>Manager</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->employee->name }}</td>
                                    <td>{{ $booking->vehicle->type }}</td>
                                    <td>{{ $booking->driver->name }}</td>
                                    <td>{{ $booking->manager->name }}</td>
                                    <td>{{ $booking->start_time }}</td>
                                    <td>{{ $booking->end_time }}</td>
                                    <td class="
                                        @if($booking->approval_status === 'pending')
                                            bg-yellow-200 text-yellow-800
                                        @elseif($booking->approval_status === 'approved')
                                            bg-green-200 text-green-800
                                        @elseif($booking->approval_status === 'rejected')
                                            bg-red-200 text-red-800
                                        @endif
                                        rounded-lg font-bold
                                    ">
                                        {{ $booking->approval_status }}
                                    </td>
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
            $('#bookingsTable').DataTable();
        });
    </script>

    <!-- Include SweetAlert2 script -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script to display SweetAlert toast -->
    <script>
        @if(Session::has('alert'))
            Swal.fire({
                icon: '{{ Session::get('alert')['type'] }}',
                title: '{{ Session::get('alert')['title'] }}',
                text: '{{ Session::get('alert')['message'] }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>
    @include('sweetalert::alert')
</x-app-layout>

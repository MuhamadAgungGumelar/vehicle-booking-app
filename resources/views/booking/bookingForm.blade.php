<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-col gap-4 justify-center items-center p-4">
                <h1 class="text-4xl font-bold">Form Employee Booking Vehicle</h1>
                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" class="w-full flex flex-col justify-center items-center gap-y-4">
                    @csrf
                    <div class="w-full flex justify-center items-center">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Employee Name</span>
                            </div>
                            <select name="employee_id" class="select select-bordered w-full max-w-xs">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Vehicle</span>
                            </div>
                            <select name="vehicle_id" class="select select-bordered w-full max-w-xs">
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->type }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Driver</span>
                            </div>
                            <select name="driver_id" class="select select-bordered w-full max-w-xs">
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Manager</span>
                            </div>
                            <select name="manager_id" class="select select-bordered w-full max-w-xs">
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Start Time</span>
                            </div>
                            <input type="datetime-local" name="start_time" class="input input-bordered w-full max-w-xs" />
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">End Time</span>
                            </div>
                            <input type="datetime-local" name="end_time" class="input input-bordered w-full max-w-xs" />
                        </label>
                    </div>
                    <div class="w-full flex justify-center items-center mt-2">
                        <button type="submit" class="btn btn-outline btn-primary" id="bookNowButton">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to create a new booking!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, book it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    </script>
    @include('sweetalert::alert')
</x-app-layout>

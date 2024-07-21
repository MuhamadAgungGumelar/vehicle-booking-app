<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Approval Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        </script>
                    @elseif (session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: '{{ session('error') }}',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        </script>
                    @endif

                    <table id="approvalsTable" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking ID</th>
                                <th>Employer</th>
                                <th>Approver</th>
                                <th>Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvals as $approval)
                                <tr>
                                    <td>{{ $approval->id }}</td>
                                    <td>{{ $approval->booking->id }}</td>
                                    <td>{{ $approval->booking->employee->name }}</td>
                                    <td>{{ $approval->approver->name }}</td>
                                    <td>{{ $approval->level }}</td>
                                    <td>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $approval->approver_id)
                                            <!-- Form for changing status -->
                                            <form action="{{ route('updateStatus', $approval->id) }}" method="POST" id="form_{{ $approval->id }}">
                                                @csrf
                                                @method('POST')
                                                <select name="status" id="statusOption_{{ $approval->id }}" class="select select-bordered w-full max-w-xs">
                                                    <option value="pending" {{ $approval->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ $approval->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="rejected" {{ $approval->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        $('#approvalsTable').DataTable();

        // Handle status change using event delegation
        $(document).on('change', 'select[id^="statusOption_"]', function(e) {
            var formId = $(this).attr('id').replace('statusOption_', '');
            var form = $('#form_' + formId);

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status of this approval.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</x-app-layout>

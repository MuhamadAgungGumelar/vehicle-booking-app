    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 justify-center items-center p-8 gap-4">
                        <div class="w-full w-max-sm h-20 bg-white rounded-lg p-4 flex flex-col justify-center items-center gap-1">
                            <h1 class="text-xl font-semibold">Total Booking </h1>
                            <h1 class="text-3xl font-bold">{{ $totalBookings }}</h1>
                        </div>
                        <div class="w-full w-max-sm h-20 bg-white rounded-lg p-4 flex flex-col justify-center items-center gap-1">
                            <h1 class="text-xl font-semibold">Total Vehicle </h1>
                            <h1 class="text-3xl font-bold">{{ $totalVehicles }}</h1>
                        </div>
                        <div class="w-full w-max-sm h-20 bg-white rounded-lg p-4 flex flex-col justify-center items-center gap-1">
                            <h1 class="text-xl font-semibold">Total Employee </h1>
                            <h1 class="text-3xl font-bold">{{ $totalUsers }}</h1>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center items-center p-8">
                        <div class="w-full w-max-sm h-fit bg-white rounded-lg flex flex-col justify-center items-center p-6">
                            <h1 class="text-xl font-semibold">Booking Statistic</h1>
                            <canvas id="bookingsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('bookingsChart').getContext('2d');
        var bookingsPerMonth = @json(array_values($bookingsPerMonth));
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Numbers of Bookings',
                    data: bookingsPerMonth,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

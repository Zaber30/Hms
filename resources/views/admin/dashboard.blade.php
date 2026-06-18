@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Dashboard Header with Date Filter -->
        <div class="mb-8" x-data="dashboardFilter()">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
                    <p class="text-gray-600 mt-2">Welcome back! Here's your system overview.</p>
                </div>

                <!-- Date Filter -->
                <div class="bg-white rounded-lg shadow p-4 border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Date</label>
                    <div class="flex gap-2">
                        <input
                            type="date"
                            x-model="selectedDate"
                            @change="fetchStatistics()"
                            :value="selectedDate"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button
                            @click="resetDate()"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium"
                        >
                            Reset
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Selected: <span x-text="selectedDate"></span></p>
                </div>
            </div>

        <!-- Key Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
                <p class="text-blue-100 font-medium text-sm mb-2">Total Users</p>
                <p class="text-4xl font-bold" x-text="stats.totalUsers ?? 0"></p>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow p-6 text-white">
                <p class="text-green-100 font-medium text-sm mb-2">Total Patients</p>
                <p class="text-4xl font-bold" x-text="stats.totalPatients ?? 0"></p>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow p-6 text-white">
                <p class="text-purple-100 font-medium text-sm mb-2">Total Doctors</p>
                <p class="text-4xl font-bold" x-text="stats.totalDoctors ?? 0"></p>
                <p class="text-purple-100 text-xs mt-2" x-text="stats.approvedDoctors + ' Approved'"></p>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow p-6 text-white">
                <p class="text-yellow-100 font-medium text-sm mb-2">Pending Approvals</p>
                <p class="text-4xl font-bold" x-text="stats.rejectedDoctors ?? 0"></p>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow p-6 text-white">
                <p class="text-orange-100 font-medium text-sm mb-2">Total Appointments</p>
                <p class="text-4xl font-bold" x-text="stats.totalAppointments ?? 0"></p>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Users by Role Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Users Distribution</h3>
                <div style="position: relative; height: 300px;">
                    <canvas id="usersByRoleChart"></canvas>
                </div>
            </div>

            <!-- Appointments by Status Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Appointments Status</h3>
                <div style="position: relative; height: 300px;">
                    <canvas id="appointmentsByStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Doctors by Specialization Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Doctors by Specialization</h3>
                <div style="position: relative; height: 300px;">
                    <canvas id="doctorsBySpecializationChart"></canvas>
                </div>
            </div>

            <!-- Detailed Statistics -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Detailed Statistics</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-gray-700 font-medium">Approved Appointments</span>
                        </div>
                        <span class="text-2xl font-bold text-green-600" x-text="stats.approvedAppointments ?? 0"></span>
                    </div>
                    <div class="flex items-center justify-between pb-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700 font-medium">Completed Appointments</span>
                        </div>
                        <span class="text-2xl font-bold text-blue-600" x-text="stats.completedAppointments ?? 0"></span>
                    </div>
                    <div class="flex items-center justify-between pb-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <span class="text-gray-700 font-medium">Pending Appointments</span>
                        </div>
                        <span class="text-2xl font-bold text-yellow-600" x-text="stats.pendingAppointments ?? 0"></span>
                    </div>
                    <div class="flex items-center justify-between pb-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-gray-700 font-medium">Cancelled Appointments</span>
                        </div>
                        <span class="text-2xl font-bold text-red-600" x-text="stats.cancelledAppointments ?? 0"></span>
                    </div>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <span class="text-gray-700 font-medium">Rejected Doctors</span>
                        </div>
                        <span class="text-2xl font-bold text-red-600" x-text="stats.rejectedDoctors ?? 0"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Doctor Approvals -->
        <div class="bg-white rounded-lg shadow p-6 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Pending Doctor Approvals</h2>

            @if($pendingDoctors->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pendingDoctors as $doc)
                        <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg transition duration-300 bg-gradient-to-br from-gray-50 to-white"
                             x-data="{ expanded: false }">
                            <!-- Profile Section -->
                            <div class="flex items-start gap-4 mb-4">
                                @if($doc->doctor?->profile_image)
                                    <img src="{{ asset('storage/' . $doc->doctor->profile_image) }}"
                                         alt="{{ $doc->name }}"
                                         class="w-16 h-16 rounded-full object-cover shadow">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center shadow">
                                        <span class="text-gray-700 text-lg font-bold">{{ substr($doc->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-900 truncate">{{ $doc->name }}</h3>
                                    <p class="text-sm text-gray-600 truncate">{{ $doc->email }}</p>
                                    <span class="inline-block mt-2 px-2 py-1 rounded text-xs font-medium
                                        {{ $doc->status=='pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                        {{ ucfirst($doc->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Info Section -->
                            <div class="border-t pt-4 mb-4">
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Phone:</span>
                                        <span class="font-medium text-gray-900">{{ $doc->doctor?->phone ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Specialization:</span>
                                        <span class="font-medium text-gray-900">{{ $doc->doctor?->specialist ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Experience:</span>
                                        <span class="font-medium text-gray-900">{{ $doc->doctor?->experience_years ?? '-' }} yrs</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Consultation Fee:</span>
                                        <span class="font-medium text-gray-900">৳{{ $doc->doctor?->consultation_fee ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Expanded Details -->
                            <div x-show="expanded" x-transition class="border-t pt-4 mb-4 space-y-2 text-sm">
                                <div>
                                    <p class="text-gray-600 font-medium mb-1">Qualification:</p>
                                    <p class="text-gray-900">{{ $doc->doctor?->qualification ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium mb-1">Bio:</p>
                                    <p class="text-gray-900 break-words">{{ $doc->doctor?->bio ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium mb-1">Clinic Address:</p>
                                    <p class="text-gray-900">{{ $doc->doctor?->clinic_address ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium mb-1">BMDC Reg #:</p>
                                    <p class="text-gray-900">{{ $doc->doctor?->bmdc_registration_number ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 flex-col sm:flex-row">
                                <button
                                    @click="expanded = !expanded"
                                    class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded font-medium hover:bg-gray-200 transition text-sm">
                                    <span x-show="!expanded">View More</span>
                                    <span x-show="expanded">Hide</span>
                                </button>
                                <form method="POST" action="{{ route('admin.approveDoctor', $doc->id) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2 bg-green-500 text-white rounded font-medium hover:bg-green-600 transition text-sm">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.rejectDoctor', $doc->id) }}" class="flex-1" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-3 py-2 bg-red-500 text-white rounded font-medium hover:bg-red-600 transition text-sm">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">✓ No pending doctor approvals at the moment.</p>
                </div>
            @endif
        </div>

    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

<script>
    const chartColors = {
        blue: '#3B82F6',
        green: '#10B981',
        purple: '#8B5CF6',
        red: '#EF4444',
        yellow: '#FBBF24',
        orange: '#F97316',
        cyan: '#06B6D4',
        pink: '#EC4899',
    };

    let chartInstances = {
        usersByRole: null,
        appointmentsByStatus: null,
        doctorsBySpecialization: null
    };

    // Alpine.js Dashboard Filter Function
    function dashboardFilter() {
        return {
            selectedDate: new Date().toISOString().split('T')[0],
            stats: {
                totalUsers: {{ $totalUsers ?? 0 }},
                totalPatients: {{ $totalPatients ?? 0 }},
                totalDoctors: {{ $totalDoctors ?? 0 }},
                totalAdmins: {{ $totalAdmins ?? 0 }},
                approvedDoctors: {{ $approvedDoctors ?? 0 }},
                rejectedDoctors: {{ $rejectedDoctors ?? 0 }},
                totalAppointments: {{ $totalAppointments ?? 0 }},
                pendingAppointments: {{ $pendingAppointments ?? 0 }},
                approvedAppointments: {{ $approvedAppointments ?? 0 }},
                completedAppointments: {{ $completedAppointments ?? 0 }},
                cancelledAppointments: {{ $cancelledAppointments ?? 0 }},
            },
            chartData: @json($chartData ?? []),

            async fetchStatistics() {
                try {
                    const response = await fetch(`/admin/dashboard/stats-by-date?date=${this.selectedDate}`);
                    const data = await response.json();

                    // Update stats
                    this.stats = {
                        totalUsers: data.totalUsers,
                        totalPatients: data.totalPatients,
                        totalDoctors: data.totalDoctors,
                        totalAdmins: data.totalAdmins,
                        approvedDoctors: data.approvedDoctors,
                        rejectedDoctors: data.rejectedDoctors,
                        totalAppointments: data.totalAppointments,
                        pendingAppointments: data.pendingAppointments,
                        approvedAppointments: data.approvedAppointments,
                        completedAppointments: data.completedAppointments,
                        cancelledAppointments: data.cancelledAppointments,
                    };

                    // Update chart data
                    this.chartData = data.chartData;

                    // Recreate charts with new data
                    this.updateCharts();
                } catch (error) {
                    console.error('Error fetching statistics:', error);
                }
            },

            updateCharts() {
                // Destroy existing chart instances
                if (chartInstances.usersByRole) chartInstances.usersByRole.destroy();
                if (chartInstances.appointmentsByStatus) chartInstances.appointmentsByStatus.destroy();
                if (chartInstances.doctorsBySpecialization) chartInstances.doctorsBySpecialization.destroy();

                // Create new charts with updated data
                this.createCharts();
            },

            createCharts() {
                // Users by Role Chart
                const usersByRoleCtx = document.getElementById('usersByRoleChart');
                if (usersByRoleCtx) {
                    const ctx = usersByRoleCtx.getContext('2d');
                    chartInstances.usersByRole = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(this.chartData.usersByRole || {}),
                            datasets: [{
                                data: Object.values(this.chartData.usersByRole || {}),
                                backgroundColor: [chartColors.green, chartColors.purple, chartColors.orange],
                                borderColor: '#ffffff',
                                borderWidth: 3,
                                padding: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        font: { size: 12, weight: '600' },
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                }
                            }
                        }
                    });
                }

                // Appointments by Status Chart
                const appointmentsByStatusCtx = document.getElementById('appointmentsByStatusChart');
                if (appointmentsByStatusCtx) {
                    const ctx = appointmentsByStatusCtx.getContext('2d');
                    chartInstances.appointmentsByStatus = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(this.chartData.appointmentsByStatus || {}),
                            datasets: [{
                                label: 'Appointments',
                                data: Object.values(this.chartData.appointmentsByStatus || {}),
                                backgroundColor: [chartColors.yellow, chartColors.green, chartColors.blue, chartColors.red],
                                borderRadius: 6,
                                borderSkipped: false,
                                borderColor: 'transparent'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            indexAxis: 'y',
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: { font: { size: 11, weight: '600' } },
                                    grid: { color: '#f0f0f0' }
                                },
                                y: {
                                    ticks: { font: { size: 12, weight: '600' } },
                                    grid: { display: false }
                                }
                            }
                        }
                    });
                }

                // Doctors by Specialization Chart
                const doctorsBySpecCtx = document.getElementById('doctorsBySpecializationChart');
                if (doctorsBySpecCtx) {
                    const ctx = doctorsBySpecCtx.getContext('2d');
                    const specs = Object.keys(this.chartData.doctorsBySpecialization || {});
                    const specCounts = Object.values(this.chartData.doctorsBySpecialization || {});
                    const colorPalette = [chartColors.blue, chartColors.green, chartColors.purple, chartColors.orange, chartColors.red, chartColors.yellow, chartColors.cyan, chartColors.pink];

                    chartInstances.doctorsBySpecialization = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: specs,
                            datasets: [{
                                label: 'Doctors',
                                data: specCounts,
                                backgroundColor: colorPalette.slice(0, specs.length),
                                borderRadius: 6,
                                borderSkipped: false,
                                borderColor: 'transparent'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            indexAxis: 'y',
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: { font: { size: 11, weight: '600' } },
                                    grid: { color: '#f0f0f0' }
                                },
                                y: {
                                    ticks: { font: { size: 12, weight: '600' } },
                                    grid: { display: false }
                                }
                            }
                        }
                    });
                }
            },

            resetDate() {
                this.selectedDate = new Date().toISOString().split('T')[0];
                this.fetchStatistics();
            },

            init() {
                // Create initial charts
                setTimeout(() => {
                    this.createCharts();
                }, 100);
            }
        };
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Charts will be initialized by Alpine.js
    });
</script>

@endsection

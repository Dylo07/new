@extends('layouts.app')

@section('title', 'Edit Availability - Soba Lanka')

@section('content')
<div class="min-h-screen bg-black py-16">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl text-white font-light">Edit Room Availability</h1>
            <a href="{{ route('admin.calendar') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Back to Calendar
            </a>
        </div>
        
        <!-- Edit Instructions -->
        <div class="mb-8 p-6 bg-gray-900 rounded-lg">
            <h3 class="text-white text-xl mb-4">How to Edit Availability:</h3>
            <ul class="list-disc list-inside text-gray-300 space-y-2">
                <li>Click on any date to change its status</li>
                <li>Clicking will cycle through: Available → Limited → Booked → Available</li>
                <li>Changes are saved automatically</li>
            </ul>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Current Month Calendar -->
            <div>
                <h2 class="text-2xl text-white text-center mb-4">{{ $currentMonth->format('F Y') }}</h2>
                <div class="grid grid-cols-7 gap-1 text-center mb-2">
                    <div class="text-red-500">S</div>
                    <div class="text-white">M</div>
                    <div class="text-white">T</div>
                    <div class="text-white">W</div>
                    <div class="text-white">T</div>
                    <div class="text-white">F</div>
                    <div class="text-red-500">S</div>
                </div>

                <div class="grid grid-cols-7 gap-1">
                    @php
                        $startDay = $currentMonth->copy()->startOfMonth()->dayOfWeek;
                        $daysInMonth = $currentMonth->daysInMonth;
                    @endphp

                    @for ($i = 0; $i < $startDay; $i++)
                        <div></div>
                    @endfor

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = $currentMonth->copy()->startOfMonth()->addDays($day - 1);
                            $dateString = $date->format('Y-m-d');
                            $status = $currentMonthAvailability[$dateString] ?? 'available';
                            
                            $bgClass = 'bg-green-500'; // Available
                            if ($status === 'limited') {
                                $bgClass = 'bg-yellow-500';
                            } elseif ($status === 'booked') {
                                $bgClass = 'bg-red-500';
                            }
                        @endphp
                        
                        <div 
                            class="day-cell {{ $bgClass }} rounded-lg p-2 text-center text-white cursor-pointer hover:opacity-80 transition-opacity flex items-center justify-center"
                            data-date="{{ $dateString }}"
                            data-status="{{ $status }}"
                        >
                            {{ $day }}
                        </div>
                    @endfor
                </div>
            </div>
            
            <!-- Next Month Calendar -->
            <div>
                <h2 class="text-2xl text-white text-center mb-4">{{ $nextMonth->format('F Y') }}</h2>
                <div class="grid grid-cols-7 gap-1 text-center mb-2">
                    <div class="text-red-500">S</div>
                    <div class="text-white">M</div>
                    <div class="text-white">T</div>
                    <div class="text-white">W</div>
                    <div class="text-white">T</div>
                    <div class="text-white">F</div>
                    <div class="text-red-500">S</div>
                </div>

                <div class="grid grid-cols-7 gap-1">
                    @php
                        $startDay = $nextMonth->copy()->startOfMonth()->dayOfWeek;
                        $daysInMonth = $nextMonth->daysInMonth;
                    @endphp

                    @for ($i = 0; $i < $startDay; $i++)
                        <div></div>
                    @endfor

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = $nextMonth->copy()->startOfMonth()->addDays($day - 1);
                            $dateString = $date->format('Y-m-d');
                            $status = $nextMonthAvailability[$dateString] ?? 'available';
                            
                            $bgClass = 'bg-green-500'; // Available
                            if ($status === 'limited') {
                                $bgClass = 'bg-yellow-500';
                            } elseif ($status === 'booked') {
                                $bgClass = 'bg-red-500';
                            }
                        @endphp
                        
                        <div 
                            class="day-cell {{ $bgClass }} rounded-lg p-2 text-center text-white cursor-pointer hover:opacity-80 transition-opacity flex items-center justify-center"
                            data-date="{{ $dateString }}"
                            data-status="{{ $status }}"
                        >
                            {{ $day }}
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        <div class="flex justify-center mt-8 gap-8">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-green-500 rounded-full mr-2"></div>
                <span class="text-white">Available</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></div>
                <span class="text-white">Limited Availability</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                <span class="text-white">Fully Booked</span>
            </div>
        </div>
        
        <!-- Status Message -->
        <div class="mt-8 bg-black p-4 rounded-lg text-center text-white" id="status-message">
            <!-- Status messages will appear here -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dayCells = document.querySelectorAll('.day-cell');
        const statusMessage = document.getElementById('status-message');
        
        dayCells.forEach(cell => {
            cell.addEventListener('click', function() {
                const date = this.dataset.date;
                const currentStatus = this.dataset.status;
                
                // Display status
                statusMessage.innerHTML = `Changing ${date} from <span class="font-bold">${currentStatus}</span> to...`;
                
                // Cycle through statuses
                let newStatus = 'available';
                if (currentStatus === 'available') {
                    newStatus = 'limited';
                } else if (currentStatus === 'limited') {
                    newStatus = 'booked';
                }
                
                // Update via AJAX
                fetch('{{ route('calendar.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        date: date,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI
                        this.dataset.status = newStatus;
                        this.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-red-500');
                        
                        if (newStatus === 'available') {
                            this.classList.add('bg-green-500');
                        } else if (newStatus === 'limited') {
                            this.classList.add('bg-yellow-500');
                        } else {
                            this.classList.add('bg-red-500');
                        }
                        
                        // Update status message
                        statusMessage.innerHTML = `<span class="text-green-500">Successfully updated ${date} to ${newStatus}</span>`;
                    }
                })
                .catch(error => {
                    console.error('Error updating availability:', error);
                    statusMessage.innerHTML = `<span class="text-red-500">Error updating availability. Please try again.</span>`;
                });
            });
        });
    });
</script>
@endsection
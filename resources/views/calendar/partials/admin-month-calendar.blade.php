<table class="w-full border-collapse">
    <thead>
        <tr>
            <th class="p-2 text-red-500">S</th>
            <th class="p-2 text-white">M</th>
            <th class="p-2 text-white">T</th>
            <th class="p-2 text-white">W</th>
            <th class="p-2 text-white">T</th>
            <th class="p-2 text-white">F</th>
            <th class="p-2 text-red-500">S</th>
        </tr>
    </thead>
    <tbody>
        @php
            $startDay = $month->copy()->startOfMonth()->dayOfWeek;
            $daysInMonth = $month->daysInMonth;
            $currentDay = 1;
        @endphp
        
        @for ($i = 0; $i < 6; $i++)
            @if ($currentDay <= $daysInMonth)
                <tr>
                    @for ($j = 0; $j < 7; $j++)
                        @if (($i === 0 && $j < $startDay) || $currentDay > $daysInMonth)
                            <td class="p-2"></td>
                        @else
                            @php
                                $date = $month->copy()->startOfMonth()->addDays($currentDay - 1);
                                $dateString = $date->format('Y-m-d');
                                $status = $availability[$dateString] ?? 'available';
                                
                                $bgClass = 'bg-green-500'; // Available
                                if ($status === 'limited') {
                                    $bgClass = 'bg-yellow-500';
                                } elseif ($status === 'booked') {
                                    $bgClass = 'bg-red-500';
                                }
                            @endphp
                            
                            <td class="p-2 text-center">
                                <div 
                                    class="date-cell {{ $bgClass }} rounded-lg py-1 text-white cursor-pointer hover:opacity-80 transition-opacity"
                                    data-date="{{ $dateString }}"
                                    data-status="{{ $status }}"
                                >
                                    {{ $currentDay }}
                                </div>
                            </td>
                            @php $currentDay++; @endphp
                        @endif
                    @endfor
                </tr>
            @endif
        @endfor
    </tbody>
</table>
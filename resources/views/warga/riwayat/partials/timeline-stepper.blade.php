{{-- Dynamic Stepper Timeline for Pengajuan --}}
@php
    $timeline = $pengajuan->getTimelineSteps();
    $completedCount = collect($timeline)->where('status', 'completed')->count();
    $totalSteps = count($timeline);
    $progressPercent = ($completedCount / $totalSteps) * 100;
@endphp

<div class="px-6 lg:px-8 pb-8" id="stepper-container">
    @foreach($timeline as $index => $step)
        <div class="flex gap-4 relative {{ $index < count($timeline) - 1 ? 'pb-8' : '' }}">
            {{-- Line --}}
            @if($index < count($timeline) - 1)
                <div class="stepper-line @if($step['status'] === 'completed') completed @elseif($step['status'] === 'active' || ($step['status'] === 'pending' && $index < $completedCount)) active @endif"></div>
            @endif
            
            {{-- Dot --}}
            <div class="stepper-dot {{ $step['status'] }}">
                @if($step['status'] === 'completed')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                @elseif($step['status'] === 'active')
                    <span class="material-icons-outlined text-base">more_horiz</span>
                @elseif($step['status'] === 'rejected')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                @else
                    {{-- Pending: download icon for final step --}}
                    @if($index === count($timeline) - 1)
                        <span class="material-icons-outlined text-base">download</span>
                    @endif
                @endif
            </div>
            
            {{-- Content --}}
            <div class="flex-1 min-w-0 pt-1">
                <p class="text-sm font-semibold" style="color: {{ $step['status'] === 'rejected' ? '#ba1a1a' : ($step['status'] === 'active' ? '#00685d' : '#191c1e') }};">
                    {{ $step['label'] }}
                </p>
                <p class="text-xs mt-0.5" style="color: #3d4947;">
                    {{ $step['description'] }}
                </p>
                
                @if($step['status'] === 'active')
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold mt-2" style="background-color: #c7e7ff; color: #064c6b;">
                        <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #064c6b;"></span>
                        Sedang Berlangsung
                    </span>
                @elseif($step['timestamp'])
                    <p class="text-[11px] font-medium mt-1.5" style="color: #6d7a77;">
                        {{ $step['timestamp']->format('d M Y, H:i') }} WIB
                    </p>
                @endif
            </div>
        </div>
    @endforeach
</div>

{{-- Progress Bar --}}
<div class="px-6 lg:px-8 pb-4">
    <div class="rounded-xl bg-gray-100 p-3">
        <div class="w-full rounded-full h-2" style="background-color: #e0e3e5;">
            <div class="h-2 rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%; background: linear-gradient(90deg, #416538, #597e4f);"></div>
        </div>
        <p class="text-xs font-medium mt-2 text-right" style="color: #6d7a77;">
            {{ $completedCount }} dari {{ $totalSteps }} tahap selesai
        </p>
    </div>
</div>

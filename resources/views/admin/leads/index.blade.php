@extends('layouts.admin')

@section('title', 'Leads CRM')
@section('page_title', 'Leads & CRM')
@section('page_subtitle', 'Track visitor interest, abandoned bookings, and follow-up actions')

@section('page_actions')
    <form method="GET" class="flex items-center gap-2">
        <select name="period" onchange="this.form.submit()" class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            <option value="7" {{ $period == 7 ? 'selected' : '' }}>Last 7 days</option>
            <option value="30" {{ $period == 30 ? 'selected' : '' }}>Last 30 days</option>
            <option value="90" {{ $period == 90 ? 'selected' : '' }}>Last 90 days</option>
            <option value="365" {{ $period == 365 ? 'selected' : '' }}>Last year</option>
        </select>
    </form>
    <button onclick="document.getElementById('addLeadModal').classList.remove('hidden')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm font-medium transition">
        + Add Lead
    </button>
    <form action="{{ route('admin.leads.mark-stale') }}" method="POST">
        @csrf
        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded text-sm border border-gray-700 transition" onclick="return confirm('Mark all leads inactive for 2+ hours as abandoned?')">
            Clean Stale
        </button>
    </form>
@endsection

@section('content')

        {{-- ============================================= --}}
        {{-- CONVERSION FUNNEL STATS                       --}}
        {{-- ============================================= --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mb-8">
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-white">{{ $stats['total'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Total Leads</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-blue-400">{{ $stats['started'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Started</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-cyan-400">{{ $stats['browsing'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Browsing</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-yellow-400">{{ $stats['reviewed'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Reviewed</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-red-400">{{ $stats['abandoned'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Abandoned</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-emerald-400">{{ $stats['converted'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Converted</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center">
                <p class="text-2xl font-bold text-emerald-400">{{ $stats['conversion_rate'] }}%</p>
                <p class="text-xs text-gray-400 mt-1">Conv. Rate</p>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 text-center {{ $stats['needs_followup'] > 0 ? 'border-red-500/50 bg-red-900/10' : '' }}">
                <p class="text-2xl font-bold {{ $stats['needs_followup'] > 0 ? 'text-red-400' : 'text-gray-400' }}">{{ $stats['needs_followup'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Need Follow-up</p>
            </div>
        </div>

        {{-- Revenue Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Revenue (Converted)</p>
                        <p class="text-2xl font-bold text-emerald-400 mt-1">Rs {{ number_format($stats['revenue'], 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Lost Revenue (Abandoned)</p>
                        <p class="text-2xl font-bold text-red-400 mt-1">Rs {{ number_format($stats['lost_revenue'], 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-500/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Top Category</p>
                        @php $topCat = $categoryStats->sortByDesc('total')->first(); @endphp
                        <p class="text-2xl font-bold text-purple-400 mt-1">{{ $topCat ? ucfirst($topCat->category) : 'N/A' }}</p>
                        <p class="text-xs text-gray-500">{{ $topCat ? $topCat->total . ' leads, ' . $topCat->converted . ' converted' : '' }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category & Source Breakdown --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            {{-- By Category --}}
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                <h3 class="text-white font-medium mb-4">By Package Category</h3>
                @forelse($categoryStats as $cat)
                    <div class="flex items-center justify-between py-2 border-b border-gray-800 last:border-0">
                        <span class="text-gray-300">{{ ucfirst($cat->category) }}</span>
                        <div class="flex items-center gap-4">
                            <span class="text-gray-400 text-sm">{{ $cat->total }} leads</span>
                            <span class="text-emerald-400 text-sm font-medium">{{ $cat->converted }} converted</span>
                            <span class="text-gray-500 text-xs">{{ $cat->total > 0 ? round(($cat->converted / $cat->total) * 100) : 0 }}%</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No category data yet.</p>
                @endforelse
            </div>
            {{-- By Source --}}
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                <h3 class="text-white font-medium mb-4">By Lead Source</h3>
                @forelse($sourceStats as $src)
                    <div class="flex items-center justify-between py-2 border-b border-gray-800 last:border-0">
                        <span class="text-gray-300">{{ ucfirst(str_replace('_', ' ', $src->source)) }}</span>
                        <div class="flex items-center gap-4">
                            <span class="text-gray-400 text-sm">{{ $src->total }} leads</span>
                            <span class="text-emerald-400 text-sm font-medium">{{ $src->converted }} converted</span>
                            <span class="text-gray-500 text-xs">{{ $src->total > 0 ? round(($src->converted / $src->total) * 100) : 0 }}%</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No source data yet.</p>
                @endforelse
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- FILTERS                                       --}}
        {{-- ============================================= --}}
        <div class="bg-gray-900 rounded-lg border border-gray-800 p-4 mb-6">
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <input type="hidden" name="period" value="{{ $period }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, phone..." class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm w-64 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                <select name="status" class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    <option value="">All Statuses</option>
                    <option value="started" {{ request('status') === 'started' ? 'selected' : '' }}>Started</option>
                    <option value="browsing" {{ request('status') === 'browsing' ? 'selected' : '' }}>Browsing</option>
                    <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="abandoned" {{ request('status') === 'abandoned' ? 'selected' : '' }}>Abandoned</option>
                    <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted</option>
                </select>
                <select name="source" class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    <option value="">All Sources</option>
                    <option value="package_builder" {{ request('source') === 'package_builder' ? 'selected' : '' }}>Package Builder</option>
                    <option value="whatsapp" {{ request('source') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                    <option value="contact_form" {{ request('source') === 'contact_form' ? 'selected' : '' }}>Contact Form</option>
                    <option value="phone" {{ request('source') === 'phone' ? 'selected' : '' }}>Phone</option>
                    <option value="manual" {{ request('source') === 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
                <select name="category" class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    <option value="">All Categories</option>
                    <option value="couple" {{ request('category') === 'couple' ? 'selected' : '' }}>Couple</option>
                    <option value="family" {{ request('category') === 'family' ? 'selected' : '' }}>Family</option>
                    <option value="group" {{ request('category') === 'group' ? 'selected' : '' }}>Group</option>
                    <option value="wedding" {{ request('category') === 'wedding' ? 'selected' : '' }}>Wedding</option>
                </select>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500" placeholder="From">
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500" placeholder="To">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm font-medium transition">Filter</button>
                <a href="{{ route('admin.leads.index', ['period' => $period]) }}" class="text-gray-400 hover:text-white text-sm transition">Clear</a>
            </form>
        </div>

        {{-- ============================================= --}}
        {{-- LEADS TABLE                                   --}}
        {{-- ============================================= --}}
        <div class="bg-gray-900 rounded-lg border border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-800 text-gray-400 text-sm uppercase">
                            <th class="px-4 py-3">Lead</th>
                            <th class="px-4 py-3">Contact</th>
                            <th class="px-4 py-3">Interest</th>
                            <th class="px-4 py-3">Dates</th>
                            <th class="px-4 py-3">Value</th>
                            <th class="px-4 py-3">Source</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Last Activity</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($leads as $lead)
                            <tr class="hover:bg-gray-800/50 transition 
                                {{ in_array($lead->status, ['abandoned', 'reviewed']) && !$lead->followed_up_at ? 'bg-red-900/10 border-l-4 border-red-500' : '' }}
                                {{ $lead->status === 'converted' ? 'bg-emerald-900/10' : '' }}">
                                
                                {{-- Lead ID & Time --}}
                                <td class="px-4 py-3 text-gray-300">
                                    <span class="text-white font-medium">#{{ $lead->id }}</span>
                                    <div class="text-xs text-gray-500">{{ $lead->created_at->format('M d, H:i') }}</div>
                                    @if($lead->device_type)
                                        <div class="text-xs text-gray-600">{{ ucfirst($lead->device_type) }}</div>
                                    @endif
                                </td>

                                {{-- Contact Info --}}
                                <td class="px-4 py-3">
                                    <div class="text-white font-medium text-sm">{{ $lead->getDisplayName() }}</div>
                                    @if($lead->getContactEmail())
                                        <div class="text-xs text-gray-500">{{ $lead->getContactEmail() }}</div>
                                    @endif
                                    @if($lead->getContactPhone())
                                        <a href="tel:{{ $lead->getContactPhone() }}" class="text-xs text-emerald-500 hover:underline">
                                            {{ $lead->getContactPhone() }}
                                        </a>
                                    @endif
                                </td>

                                {{-- Package Interest --}}
                                <td class="px-4 py-3">
                                    @if($lead->package_name || $lead->category)
                                        <span class="text-emerald-400 font-medium text-sm">
                                            {{ $lead->package_name ?? ucfirst($lead->category) }}
                                        </span>
                                        <div class="text-xs text-gray-500">
                                            {{ $lead->package_type ? ucfirst(str_replace('_', ' ', $lead->package_type)) : '' }}
                                            @if($lead->adults)
                                                &middot; {{ $lead->adults }} adults
                                                @if($lead->children) +{{ $lead->children }} kids @endif
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-500 text-xs">Not specified</span>
                                    @endif
                                </td>

                                {{-- Dates --}}
                                <td class="px-4 py-3 text-gray-300 text-sm">
                                    @if($lead->check_in)
                                        <div>In: {{ $lead->check_in->format('M d') }}</div>
                                        <div>Out: {{ $lead->check_out ? $lead->check_out->format('M d') : '-' }}</div>
                                    @else
                                        <span class="text-gray-500 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- Estimated Value --}}
                                <td class="px-4 py-3 text-white font-bold text-sm">
                                    @if($lead->estimated_value)
                                        Rs {{ number_format($lead->estimated_value, 0) }}
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>

                                {{-- Source --}}
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded text-xs font-medium {{ $lead->getSourceBadgeClass() }}">
                                        {{ ucfirst(str_replace('_', ' ', $lead->source)) }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold {{ $lead->getStatusBadgeClass() }}">
                                        {{ ucfirst($lead->status) }}
                                    </span>
                                    @if($lead->followed_up_at)
                                        <div class="text-xs text-gray-500 mt-1" title="Followed up by {{ $lead->followed_up_by }}">
                                            Followed up {{ $lead->followed_up_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Last Activity --}}
                                <td class="px-4 py-3 text-gray-400 text-xs">
                                    {{ $lead->last_activity_at ? $lead->last_activity_at->diffForHumans() : $lead->created_at->diffForHumans() }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        {{-- WhatsApp Follow-up --}}
                                        @if($lead->getContactPhone() && $lead->status !== 'converted')
                                            <a href="{{ $lead->getWhatsAppFollowUpUrl() }}" target="_blank" 
                                               class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs font-medium transition inline-flex items-center gap-1" title="Send WhatsApp Follow-up">
                                                <svg viewBox="0 0 24 24" class="w-3.5 h-3.5" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.832-1.438A9.955 9.955 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 01-4.243-1.214l-.252-.149-2.868.852.852-2.868-.149-.252A8 8 0 1112 20z"/></svg>
                                                WhatsApp
                                            </a>
                                        @endif

                                        {{-- Mark Followed Up --}}
                                        @if(!$lead->followed_up_at && in_array($lead->status, ['abandoned', 'reviewed']))
                                            <form action="{{ route('admin.leads.follow-up', $lead) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs transition" title="Mark as followed up">
                                                    Done
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Edit Notes Modal Trigger --}}
                                        <button onclick="openEditModal({{ $lead->id }}, '{{ addslashes($lead->staff_notes ?? '') }}', '{{ addslashes($lead->guest_name ?? '') }}', '{{ addslashes($lead->guest_phone ?? '') }}', '{{ addslashes($lead->guest_email ?? '') }}', '{{ $lead->status }}')" 
                                                class="bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs transition" title="Edit / Add Notes">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-500 px-1 py-1 transition" onclick="return confirm('Delete this lead?')" title="Delete">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Staff Notes Preview --}}
                                    @if($lead->staff_notes)
                                        <div class="text-xs text-gray-500 mt-1 text-right max-w-[200px] truncate" title="{{ $lead->staff_notes }}">
                                            {{ $lead->staff_notes }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                    No leads found. Leads will appear here as visitors use the Package Builder.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-800">
                {{ $leads->links() }}
            </div>
        </div>

{{-- ============================================= --}}
{{-- EDIT LEAD MODAL                               --}}
{{-- ============================================= --}}
<div id="editLeadModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70">
    <div class="bg-gray-900 rounded-lg border border-gray-700 w-full max-w-lg mx-4 p-6">
        <h3 class="text-white text-lg font-medium mb-4">Edit Lead</h3>
        <form id="editLeadForm" method="POST">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Guest Name</label>
                    <input type="text" name="guest_name" id="editGuestName" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Phone</label>
                        <input type="text" name="guest_phone" id="editGuestPhone" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Email</label>
                        <input type="email" name="guest_email" id="editGuestEmail" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Status</label>
                    <select name="status" id="editStatus" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                        <option value="started">Started</option>
                        <option value="browsing">Browsing</option>
                        <option value="reviewed">Reviewed</option>
                        <option value="paid">Paid</option>
                        <option value="abandoned">Abandoned</option>
                        <option value="converted">Converted</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Staff Notes</label>
                    <textarea name="staff_notes" id="editStaffNotes" rows="3" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500" placeholder="Add notes about this lead..."></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('editLeadModal').classList.add('hidden')" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm transition">Cancel</button>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm font-medium transition">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- ============================================= --}}
{{-- ADD MANUAL LEAD MODAL                         --}}
{{-- ============================================= --}}
<div id="addLeadModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70">
    <div class="bg-gray-900 rounded-lg border border-gray-700 w-full max-w-lg mx-4 p-6">
        <h3 class="text-white text-lg font-medium mb-4">Add Manual Lead</h3>
        <form action="{{ route('admin.leads.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Name *</label>
                        <input type="text" name="guest_name" required class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Source *</label>
                        <select name="source" required class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                            <option value="whatsapp">WhatsApp</option>
                            <option value="phone">Phone Call</option>
                            <option value="contact_form">Contact Form</option>
                            <option value="manual">Walk-in / Other</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Phone</label>
                        <input type="text" name="guest_phone" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Email</label>
                        <input type="email" name="guest_email" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Category</label>
                        <select name="category" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                            <option value="">Not specified</option>
                            <option value="couple">Couple</option>
                            <option value="family">Family</option>
                            <option value="group">Group</option>
                            <option value="wedding">Wedding</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Package Type</label>
                        <select name="package_type" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                            <option value="">Not specified</option>
                            <option value="day_out">Day Out</option>
                            <option value="half_board">Half Board</option>
                            <option value="full_board">Full Board</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Adults</label>
                        <input type="number" name="adults" min="1" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Children</label>
                        <input type="number" name="children" min="0" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Est. Value (Rs)</label>
                        <input type="number" name="estimated_value" min="0" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Check-in</label>
                        <input type="date" name="check_in" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Check-out</label>
                        <input type="date" name="check_out" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Notes</label>
                    <textarea name="staff_notes" rows="2" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-3 py-2 text-sm focus:border-emerald-500" placeholder="Any notes about this inquiry..."></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('addLeadModal').classList.add('hidden')" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm transition">Cancel</button>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm font-medium transition">Create Lead</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditModal(id, notes, name, phone, email, status) {
    document.getElementById('editLeadForm').action = '/admin/leads/' + id;
    document.getElementById('editStaffNotes').value = notes;
    document.getElementById('editGuestName').value = name;
    document.getElementById('editGuestPhone').value = phone;
    document.getElementById('editGuestEmail').value = email;
    document.getElementById('editStatus').value = status;
    document.getElementById('editLeadModal').classList.remove('hidden');
}

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('editLeadModal').classList.add('hidden');
        document.getElementById('addLeadModal').classList.add('hidden');
    }
});

// Close modals on backdrop click
['editLeadModal', 'addLeadModal'].forEach(function(id) {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
});
</script>
@endpush
@endsection

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'booking_id',
        'source',
        'status',
        'category',
        'package_type',
        'custom_package_id',
        'package_name',
        'adults',
        'children',
        'check_in',
        'check_out',
        'estimated_value',
        'guest_name',
        'guest_email',
        'guest_phone',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'referrer_url',
        'landing_page',
        'device_type',
        'ip_address',
        'staff_notes',
        'last_activity_at',
        'followed_up_at',
        'followed_up_by',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'last_activity_at' => 'datetime',
        'followed_up_at' => 'datetime',
        'estimated_value' => 'decimal:2',
    ];

    // --- Relationships ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function customPackage()
    {
        return $this->belongsTo(CustomPackage::class);
    }

    // --- Scopes ---

    public function scopeAbandoned($query)
    {
        return $query->where('status', 'abandoned');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['started', 'browsing', 'reviewed']);
    }

    public function scopeConverted($query)
    {
        return $query->where('status', 'converted');
    }

    public function scopeNeedsFollowUp($query)
    {
        return $query->whereIn('status', ['abandoned', 'reviewed'])
            ->whereNull('followed_up_at');
    }

    public function scopeFromSource($query, $source)
    {
        return $query->where('source', $source);
    }

    public function scopeFromCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // --- Helpers ---

    public function getDisplayName(): string
    {
        if ($this->user) {
            return $this->user->name;
        }
        return $this->guest_name ?? 'Anonymous Visitor';
    }

    public function getContactPhone(): ?string
    {
        if ($this->user && $this->user->phone) {
            return $this->user->phone;
        }
        return $this->guest_phone;
    }

    public function getContactEmail(): ?string
    {
        if ($this->user) {
            return $this->user->email;
        }
        return $this->guest_email;
    }

    public function getWhatsAppFollowUpUrl(): string
    {
        $phone = $this->getContactPhone();
        if (!$phone) {
            return '#';
        }

        // Clean phone number
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '94' . substr($cleanPhone, 1);
        }
        if (!str_starts_with($cleanPhone, '94')) {
            $cleanPhone = '94' . $cleanPhone;
        }

        $message = $this->buildFollowUpMessage();
        return 'https://wa.me/' . $cleanPhone . '?text=' . urlencode($message);
    }

    protected function buildFollowUpMessage(): string
    {
        $name = $this->getDisplayName();
        $packageInfo = $this->package_name ?? ucfirst($this->category ?? 'holiday') . ' package';

        $msg = "Hi {$name}! 👋\n\n";
        $msg .= "Thank you for your interest in Soba Lanka Holiday Resort! ";
        $msg .= "We noticed you were looking at our *{$packageInfo}*";

        if ($this->adults) {
            $msg .= " for {$this->adults} guests";
        }
        if ($this->check_in) {
            $msg .= " on " . $this->check_in->format('M d, Y');
        }

        $msg .= ".\n\n";
        $msg .= "Would you like to complete your booking? We'd be happy to help with any questions! 😊\n\n";
        $msg .= "📞 +94 71 715 2955\n";
        $msg .= "🌐 https://sobalanka.com/package-builder";

        return $msg;
    }

    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'started' => 'bg-blue-500/20 text-blue-400',
            'browsing' => 'bg-cyan-500/20 text-cyan-400',
            'reviewed' => 'bg-yellow-500/20 text-yellow-400',
            'paid' => 'bg-emerald-500/20 text-emerald-400',
            'abandoned' => 'bg-red-500/20 text-red-400',
            'converted' => 'bg-green-500/20 text-green-400',
            default => 'bg-gray-500/20 text-gray-400',
        };
    }

    public function getSourceBadgeClass(): string
    {
        return match ($this->source) {
            'package_builder' => 'bg-purple-500/20 text-purple-400',
            'whatsapp' => 'bg-green-500/20 text-green-400',
            'contact_form' => 'bg-blue-500/20 text-blue-400',
            'phone' => 'bg-orange-500/20 text-orange-400',
            'manual' => 'bg-gray-500/20 text-gray-400',
            default => 'bg-gray-500/20 text-gray-400',
        };
    }

    public function markAsAbandoned(): void
    {
        if (in_array($this->status, ['started', 'browsing', 'reviewed'])) {
            $this->update([
                'status' => 'abandoned',
                'last_activity_at' => now(),
            ]);
        }
    }

    public function markAsConverted(int $bookingId): void
    {
        $this->update([
            'status' => 'converted',
            'booking_id' => $bookingId,
            'last_activity_at' => now(),
        ]);
    }
}

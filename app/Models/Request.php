<?php

namespace App\Models;

use App\Enum\Banks;
use App\Events\RequestPaidEvent;
use App\Events\RequestRejectedEvent;
use App\Gateways\Switcher;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Switch_;
use Throwable;

class Request extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'national_id',
        'desc',
        'amount',
        'sheba',
        'paid_at',
        'rejected_at',
        'rejection_reason',
        'approved_at',
    ];

    public function getStatusAttribute()
    {
        if ($this->getAttribute('approved_at') !== null && $this->getAttribute('rejected_at') === null) {
            return "تایید";
        } elseif ($this->getAttribute('approved_at') === null && $this->getAttribute('rejected_at') !== null) {
            return "رد";
        } else {
            return "بررسی";
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'national_id', 'national_id', __FUNCTION__);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id', __FUNCTION__);
    }

    public function approve()
    {
        $this->update([
            'approved_at' => now(),
            'rejected_at' => null,
        ]);
    }

    public function reject(string $reason = null)
    {
        $this->update([
            'rejected_at' => now(),
            'approved_at' => null,
            'rejection_reason' => $reason,
        ]);

        // dispatch an event
        RequestRejectedEvent::dispatch($this);
    }

    public function pay()
    {
        // Choose gateway based on sheba
        $driver = Switcher::gateway($this->sheba);

        try {
            DB::beginTransaction();

            $trx = Transaction::create([
                'national_id' => $this->national_id,
                'amount' => $this->amount,
                'driver' => \get_class($driver),
            ]);

            $result = $driver->transfer(Banks::SHEBA, $this->sheba, $this->amount);

            $trx->update([
                // 'succeeded' => $result['Status'] === 200,
                'succeeded' => true,
                'authority' => Arr::get($result, 'Authority'),
                'reference_id' => Arr::get($result, 'Reference_id'),
                'additional' => $result,
            ]);

            if ($trx->succeeded) {
                $this->update(['paid_at' => now(),]);
                // Dispatch an event
                RequestPaidEvent::dispatch($this);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            \report($e); // send to sentry for example
        }
    }
}

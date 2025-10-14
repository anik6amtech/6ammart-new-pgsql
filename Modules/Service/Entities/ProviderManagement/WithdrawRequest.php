<?php

namespace Modules\Service\Entities\ProviderManagement;

use App\Models\Admin;
use App\Models\WithdrawalMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawRequest extends Model
{
    use HasFactory;

    protected $table = 'service_withdraw_requests';

    protected $casts = [
        'amount' => 'float',
        'is_paid' => 'integer',
        'withdrawal_method_fields' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'request_updated_by',
        'updated_by_type',
        'amount',
        'request_status',
        'is_paid',
        'note',
        'admin_note',
        'withdrawal_method_id',
        'withdrawal_method_fields'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'user_id', 'id');
    }

    public function request_updater(): BelongsTo
    {
        if($this->updated_by_type == 'provider'){
            return $this->belongsTo(Provider::class, 'request_updated_by', 'id');
        }
        return $this->belongsTo(Admin::class, 'request_updated_by');
    }

    public function withdraw_method(): BelongsTo
    {
        return $this->belongsTo(WithdrawalMethod::class, 'withdrawal_method_id');
    }
}

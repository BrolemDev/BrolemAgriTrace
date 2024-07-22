<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryGuide extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason_id',
        'modality_id',
        'portcode_id',
        'ruc_destiny',
        'reason_destiny',
        'email_destiny',
        'init_transfer',
        'weight_transfer',
        'package_transfer',
        'container_transfer',
        'doc_transport',
        'number_transport',
        'names_transport',
        'plate_transport',
        'address_point',
        'address_destiny',
        'ubigeo_origin',
        'ubigeo_destiny',
    ];




    public function reason()
    {
        return $this->belongsTo(SunatReason::class, 'reason_id');
    }

    public function modality()
    {
        return $this->belongsTo(SunatModality::class, 'modality_id');
    }

    public function port()
    {
        return $this->belongsTo(SunatCodePort::class, 'portcode_id');
    }

    public function details()
    {
        return $this->hasMany(DeliveryGuideDetail::class);
    }

    public static function guides()
    {
        $guides = self::all();
        $data = [];
        foreach ($guides as $guide) {

            $totalWeight = $guide->details->sum('weight');

            $formattedDate = Carbon::parse($guide->created_at)->format('d-m-Y / h:i A');

            $data[] = [
                'id' => $guide->id,
                'date' => $formattedDate,
                'voucher' => $guide->id,
                'destiny' => $guide->ruc_destiny,
                'reason' => $guide->reason_destiny,
                'weight' => $totalWeight,
                'status' => $guide->status_guide,

            ];
        }

        return $data;
    }
}

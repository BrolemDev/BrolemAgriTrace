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
                'link' => url('/Validar_Guia?token=' . urlencode($guide->link_guide)),
                'status' => $guide->status_guide,

            ];
        }

        return $data;
    }

    public static function guideData($id)
    {
        $guide = self::find($id);

        if (!$guide) {
            return null;
        }

        $ubigeoOrigin = SunatCodeUbigeo::where('codigo_ubigeo', $guide->ubigeo_origin)->first();
        $ubigeoDestiny = SunatCodeUbigeo::where('codigo_ubigeo', $guide->ubigeo_destiny)->first();

        $formattedDate = Carbon::parse($guide->created_at)->format('d-m-Y / h:i A');

        return [
            'id' => $guide->id,
            'date' => $formattedDate,
            'dateTransfer' => $guide->init_transfer,
            'voucher' => $guide->id,
            'destiny' => $guide->ruc_destiny,
            'reason' => $guide->reason_destiny,
            'weight' => $guide->weight_transfer,
            'package' => $guide->package_transfer,
            'status' => $guide->status_guide,
            'typeDoc' => $guide->doc_transport,
            'transportDoc' => $guide->number_transport,
            'transport' => $guide->names_transport,
            'plate' => $guide->plate_transport,
            'addressPoint' => $guide->address_point,
            'addressDestiny' => $guide->address_destiny,
            'originUbigeo' => $guide->ubigeo_origin,
            'destinyUbigeo' => $guide->ubigeo_destiny,
            'reason_name' => optional($guide->reason)->description_reason,
            'modality_name' => optional($guide->modality)->description_modality,
            'port_name' =>  optional($guide->port)->description_portcode,
            'ubigeo_origin' => optional($ubigeoOrigin)->departamento . ' - ' . optional($ubigeoOrigin)->provincia . ' - ' . optional($ubigeoOrigin)->distrito,
            'ubigeo_destiny' => optional($ubigeoDestiny)->departamento . ' - ' . optional($ubigeoDestiny)->provincia . ' - ' . optional($ubigeoDestiny)->distrito,

            'details' => $guide->details->map(function ($detail) {
                return [
                    'code' => $detail->code,
                    'name' => $detail->name,
                    'description' => $detail->description,
                    'unit' => $detail->unit,
                    'weight' => $detail->weight,
                    'quantity' => $detail->quantity,
                ];
            }),
        ];
    }
}

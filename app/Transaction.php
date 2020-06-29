<?php

namespace App;

use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Transaction
 *
 * @property int $id
 * @property int $quantity
 * @property int $buyer_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Buyer $buyer
 * @property-read \App\Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereBuyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction withoutTrashed()
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use SoftDeletes;
    public $transformer=TransactionTransformer::class;
    protected $dates=['deleted_at'];
    protected $hidden =['pivot'];
    protected $fillable=[
        'quantity',
        'buyer_id',
        'product_id',
    ];
    //One To Many (Inverse)
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    //One To Many (Inverse)
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

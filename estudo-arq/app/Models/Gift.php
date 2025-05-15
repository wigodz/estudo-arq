<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    CONST COZINHA      = 1;
    CONST SALA_ESTAR   = 2;
    CONST QUARTO       = 3;
    CONST BANHEIRO     = 4;
    CONST LAVANDERIA   = 5;
    CONST AREA_EXTERNA = 6;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'url',
        'user_id',
        'avaliable',
        'categories',
    ];

    public $timestamps = false;

    public static function getCategorias(): array
    {
        return [
            self::COZINHA      => 'Cozinha',
            self::SALA_ESTAR   => 'Sala de Estar',
            self::QUARTO       => 'Quarto',
            self::BANHEIRO     => 'Banheiro',
            self::LAVANDERIA   => 'Lavanderia',
            self::AREA_EXTERNA => 'Área Externa',
        ];
    }
}

<?php

namespace Modules\Module\Entities;

use App\Models\Basemodel as Model;

// use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * Relationship: widgets.
     *
     * @return
     */
    public function widgets()
    {
        return $this->hasMany('Modules\Widget\Entities\Widget', 'menu_item_id');
    }
}

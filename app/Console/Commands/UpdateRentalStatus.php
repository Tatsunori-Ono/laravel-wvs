<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rental;
use App\Models\EquipmentItem;
use Carbon\Carbon;

class UpdateRentalStatus extends Command
{
    protected $signature = 'rental:update-status';
    protected $description = 'Update rental status and quantities';

    public function handle()
    {
        $rentals = Rental::where('return_by', '<', Carbon::now())->get();

        foreach ($rentals as $rental) {
            $equipmentItem = EquipmentItem::find($rental->equipment_item_id);
            $equipmentItem->rented_quantity -= $rental->quantity;
            $equipmentItem->save();

            $rental->delete();
        }

        return 0;
    }
}


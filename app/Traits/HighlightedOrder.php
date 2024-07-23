<?php

namespace App\Traits;

use App\Models\Testimoni;
use Illuminate\Support\Facades\DB;

trait HighlightedOrder {

    public function updateHighlightedOrder($highlightedOrder, $model)
    {

        DB::transaction(function () use ($highlightedOrder, $model) {
            // Proses data yang diterima dari formulir
            foreach ($highlightedOrder as $order => $id) {
               if ($id == null) {
                   $model::where('highlighted_order', $order + 1)->update([
                       'highlighted_order' => null,
                   ]);
               }
   
               else {
                   // cek apakah ada data $model dengan order yg sama
                   $dataOld = $model::select('id')->where('highlighted_order', $order + 1)->first();
   
                   // jika data id yang lama tidak sama dengan id yang baru maka update order data yang lama menjadi null
                   if ($dataOld != null && $dataOld->id != $id) {
                       $model::where('id', $dataOld->id)->update([
                           'highlighted_order' => null,
                       ]);
                   }
   
                   // update order testimoni yang baru
                   $model::where('id', $id)->update([
                       'highlighted_order' => $order + 1,
                   ]);
               }
           }
        });
    }
}
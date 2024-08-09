<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Sale;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Notifications\Notification;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // المساعدة في حساب تكرارات العناصر في مجموعة البيانات
function calculateItemFrequency($transactions, $itemSet) {
    $frequency = 0;
    foreach ($transactions as $transaction) {
        $isSubset = true;
        foreach ($itemSet as $item) {
            if (!in_array($item, $transaction)) {
                $isSubset = false;
                break;
            }
        }
        if ($isSubset) {
            $frequency++;
        }
    }
    return $frequency;
}

// حساب مجموعة البنود المرشحة
function generateCandidateItemSets($transactionList, $minSupport) {
    $candidateItemSets = [];
    $frequencyMap = [];

    // حساب تكرارات العناصر في مجموعة البيانات
    foreach ($transactionList as $transaction) {
        foreach ($transaction as $item) {
            if (!isset($frequencyMap[$item])) {
                $frequencyMap[$item] = 0;
            }
            $frequencyMap[$item]++;
        }
    }

    // إضافة العناصر التي تفي بشروط الدعم الأدنى إلى مجموعة البنود المرشحة
    foreach ($frequencyMap as $item => $frequency) {
        if ($frequency >= $minSupport) {
            $candidateItemSets[] = [$item];
        }
    }

    return $candidateItemSets;
}

// الحصول على مجموعة العناصر الممكنة من مجموعة البنود المرشحة
function generateFrequentItemSets($transactionList, $minSupport, $prevFrequentItemSets) {
    $candidateItemSets = [];
    $frequencyMap = [];
    // إنشاء مجموعة البنود المرشحة
    foreach ($prevFrequentItemSets as $i => $itemSet1) {
        foreach ($prevFrequentItemSets as $j => $itemSet2) {
            if ($i >= $j) {
                continue;
            }

            $newItemSet = array_unique(array_merge($itemSet1, $itemSet2));
            sort($newItemSet);

            // فحص مجموعة البنود المرشحة الجديدة للحصول على عنصر مكرر
            $isSubset = true;
            foreach ($newItemSet as $item) {
                $subset = array_diff($newItemSet, [$item]);
                sort($subset);
                if (!in_array($subset, $prevFrequentItemSets)) {
                    $isSubset = false;
                    break;
                }
            }

            // إضافة مجموعة البنود المرشحة الجديدة إلى القائمة إذا كانت ليست نسخة مكررة
            if ($isSubset && !in_array($newItemSet, $candidateItemSets)) {
                $candidateItemSets[] = $newItemSet;

                // حساب تكرارات مجموعة البنود المرشحة الجديدة
                $frequency = calculateItemFrequency($transactionList, $newItemSet);
                $frequencyMap[implode(',', $newItemSet)] = $frequency;
            }
        }
    }

    $frequentItemSets = [];

    // إضافة مجموعة البنود المرشحة التي تفي بشروط الدعم الأدنى إلى مجموعة البنود المتكررة
    foreach ($candidateItemSets as $itemSet) {
        $itemSetKey = implode(',', $itemSet);
        if ($frequencyMap[$itemSetKey] >= $minSupport) {
            $frequentItemSets[] = $itemSet;
        }
    }

    return $frequentItemSets;
}

// تنفيذ خوارزمالأن، يمكنك استخدام الدوال التالية لتنفيذ خوارزمية Apriori:


function apriori($transactionList, $minSupport) {
    $frequentItemSets = [];

    // مرحلة 1: حساب مجموعة البنود المرشحة للطول 1
    $candidateItemSets = generateCandidateItemSets($transactionList, $minSupport);
    $frequentItemSets[1] = $candidateItemSets;

    $k = 2; // طول مجموعة البنود

    while (count($frequentItemSets[$k - 1]) > 0) {
        // مرحلة 2: حساب مجموعة البنود المتكررة للطول k
        $candidateItemSets = generateFrequentItemSets($transactionList, $minSupport, $frequentItemSets[$k - 1]);

        if (count($candidateItemSets) > 0) {
            $frequentItemSets[$k] = $candidateItemSets;
            $k++;
        } else {
            break;
        }
    }
    return $frequentItemSets;
}
        $orders = Orders::all();
        $transactions = array();
            if(count($orders) > 0){
                foreach($orders as $order){
                    $rowArray = array();
                    $phrase = $order['opt_products'] ;
                    // استخراج الكلمات الموجودة خارج الأقواس
                    $pattern = '/(\w+)\s*\(.*?\)/';
                    preg_match_all($pattern, $phrase , $matches);
                    // طباعة الكلمات المستخرجة
                    $words = $matches[1];
                    foreach ($words as $word) {
                        // echo $word . "--";
                        $rowArray[] = $word;
                        }
                        $transactions[] = $rowArray;
                        // echo "<br/>";}
                }}
            $frequentItemSets = apriori($transactions, 2 );
            $x = 0 ;
            // طباعة مجموعات البنود المتكررة
            foreach ($frequentItemSets as $k => $itemSets) {
                // echo "Frequent Item Sets of length $k:";
                $x = $k ;
            }
            $freq = array();
            foreach ($frequentItemSets as $k => $itemSets) {
                if($k == $x){
                foreach ($itemSets as $itemSet) {
                    $freq[] = implode(',', $itemSet) ;
                }
                }}
        return view('Admin.sale' , [
            'products' => Menu::all() , 'frequentItemSets' => $freq
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = array();
        $s = Sale::all();
        foreach($s as $v){
            if( strtotime($v['finall_date']) > strtotime(date('Y-m-d'))){
                        $sales[] = $v;
            }
        }
        return view('User/sale' , [
            'sales' => $sales
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = new Sale();
        $itemSetKey = implode(',', $request->input('sale'));
        $sale->sale =strip_tags($request->input('discount'));
        $sale->products = $itemSetKey ;
        $sale->finall_date = strip_tags($request->input('date')) ;
        $sale->save();
        // $user = User::all()->where('role','user');
        // $user->notify(new \App\Notifications\AddSale($itemSetKey));
        return redirect('sale');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

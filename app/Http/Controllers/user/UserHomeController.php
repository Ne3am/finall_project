<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\orders;
use App\Models\Employees;
use App\Models\user;
use App\Models\Comment;
class UserHomeController extends Controller
{
    
    public function index()
    {
        if(auth()->user()->role == 'user'){
        return view('dashboard' , [
            'products' => Menu::limit(6)->get(), 'comments' => Comment::all()
        ]);
    }
        if(auth()->user()->role == 'admin'){
            return view('Admin/home',[
                'employees' => Employees::limit(4)->get(),
                'orders' => orders::limit(3)->get(),
                'users' => user::all(),
                'menu' => menu::all(),
                'pending' => orders::all()->where('payment_status','pending')
            ]);
        }
        if(auth()->user()->role == 'delivery'){
            return view('Delivery/home');
        }
    }
    
    public function create()
    {
        // Apriori
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
        $orders = Orders::all()->where('user_id',auth()->user()->id);
        $transactions = array();
        $freq = array();
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
                }
            $frequentItemSets = apriori($transactions, 2 );
            $x = 0 ;
            // طباعة مجموعات البنود المتكررة
            foreach ($frequentItemSets as $k => $itemSets) {
                // echo "Frequent Item Sets of length $k:";
                $x = $k ;
            }
            foreach ($frequentItemSets as $k => $itemSets) {
                if($k == $x){
                foreach ($itemSets as $itemSet) {
                    foreach($itemSet as $i){
                        $freq[] = $i;
                    }
                }
                }}
                $freq[] = array_unique($freq);
            }
        return view('User.menu' , [
            'products' => Menu::all() , 'special' => $freq
        ]);
    }

    public function Main_dish()
    {
        return view('User.main' , [
            'products' => Menu::all()->where('category','main dish')
        ]);
    }

    public function fast()
    {
        return view('User.fast' , [
            'products' => Menu::all()->where('category','fast food')
        ]);
    }
    
    public function drink()
    {
        return view('User.drink' , [
            'products' => Menu::all()->where('category','drinks')
        ]);
    }
    
    public function dessert()
    {
        return view('User.dessert' , [
            'products' => Menu::all()->where('category','desserts')
        ]);
    }

    public function gluten()
    {
        return view('User.gluten' , [
            'products' => Menu::all()->where('gluten','true')
        ]);
    }

    public function diabetes()
    {
        return view('User.diabetes' , [
            'products' => Menu::all()->where('Carbohydrate','true')
        ]);
    }

    public function Kidney_friendly()
    {
        return view('User.kindey_friendly' , [
            'products' => Menu::all()->where('Kidney_friendly','true')
        ]);
    }

    public function Vegetarian()
    {
        return view('User.Vegetarian' , [
            'products' => Menu::all()->where('Vegetarian','true')
        ]);
    }

    public function store(Request $request)
    {
        
    }

    
    public function show(string $id)
    {
        
    }

    
    public function edit(string $id)
    {
        
    }

    
    public function update(Request $request, string $id)
    {
        
    }

    
    public function destroy(string $id)
    {
        
    }
}

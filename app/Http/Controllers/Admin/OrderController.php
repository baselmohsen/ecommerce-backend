<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderDoneNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification  ;

class OrderController extends Controller
{

    
    // عرض كل الطلبات
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);

      $orders = Order::when($request->search, function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(15);


        return view('admin.orders.index', compact('orders'));
    }

    // عرض صفحة طلب محدد
    public function show($id)
    {
        $this->authorize('viewAny', Order::class);

        $order = Order::with('items.product')->findOrFail($id); // علاقة مع المنتجات داخل الطلب
        return view('admin.orders.show', compact('order'));
    }

    // إنشاء طلب جديد (عادة غير مستخدم في الـ admin)
    public function create()
    {
        return view('admin.orders.create');
    }

    // حفظ طلب جديد (عادة غير مستخدم في الـ admin)
    public function store(Request $request)
    {
        // يمكنك إضافة منطق الحفظ إذا أردت
    }

    // تعديل طلب (مثلاً تغيير الحالة)
    public function edit($id)
    {
        
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);
        return view('admin.orders.edit', compact('order'));
    }

      
    public function update(Request $request, $id)
    {
        
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);

            $request->validate([
                'status' => 'required|in:new,processing,on_delivery,completed',
                'notes'  => 'nullable|string',
            ]);

         
        $order->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

           if ($order->status === 'completed') {
                    $order->user->notify(new OrderDoneNotification($order));
                    //Notification::route('mail','baselmohsen585@gmail.com')->notify(new OrderDoneNotification($order));
            }
            
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
    // حذف طلب
    public function destroy($id)
    {
        
        $order = Order::findOrFail($id);
        $this->authorize('delete', $order);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
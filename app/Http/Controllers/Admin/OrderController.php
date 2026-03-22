<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // عرض كل الطلبات
    public function index()
    {
        $orders = Order::latest()->paginate(20); // يمكنك تغيير العدد حسب الحاجة
        return view('admin.orders.index', compact('orders'));
    }

    // عرض صفحة طلب محدد
    public function show($id)
    {
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
        return view('admin.orders.edit', compact('order'));
    }

      
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

            $request->validate([
                'status' => 'required|in:new,processing,on_delivery,completed',
                'notes'  => 'nullable|string',
            ]);
             //dd( $request->all());
        $order->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);
        // dd($order);
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
    // حذف طلب
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
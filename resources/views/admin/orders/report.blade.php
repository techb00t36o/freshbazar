<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - FreshBazar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            @page { margin: 1cm; }
        }
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
    </style>
</head>
<body class="py-10">

    <div class="max-w-5xl mx-auto bg-white p-12 shadow-sm border border-slate-100">
        
        <!-- Action Header -->
        <div class="flex justify-between items-center mb-10 no-print">
            <h1 class="text-slate-400 font-bold uppercase text-xs tracking-widest leading-none">Sales Report Summary</h1>
            <button onclick="window.print()" class="px-6 py-2 bg-primary-600 text-white font-bold rounded-lg text-sm hover:bg-primary-700 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H9a2 2 0 00-2 2v4" /></svg>
                Print Report
            </button>
        </div>

        <!-- Report Header -->
        <div class="flex justify-between items-end mb-16 pb-10 border-b border-slate-100">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter mb-2">SALES <span class="text-emerald-500">REPORT</span></h1>
                <p class="text-sm text-slate-400 font-medium italic">FreshBazar - Organic Grocery Store</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Generated On</p>
                <p class="font-bold text-slate-800 text-lg">{{ date('M d, Y - h:i A') }}</p>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-3 gap-8 mb-16">
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-4 leading-none">Total Revenue</p>
                <p class="text-4xl font-black text-slate-900">${{ number_format($total_revenue, 2) }}</p>
                <p class="text-[10px] text-slate-400 font-bold mt-2 italic">Excludes cancelled orders</p>
            </div>
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-4 leading-none">Total Orders</p>
                <p class="text-4xl font-black text-slate-900">{{ $total_orders }}</p>
                <p class="text-[10px] text-slate-400 font-bold mt-2 italic">Since store inception</p>
            </div>
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-4 leading-none">Avg. Order Value</p>
                <p class="text-4xl font-black text-slate-900">${{ $total_orders > 0 ? number_format($total_revenue / $total_orders, 2) : '0.00' }}</p>
                <p class="text-[10px] text-slate-400 font-bold mt-2 italic">Efficiency per customer</p>
            </div>
        </div>

        <!-- Status Breakdown -->
        <div class="mb-16">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 flex items-center gap-3">
                <span class="w-8 h-px bg-slate-200"></span> 
                Order Distribution Status
                <span class="w-8 h-px bg-slate-200"></span>
            </h3>
            <div class="grid grid-cols-4 gap-4">
                @foreach($status_summary as $item)
                <div class="p-5 border border-slate-100 rounded-2xl flex flex-col items-center">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ $item->status }}</span>
                    <span class="text-2xl font-black text-slate-800">{{ $item->count }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity Summary -->
        <div>
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Recent Sales Activity</h3>
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2 border-slate-900">
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest">ID</th>
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Customer</th>
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recent_orders as $order)
                    <tr>
                        <td class="py-4 text-xs font-bold text-slate-400 uppercase tracking-tighter">#ORD-{{ $order->id }}</td>
                        <td class="py-4 font-bold text-slate-800 text-sm">{{ $order->user->name ?? 'Direct Buyer' }}</td>
                        <td class="py-4">
                            <span class="text-[9px] font-black uppercase tracking-widest px-2 py-1 bg-slate-100 text-slate-600 rounded-full italic">{{ $order->status }}</span>
                        </td>
                        <td class="py-4 text-right font-black text-slate-900 text-sm">${{ number_format($order->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Report Footer -->
        <div class="mt-24 pt-10 border-t border-slate-100 text-center">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2 italic">End of Business Analysis Report</p>
            <p class="text-[10px] text-slate-200 font-medium">FreshBazar - System Generated Automated Reporting</p>
        </div>
    </div>

</body>
</html>

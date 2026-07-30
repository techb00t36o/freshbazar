<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #ORD-{{ $order->id }}</title>
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

    <div class="max-w-4xl mx-auto bg-white p-12 shadow-sm border border-slate-100">
        
        <!-- Action Header -->
        <div class="flex justify-between items-center mb-10 no-print">
            <h1 class="text-slate-400 font-bold uppercase text-xs tracking-widest leading-none">Invoice Preview</h1>
            <button onclick="window.print()" class="px-6 py-2 bg-primary-600 text-white font-bold rounded-lg text-sm hover:bg-primary-700 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H9a2 2 0 00-2 2v4" /></svg>
                Print Now
            </button>
        </div>

        <!-- Invoice Header -->
        <div class="flex justify-between items-start mb-16">
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/3724/3724720.png" alt="Logo" class="w-16 h-16 mb-4">
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">FRESH<span class="text-emerald-500">BAZAR</span></h1>
                <p class="text-sm text-slate-400 font-medium">Organic Grocery Store</p>
                <div class="mt-6 text-xs text-slate-500 leading-relaxed font-medium">
                    Sector 7, Uttara, Dhaka<br>
                    Bangladesh<br>
                    +880 1XXX-XXXXXX
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tighter mb-4">INVOICE</h2>
                <div class="space-y-1">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Order ID</p>
                    <p class="font-bold text-slate-800">#ORD-{{ $order->id }}</p>
                </div>
                <div class="mt-6 space-y-1">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Date Issued</p>
                    <p class="font-bold text-slate-800">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Billing Info -->
        <div class="grid grid-cols-2 gap-10 mb-16 border-t border-b border-slate-100 py-10">
            <div>
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-4">Billed To</h3>
                <p class="text-lg font-bold text-slate-800">{{ $order->user->name ?? 'Direct Buyer' }}</p>
                <p class="text-sm text-slate-500 mt-2">{{ $order->user->email ?? 'N/A' }}</p>
                <p class="text-sm text-slate-500 mt-1">{{ $order->phone }}</p>
            </div>
            <div>
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-4">Shipping Destination</h3>
                <p class="text-sm text-slate-500 leading-relaxed font-medium">
                    {{ $order->address }}
                </p>
            </div>
        </div>

        <!-- Items Table -->
        <div class="mb-16">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2 border-slate-900">
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Description</th>
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Qty</th>
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Price</th>
                        <th class="py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 border-b border-slate-100">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="py-6">
                            <span class="block font-bold text-slate-800">{{ $item->product->name ?? 'Deleted Product' }}</span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Ref: #P-{{ $item->product_id }}</span>
                        </td>
                        <td class="py-6 text-center text-slate-600 font-bold">{{ $item->quantity }}</td>
                        <td class="py-6 text-right text-slate-600 font-bold">${{ number_format($item->price, 2) }}</td>
                        <td class="py-6 text-right font-black text-slate-900">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Calculation -->
        <div class="flex justify-end">
            <div class="w-64 space-y-4">
                <div class="flex justify-between text-sm font-bold text-slate-400">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-slate-400">
                    <span>Tax (0%)</span>
                    <span>$0.00</span>
                </div>
                <div class="flex justify-between border-t-2 border-slate-900 pt-4">
                    <span class="text-lg font-black text-slate-900 uppercase tracking-tighter">Total Due</span>
                    <span class="text-lg font-black text-emerald-600">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-24 border-t border-slate-100 pt-10 text-center">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Thank you for your business!</p>
            <p class="text-[10px] text-slate-300 font-medium italic">This is a computer-generated invoice. No signature required.</p>
        </div>
    </div>

    <script>
        // Auto trigger print after page loads (optional)
        window.onload = function() {
            // setTimeout(() => { window.print(); }, 1000);
        }
    </script>
</body>
</html>

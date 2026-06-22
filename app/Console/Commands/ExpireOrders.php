<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ExpireOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark expired orders and restore quota';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Checking for expired orders...');
        
        $expiredOrders = Order::where('payment_status', 'pending')
            ->where('payment_expired_at', '<', now())
            ->get();
        
        if ($expiredOrders->isEmpty()) {
            $this->info('✅ No expired orders found.');
            return 0;
        }
        
        $count = 0;
        $errors = 0;
        
        foreach ($expiredOrders as $order) {
            try {
                DB::transaction(function() use ($order) {
                    // Restore quota
                    if ($order->ticket_category_id) {
                        $order->ticketCategory->decrement('sold', $order->quantity);
                        $this->line("   ↻ Restored {$order->quantity} tickets to category #{$order->ticket_category_id}");
                    } else {
                        $order->event->decrement('sold_count', $order->quantity);
                        $this->line("   ↻ Restored {$order->quantity} tickets to event #{$order->event_id}");
                    }
                    
                    // Mark as expired
                    $order->update([
                        'payment_status' => 'expired',
                        'status' => 'cancelled'
                    ]);
                });
                
                $count++;
                $this->info("✓ Order {$order->order_code} expired, quota restored.");
                
            } catch (\Exception $e) {
                $errors++;
                $this->error("✗ Failed to expire order {$order->order_code}: {$e->getMessage()}");
            }
        }
        
        $this->newLine();
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("📊 Summary:");
        $this->info("   • Expired: {$count} orders");
        if ($errors > 0) {
            $this->warn("   • Errors: {$errors} orders");
        }
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        
        return 0;
    }
}

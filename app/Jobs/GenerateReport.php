<?php

namespace App\Jobs;

use App\Models\Report;
use App\Models\InventoryItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class GenerateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $report;

    /**
     * Create a new job instance.
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            // Update report status to processing
            $this->report->update(['status' => 'processing']);

            // Get inventory data based on parameters
            $query = InventoryItem::query();
            if ($this->report->parameters) {
                if (isset($this->report->parameters['categories']) && !empty($this->report->parameters['categories'])) {
                    $query->whereIn('category', $this->report->parameters['categories']);
                }
                if (isset($this->report->parameters['min_quantity'])) {
                    $query->where('quantity', '>=', $this->report->parameters['min_quantity']);
                }
            }
            $inventoryItems = $query->get();

            // Generate PDF report
            $pdf = PDF::loadView('reports.inventory', [
                'items' => $inventoryItems,
                'report' => $this->report,
                'generated_at' => now()
            ]);

            // Save the PDF
            $filename = "reports/inventory-report-{$this->report->id}.pdf";
            $fullPath = storage_path("app/{$filename}");
            
            // Ensure directory exists
            if (!file_exists(dirname($fullPath))) {
                mkdir(dirname($fullPath), 0775, true);
            }
            
            // Save the PDF
            file_put_contents($fullPath, $pdf->output());
            
            // Log the file path and check if it exists
            \Log::info("PDF saved to: {$fullPath}");
            \Log::info("File exists: " . (file_exists($fullPath) ? 'yes' : 'no'));
            \Log::info("File size: " . (file_exists($fullPath) ? filesize($fullPath) : 'N/A'));

            // Update report with file path
            $this->report->update([
                'file_path' => $filename,
                'status' => 'completed',
                'completed_at' => now()
            ]);

            // Send email with report
            Mail::send('emails.report', ['report' => $this->report], function ($message) use ($fullPath) {
                $message->to($this->report->email)
                    ->subject("Your Inventory Report: {$this->report->name}")
                    ->attach($fullPath);
            });

        } catch (\Exception $e) {
            $this->report->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}

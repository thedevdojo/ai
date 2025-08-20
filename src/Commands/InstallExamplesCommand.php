<?php

namespace Devdojo\Ai\Commands;

use Illuminate\Console\Command;

class InstallExamplesCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'ai:install-examples';

    /**
     * The console command description.
     */
    protected $description = 'Install AI example Volt components into your project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing AI example components...');

        // Publish the example files
        $this->call('vendor:publish', [
            '--tag' => 'ai-examples',
            '--force' => $this->option('force') ?? false,
        ]);

        $this->info('✅ AI example components installed successfully!');
        $this->line('');
        $this->line('Available components:');
        $this->line('• <comment>basic-example.blade.php</comment> - Simple prompt and response');
        $this->line('• <comment>chat-example.blade.php</comment> - Full conversation chat');
        $this->line('');
        $this->line('Use them in your views with:');
        $this->line('<info><livewire:basic-example /></info>');
        $this->line('<info><livewire:chat-example /></info>');

        return Command::SUCCESS;
    }
}

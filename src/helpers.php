<?php

use Prism\Prism\Prism;
use Prism\Prism\ValueObjects\Messages\UserMessage;
use Prism\Prism\ValueObjects\Messages\AssistantMessage;

if (!function_exists('ai')) {
    function ai($messages, $callback = null)
    {
        $prism = Prism::text()->using('openai', 'gpt-4');
        
        // If messages is a string, treat as simple prompt
        if (is_string($messages)) {
            $stream = $prism->withPrompt($messages)->asStream();
        } else {
            // Extract userInput from last user message
            $userInput = null;
            for ($i = count($messages) - 1; $i >= 0; $i--) {
                if ($messages[$i]['type'] === 'user') {
                    $userInput = $messages[$i]['content'];
                    break;
                }
            }
            
            // Build message objects (excluding empty assistant messages)
            $messageObjects = [];
            foreach ($messages as $msg) {
                if (is_array($msg) && isset($msg['type'], $msg['content']) && !empty($msg['content'])) {
                    if ($msg['type'] === 'user') {
                        $messageObjects[] = new UserMessage($msg['content']);
                    } elseif ($msg['type'] === 'assistant') {
                        $messageObjects[] = new AssistantMessage($msg['content']);
                    }
                }
            }
            
            $stream = $prism->withMessages($messageObjects)->asStream();
        }

        $full_response = '';
        foreach ($stream as $response) {
            $full_response .= $response->text;
            
            // If input was an array, update the last assistant message
            if (is_array($messages)) {
                $lastIndex = count($messages) - 1;
                if ($lastIndex >= 0 && isset($messages[$lastIndex]['type']) && $messages[$lastIndex]['type'] === 'assistant') {
                    $messages[$lastIndex]['content'] = $full_response;
                }
            }
            
            if ($callback && is_callable($callback)) {
                $callback($full_response);
            }
        }

        // Return updated messages array or just the response string
        return is_array($messages) ? $messages : $full_response;
    }
}

if (!function_exists('ai_ar')) {
    function ai_ar($messages, $callback = null)
    {
        $prism = Prism::text()->using('openai', 'gpt-4');
        
        // If messages is a string, treat as simple prompt
        if (is_string($messages)) {
            $stream = $prism->withPrompt($messages)->asStream();
        } else {
            // Handle array of alternating user/assistant strings
            $messageObjects = [];
            foreach ($messages as $index => $content) {
                if ($index % 2 === 0) {
                    // Even index = user message
                    $messageObjects[] = new UserMessage($content);
                } else {
                    // Odd index = assistant message
                    $messageObjects[] = new AssistantMessage($content);
                }
            }
            
            $stream = $prism->withMessages($messageObjects)->asStream();
        }
        

        $full_response = '';
        foreach ($stream as $response) {
            $full_response .= $response->text;
            if ($callback && is_callable($callback)) {
                $callback($full_response);
            }
        }

        // If input was an array, return the array with the new assistant response
        if (is_array($messages)) {
            $messages[] = $full_response;
            return $messages;
        }

        return $full_response;
    }
}

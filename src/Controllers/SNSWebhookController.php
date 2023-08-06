<?php

namespace JapSeyz\SnsMessageValidator\Controllers;

use function call_user_func;
use function collect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use JapSeyz\SnsMessageValidator\Traits\HandlesSNS;

class SNSWebhookController
{
    use HandlesSNS;

    public function handle(Request $request): Response
    {
        if (! $this->snsMessageIsValid($request)) {
            return $this->okStatus();
        }

        $snsMessage = $this->getSnsMessage($request)->toArray();
        if (isset($snsMessage['Type'])) {
            if ($snsMessage['Type'] === 'SubscriptionConfirmation') {
                @file_get_contents($snsMessage['SubscribeURL']);
            }

            if ($snsMessage['Type'] === 'Notification') {
                call_user_func([$this, 'onNotification'], $snsMessage, $request);
            }
        }

        return $this->okStatus();
    }

    protected function onNotification(array $snsMessage, Request $request): void
    {
        $decodedMessage = json_decode($snsMessage['Message'], true);
        $headers = collect($decodedMessage['mail']['headers'])->keyBy('name');

        $typeKey = array_key_exists('eventType', $decodedMessage) ? 'eventType' : 'notificationType';
        $eventType = $decodedMessage[$typeKey] ?? null;

        $methodToCall = 'on'.Str::studly($eventType);

        if (method_exists($this, $methodToCall)) {
            call_user_func(
                [$this, $methodToCall],
                $decodedMessage, $snsMessage, $request, $headers
            );
        }
    }

    /**
     * Get a 200 OK status.
     *
     * @return \Illuminate\Http\Response
     */
    protected function okStatus()
    {
        return response('OK', 200);
    }
}

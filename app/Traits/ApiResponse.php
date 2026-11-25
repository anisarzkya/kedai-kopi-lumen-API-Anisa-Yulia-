<?php

namespace App\Traits;

use Illuminate\Http\Request;
use SimpleXMLElement;

trait ApiResponse
{
    protected function sendResponse(Request $request, array $data, int $status = 200, string $rootElement = 'response')
    {
        $accept = $request->header('Accept', 'application/json');

        if (str_contains($accept, 'application/xml') || str_contains($accept, 'text/xml')) {
            $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><{$rootElement}></{$rootElement}>");
            $this->arrayToXml($data, $xml);

            return response($xml->asXML(), $status)
                ->header('Content-Type', 'application/xml');
        }

        return response()->json($data, $status);
    }

    private function arrayToXml(array $data, SimpleXMLElement &$xml): void
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item';
            }

            if (is_array($value)) {
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                if (is_bool($value)) {
                    $strValue = $value ? 'true' : 'false';
                } elseif (is_null($value)) {
                    $strValue = '';
                } else {
                    $strValue = (string) $value;
                }
                $xml->addChild($key, htmlspecialchars($strValue, ENT_XML1 | ENT_QUOTES, 'UTF-8'));
            }
        }
    }
}

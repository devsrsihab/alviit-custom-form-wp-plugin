<?php
class TravelCalculator
{
    private string $apiKey;
    private array $fromAddress;
    private array $toAddress;

    public float $distanceKm = 0;
    public float $travelMinutes = 0;
    public float $travelCost = 0;

    private float $costPerKm = 1.0;
    private float $timePerKm = 1.0; // minutes per km

    public function __construct(array $fromAddress, array $toAddress, string $apiKey = '')
    {
        $this->fromAddress = $fromAddress;
        $this->toAddress = $toAddress;
        $this->apiKey = $apiKey ?: '5b3ce3597851110001cf62486640910e307a4feeb78ae69f314e5c42';
    }

    public function calculate(): void
    {
        try {
            $fromFull = $this->formatAddress($this->fromAddress);
            $toFull = $this->formatAddress($this->toAddress);

            if (empty($fromFull) || empty($toFull)) {
                throw new Exception("Invalid addresses provided.");
            }

            $fromCoords = $this->getCoordinates($fromFull);
            $toCoords = $this->getCoordinates($toFull);

            if (!$fromCoords || !$toCoords) {
                throw new Exception("Failed to retrieve coordinates.");
            }

            $this->distanceKm = $this->calculateDistance($fromCoords, $toCoords);
            $this->travelMinutes = $this->distanceKm * $this->timePerKm;
            $this->travelCost = $this->distanceKm * $this->costPerKm;

        } catch (Exception $e) {
            error_log("TravelCalculator error: " . $e->getMessage());
            // For debugging during dev, uncomment this:
            // dd("TravelCalculator error: " . $e->getMessage());

            $this->distanceKm = 0;
            $this->travelMinutes = 0;
            $this->travelCost = 0;
        }
    }

    public function getDistanceKm(): float
    {
        return round($this->distanceKm, 2);
    }

    public function getTravelMinutes(): float
    {
        return round($this->travelMinutes, 2);
    }

    public function getTravelHours(): float
    {
        return round($this->travelMinutes / 60, 2);
    }

    public function getTravelCost(): float
    {
        return round($this->travelCost, 2);
    }

    public function getFormattedTravelTime(): string
    {
        return $this->formatMinutesToTime($this->travelMinutes);
    }

    // ========================= Private Helpers =========================

    private function formatAddress(array $address): string
    {
        $parts = array_filter([
            trim($address['street'] ?? ''),
            trim($address['city'] ?? ''),
            trim($address['country'] ?? ''),
        ]);

        return implode(', ', $parts);
    }

private function getCoordinates(string $address): ?array
{
    $query = urlencode($address);
    $url = "https://api.openrouteservice.org/geocode/search?api_key={$this->apiKey}&text={$query}";

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error while fetching coordinates: $error");
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        throw new Exception("API returned HTTP $httpCode. Response: $response");
    }

    $data = json_decode($response, true);

    if (
        empty($data) ||
        !isset($data['features'][0]['geometry']['coordinates']) ||
        !is_array($data['features'][0]['geometry']['coordinates'])
    ) {
        throw new Exception("Coordinates not found in API response. Raw: $response");
    }

    $coords = $data['features'][0]['geometry']['coordinates'];
    return ['lat' => $coords[1], 'lon' => $coords[0]];
}


    private function calculateDistance(array $from, array $to): float
    {
        $earthRadius = 6371; // in kilometers
        $lat1 = deg2rad($from['lat']);
        $lon1 = deg2rad($from['lon']);
        $lat2 = deg2rad($to['lat']);
        $lon2 = deg2rad($to['lon']);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = sin($dLat / 2) ** 2 +
            cos($lat1) * cos($lat2) * sin($dLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    private function formatMinutesToTime(float $minutes): string
    {
        $h = floor($minutes / 60);
        $m = floor($minutes % 60);
        return sprintf('%02d:%02d', $h, $m);
    }
}

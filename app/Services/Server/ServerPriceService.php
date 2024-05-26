<?php 

namespace App\Services\Server;

class ServerPriceService {

    private $pricePerGB = 12;
    private $pricePerDomain = 800;
    private $pricePerEmailSecurity = 800;

    public function countFinalServerPrice(int|null $domain = 0, int|null $emailSecurity = 0, int|null $plan = 0, int|null $serverCapacity = 0): int
    {   
        $serverCapacityAmount = $this->countServerCapacityPrice($serverCapacity);
        $emailSecurityAmount = $emailSecurity == true ? $this->pricePerEmailSecurity : 0;
        $planAmount = $this->getServerPlanPrice($plan);
        $domainPrice = $domain == true ? $this->pricePerDomain : 0;

        $pricePerYear = ($serverCapacityAmount + $emailSecurityAmount + $planAmount) * 12;

        $finalAmount = $domainPrice + $pricePerYear;

        return $this->formatPrice($finalAmount);
    }

    private function countServerCapacityPrice(int|null $serverCapacity = 0): int
    {   
        if($serverCapacity > 0)
        {
            return $serverCapacity * $this->pricePerGB;
        }
        return 0;
    } 

    private function getServerPlanPrice(int|null $plan = 0): int
    {   
        $planFind = \App\Models\Server\Plan::where('id', $plan)->first();
        if($planFind)
        {
            return $planFind->price_per_month;
        }
        return 0;
    } 

    private function formatPrice(int $amount): int
    {
        return number_format($amount / 100, 2, '.', '');
    }
}

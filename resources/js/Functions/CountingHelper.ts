function formatPrice(amount: number)
{   
    if(amount)
    {
        return amount.toFixed(2) + ' / per metus';
    }    
    return 0;
}

export default { formatPrice }
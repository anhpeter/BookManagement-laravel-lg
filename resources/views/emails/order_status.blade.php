<div>
    <h3 style="
        text-align:center; 
        text-transform:uppercase; 
        background-color:dodgerblue; 
        color: white;
        padding: 10px 20px;">

        Your order have
        {{ $order->status }}
    </h3>
    <div style="color:black">
        <p>Dear {{ $order->user->profile->name }},</p>
        <p>Thank you for using our services!</p>
    </div>
    <x-mail-order-cart :order="$order" />
</div>

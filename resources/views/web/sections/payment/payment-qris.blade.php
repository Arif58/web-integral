<html>

    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
            src="{{config('midtrans.snap_url')}}"
        data-client-key="{{config('midtrans.client_key')}}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    </head>

    <body>
    {{-- <button id="pay-button">Pay!</button> --}}

    <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
    <div id="snap-container" style="width: 100%; height: 100%;"></div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            window.snap.embed('{{$snapToken}}', {
                embedId: 'snap-container',
                onSuccess: function (result) {
                /* You may add your own implementation here */
                // alert("payment success!"); console.log(result);
                window.location.href = '/tryout-saya';
                },
                onPending: function (result) {
                /* You may add your own implementation here */
                // alert("wating your payment!");
                window.location.href = '/riwayat-pembelian';
                },
                onError: function (result) {
                /* You may add your own implementation here */
                alert("payment failed!"); console.log(result);
                },
                onClose: function () {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
                window.loaction.href = '/riwayat-pembelian';
                }
            });
        })
    </script>
    </body>

</html>
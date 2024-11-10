<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }

        .authority {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* Aligns content to the left */
            margin-top: 2rem;
        }

        .signature-name {
            font-family: 'Cursive', 'Segoe UI', sans-serif;
            /* Adds a cursive font */
            font-size: 1.5rem;
            /* Adjusts font size */
            font-weight: bold;
            /* Ensures it stands out */
            color: black;
            /* Custom color */
            margin-bottom: 0.5rem;
            /* Spacing between name and label */
        }

        h5 {
            font-family: 'Georgia', serif;
            /* Adds a serif font for the label */
            color: green;
            /* Matches the green color */
            margin: 0;
        }
    </style>
</head>

<body>
    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">

                <h2 style="color: green; font-size: 26px;"><strong>MallilkPOS</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
                MallilkPOS Head Office <br>
               Email:support@mallikpos.com <br>
               Mob: 1245454545 <br>
               Chandipur:721633 <br>
            </pre>
            </td>
        </tr>
    </table>
    <table width="100%" style="background:white; padding:2px;"></table>
    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Customer Name:</strong>{{ $orderId->customerDetails->name }} <br>
                    <strong>Customer Email:</strong> {{ $orderId->customerDetails->email }}<br>
                    <strong>Customer Phone:</strong>{{ $orderId->customerDetails->email }}<br>

                    <strong>Address:</strong>{{ $orderId->customerDetails->address }} <br>
                    <strong>Shop Name:</strong>{{ $orderId->customerDetails->shopname }}<br>

                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">Invoice:</span> #{{ $orderId->invoice_no }} </h3>
                Order Date:{{ $orderId->order_date }}<br>
                Order Status:{{ $orderId->order_status }} <br>
                Payment Status: {{ $orderId->payment_status }}<br>
                Total Price: ${{ $orderId->total }}<br>
                Pay: ${{ $orderId->pay }}<br>
                Due: ${{ $orderId->due }}<br>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>
    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Image </th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total(+Vat)</th>
            </tr>
        </thead>
        <tbody>
            @php $subtotal = 0; @endphp
            @foreach ($orderDetailsData as $item)
                <tr class="font">
                    <td align="center">
                        @if ($item->product_image_base64)
                            <img src="{{ $item->product_image_base64 }}" height="50px" width="50px" alt="">
                        @else
                            <p>No image available</p>
                        @endif
                    </td>
                    <td align="center">{{ $item->product->product_name }}</td>

                    <td align="center">{{ $item->product->product_code }}</td>
                    <td align="center"> {{ $item->quantity }}</td>


                    <td align="center">${{ $item->product->selling_price }}</td>
                    <td align="center">${{ $item->total }}</td>
                </tr>
                @php $subtotal += $item->total; @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">Subtotal:</span> ${{ $subtotal }}</h2>

            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Thanks For Buying Products..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <h5>Authority Signature:</h5>
        <p class="signature-name">Imran Mallik</p>
    </div>
</body>

</html>

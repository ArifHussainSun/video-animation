<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <style>
    	body,table,thead,tbody,tr,td,img { padding: 0; margin: 0; border: none; border-spacing: 0px; border-collapse: collapse; vertical-align: top; font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #9c9c9c; }
        .background { background-color: {{ isset($brandSettings['primary_color']) ? $brandSettings['primary_color'] : '' }}; }
        .white-background { background-color: #ffffff; }
        .background p { font-weight: 500; margin: 0; line-height: 1.5; }
        .header-padding { padding: 30px 20px; color: #ffffff; }
        .header-padding p { text-align: right; }
        .header-padding a { color: #ffffff; text-decoration: none; }
        .logo { width: 100%; max-width: 150px; }
        .customer-sec-padding { padding: 30px 20px; }
        .customer-padding h1 { font-size: 12px; color: #9c9c9c; margin-top: 0; }
        .customer-padding p { font-weight: 600; margin: 0; line-height: 1.5; color: #000000; }
        .customer-padding h2 { color: {{ isset($brandSettings['primary_color']) ? $brandSettings['primary_color'] : '' }}; margin-top: 0; font-size: 34px; }
        .client-heading { padding: 10px 20px; }
        .client-heading p { color: #ffffff; font-size: 16px; }
        .client-detail { padding: 14px 20px; font-weight: 600; color: #666666; }
        .client-detail a { color: #666666; text-decoration: none; }
        .dark { background: #f0f0f0; }
        .client-detail b { font-weight: 800; color: #777777; }
        .footer-text p { margin: 0; line-height: 1.5; }
        .footer-text a { color: #9c9c9c; text-decoration: none; }
        .footer-text h2 { margin: 0; color: {{ isset($brandSettings['primary_color']) ? $brandSettings['primary_color'] : '' }}; font-size: 31px; font-weight: 900; line-height: 1; }
        .top-footer { border-bottom: 2px solid {{ isset($brandSettings['primary_color']) ? $brandSettings['primary_color'] : '' }}; padding: 30px 20px 15px 20px; }
        .bottom-footer { padding: 15px 30px 30px 20px; }
    </style>

</head>

<body>
    	<table width="100%">
        <tbody>
        	<tr>
                <td width="800" align="center">
					<table cellpadding="0" cellspacing="0" class="background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="header-padding">
                                                <img style="fill:white;" src="{{ asset(isset($brandSettings['logo_white']) ? $brandSettings['logo_white'] : '') }}" alt="BrandCRM" class="logo">
                                            </td>
                                            <td align="right" class="header-padding" style="width: 150px;"> 
                                                <p>{{ isset($brandSettings['company_phone']) ? $brandSettings['company_phone'] : '' }}</p>
                                                <p>{{ isset($brandSettings['company_email']) ? $brandSettings['company_email'] : '' }}</p>
                                                <p>{{  url('') }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="white-background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td class="customer-sec-padding">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="customer-padding" style="width: 200px;">
                                                <table width="100%">
                                                    <tbody><tr>
                                                        <td>
                                                            <h1>Invoice From:</h1>
                                                            <p>{{ isset($from['invoice_no']) ? $from['invoice_no'] : '' }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                            <td align="left" class="customer-padding">
                                                <table width="100%">
                                                    <tr>
                                                        <td>
                                                            <h1>Invoice To:</h1>
                                                            <p>{{ isset($to['invoice_no']) ? $to['invoice_no'] : '' }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top: 20px;">
                                                            <h1>Issue Date:</h1>
                                                            <p>{{ date('Y-m-d') }}</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right" class="customer-padding" style="width: 300px;"> 
                                                <h1>Invoice Total:</h1>
                                                <h2 id="invoice-total"></h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="white-background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td>
                                <table width="100%" class="background">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="client-heading">
                                                <p>Sales Report</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" class="white-background client-table" style="border-bottom: 1px solid #9c9c9c;">
                                    <thead>
                                        <tr>
                                            <th align="left" class="client-detail">
                                                <b> Invoice No. </b>
                                            </th>
                                            <th align="left" class="client-detail">
                                             <b> Customer Name </b>
                                            </th>
                                            <th align="left" class="client-detail">
                                             <b> Customer Email </b>
                                            </th>
                                            <th align="left" class="client-detail">
                                            <b> Total </b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoices as $key => $invoice)

                                        <tr class="{{ ($key % 2 == 0) ? '' : 'dark' }}dark">
                                            <td align="left" class="client-detail">
                                                {{ $invoice->invoice_no }} 
                                            </td>
                                            <td align="left" class="client-detail">
                                              {{ $invoice->customer->first_name. " " .$invoice->customer->last_name }} 
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ $invoice->customer->email }} 
                                            </td>
                                            <td align="left" class="client-detail">
                                                {{ '$ '.$invoice->payment->price }}
                                                <input type="hidden" class="price" value="{{ $invoice->payment->price }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                <table align = "right" class="white-background">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="client-detail">
                                                <b>Grand Total</b>
                                            </td>
                                            <td align="left" class="client-detail">
                                                <b id="grand-total"></b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <table cellpadding="0" cellspacing="0" class="white-background" style="width: 100%; max-width: 800px;">
                        <tr>
                            <td class="footer top-footer">
                                <table width="100%" class="white-background">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="footer-text">
                                                <p>Questions?</p>
                                                <p>{{ isset($brandSettings['company_phone']) ? $brandSettings['company_phone'] : '' }}</p>
                                                <p>{{ isset($brandSettings['company_email']) ? $brandSettings['company_email'] : '' }}</p>
                                            </td>
                                            <td align="right" class="footer-text" style="width: 150px">
                                                <h2>Thank<br>You!</h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="footer bottom-footer">
                                <table width="100%" class="white-background">
                                    <tbody>
                                       <!-- <tr>
                                            <td align="left" class="footer-text">
                                                <p><b>Note:</b> We have received reports of chargebacks recently solely due to the customer not knowing our merchant name for the charges applied to their card, Please remember that our merchant account is </i><b>"Orbit Technologies LLC"</b>
                                            </td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>


                </td>
            </tr>
        </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var sum = 0;
            // iterate through each td based on class and add the values
            $(".price").each(function() {
            
                var value = $(this).val()
                // add only if the value is number
                if(!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });
            $('#grand-total').text('$ '+sum);
            $('#invoice-total').text('$'+sum);

        });

    </script>
</body>
</html>
